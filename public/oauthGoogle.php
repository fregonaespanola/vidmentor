<?php
    require 'common_functions.php';
    require '../vendor/autoload.php';
    require '../config.php';

    use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
    use League\OAuth2\Client\Provider\Google;

    session_start();

    $provider = new Google([
        'clientId' => GOOGLE_ID,
        'clientSecret' => GOOGLE_SECRET,
        'redirectUri' => BASE_URL . 'oauthGoogle.php',
        'verify' => false
    ]);

    if (!empty($_GET['error'])) {
        exit('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));
    } elseif (empty($_GET['code'])) {
        $authUrl = $provider->getAuthorizationUrl();
        $_SESSION['oauth2state'] = $provider->getState();
        header('Location: ' . $authUrl);
        die();
    } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
        exit('Invalid state');
    } else {
        try{
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);
        }catch(IdentityProviderException $e){
            exit('Error al obtener el token de acceso: ' . $e->getMessage());
        }

        try {
            $ownerDetails = $provider->getResourceOwner($token);

            $firstName = $ownerDetails->getName();
            $email = $ownerDetails->getEmail();
            $username = explode('@', $email)[0];
            $profileImage = $ownerDetails->getAvatar();

            $query = "SELECT * FROM USUARIO WHERE MAIL = :email";
            $params = [':email' => $email];
            $stmt = executeQuery($query, $params);

            if ($stmt) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    if ($user['OAUTH'] != null && $user['OAUTH'] != 'google') {
                        $previousPage = $_SESSION['previous_page'] ?? 'index.php';
                        redirect($previousPage, [
                            'title' => 'error',
                            'text' => 'Este correo electrónico ya está asociado a una cuenta.',
                            'position' => 'center',
                            'toast' => true,
                            'showConfirmButton' => true,
                            'confirmButtonText' => 'OK'
                        ]);
                    } else {
                        $_SESSION['user'] = $user;
                        setLoginCookies($user);
                        if ($user['OAUTH'] !='google') {
                            $query_update_user = "UPDATE USUARIO SET NICK = :name, OAUTH = 'google', AVATAR = :profile_image, PWD = NULL WHERE ID = :id";
                            $params_update_user = [':name' => $firstName,  ':profile_image' => $profileImage, ':id' => $user['ID']];
                            $stmt_update_user = executeQuery($query_update_user, $params_update_user);

                            if ($stmt_update_user) {
                                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                $previousPage = $_SESSION['previous_page'] ?? 'index.php';
                                redirect($previousPage, [
                                    'title' => 'success',
                                    'text' => 'Inicio de sesión exitoso.',
                                    'position' => 'center',
                                    'toast' => true,
                                    'showConfirmButton' => false,
                                    'timer' => 1500
                                ]);
                            } else {
                                redirect('index.php', [
                                    'title' => 'error',
                                    'text' => 'Error al actualizar OAUTH del usuario.',
                                    'position' => 'center',
                                    'toast' => true,
                                    'showConfirmButton' => true,
                                    'confirmButtonText' => 'OK'
                                ]);
                            }
                        }else{
                            $previousPage = $_SESSION['previous_page'] ?? 'index.php';
                            redirect($previousPage, [
                                'title' => 'success',
                                'text' => 'Inicio de sesión exitoso.',
                                'position' => 'center',
                                'toast' => true,
                                'showConfirmButton' => false,
                                'timer' => 1500
                            ]);
                        }
                    }
                } else {
                    $query_insert_user = "INSERT INTO USUARIO (NOMBRE, NICK, MAIL, OAUTH, AVATAR) VALUES (:name, :username, :email, 'google', :profile_image)";
                    $params_insert_user = [':name' => $firstName, ':username' => $username, ':email' => $email, ':profile_image' => $profileImage];
                    $stmt_insert_user = executeQuery($query_insert_user, $params_insert_user);
                    if ($stmt_insert_user) {
                        $query = "SELECT * FROM USUARIO WHERE NICK = :username";
                        $params = [':username' => $username];
                        $stmt = executeQuery($query, $params);

                        if ($stmt) {
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                            $_SESSION['user'] = $user;
                            setLoginCookies($user);
                            $previousPage = $_SESSION['previous_page'] ?? 'index.php';
                            redirect($previousPage, [
                                'title' => 'success',
                                'text' => 'Inicio de sesión exitoso.',
                                'position' => 'center',
                                'toast' => true,
                                'showConfirmButton' => false,
                                'timer' => 1500
                            ]);
                        }
                    }
                }
            } else {
                exit('Error al traer los detalles del usuario');
            }
        } catch (Exception $e) {
            exit(':( Algo ha ido mal: ' . $e->getMessage());
        }
    }
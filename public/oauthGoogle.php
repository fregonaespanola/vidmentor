<?php
require 'common_functions.php';
require '../vendor/autoload.php';
require '../config.php';
use League\OAuth2\Client\Provider\Google;

session_start();

$provider = new Google([
    'clientId' => GOOGLE_ID,
    'clientSecret' => GOOGLE_SECRET,
    'redirectUri' => BASE_URL . 'oauthGoogle.php',
    'verify' => false
]);

if (!empty($_GET['error'])) {
    // Got an error, probably user denied access
    exit('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));
} elseif (empty($_GET['code'])) {
    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    die();
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    // State is invalid, possible CSRF attack in progress
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {
    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Optional: Now you have a token you can look up a user's profile data
    try {
        // We got an access token, let's now get the owner details
        $ownerDetails = $provider->getResourceOwner($token);

        // Use these details to create a new profile or update an existing one
        $firstName = $ownerDetails->getName();

        $email = $ownerDetails->getEmail();
        $username = explode('@', $email)[0];
        $profileImage = $ownerDetails->getAvatar();

        // Check if the user already exists in the database
        $query = "SELECT * FROM USUARIO WHERE MAIL = :email";
        $params = [':email' => $email];
        $stmt = executeQuery($query, $params);

        if ($stmt) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                if ($user['oauth_provider'] != null && $user['oauth_provider'] != 'google') {
                    echo "<script>alert('Por favor, logueate con tu proveedor de OAuth.')</script>";
                    $previousPage = $_SESSION['previous_page'] ?? 'index.php';
                    header("Location: $previousPage?msg=fail");
                    exit();
                } else {
                    $_SESSION['user_id'] = $user['id'];
                    if ($user['oauth_provider'] !='google') {
                        $query_update_user = "UPDATE USUARIO SET NICK = :name, OAUTH = 'google', AVATAR = :profile_image, PWD = NULL WHERE ID = :id";
                        $params_update_user = [':name' => $firstName,  ':profile_image' => $profileImage, ':id' => $user['id']];
                        $stmt_update_user = executeQuery($query_update_user, $params_update_user);

                        if ($stmt_update_user) {
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                            $previousPage = $_SESSION['previous_page'] ?? 'index.php';
                            header("Location: $previousPage");
                            exit();
                        }else{
                            print_r($stmt_update_user);
                        }
                    }else{
                        $previousPage = $_SESSION['previous_page'] ?? 'index.php';
                        header("Location: $previousPage?msg=success");
                        exit();
                    }
                }
            } else {
                $query_insert_user = "INSERT INTO USUARIO (NICK, MAIL, OAUTH, AVATAR) VALUES (:username, :email, 'google', :profile_image)";
                $params_insert_user = [':username' => $username, ':email' => $email, ':profile_image' => $profileImage];
                $stmt_insert_user = executeQuery($query_insert_user, $params_insert_user);
                if ($stmt_insert_user) {
                    $query = "SELECT * FROM USUARIO WHERE NICK = :username";
                    $params = [':username' => $firstName];
                    $stmt = executeQuery($query, $params);

                    if ($stmt) {
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['user_id'] = $user['id'];
                        $previousPage = $_SESSION['previous_page'] ?? 'index.php';
                        header("Location: $previousPage?msg=success");
                        exit();
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
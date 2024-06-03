<?php
function executeQuery($query, $params = []) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=PROYECTO', 'PROYECTO', '11223344');
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        // Manejo de errores
        return false;
    }
}

function checkExistingUserEmail($nick, $mail) {
    $query = "SELECT ID FROM USUARIO WHERE NICK = :nick OR MAIL = :mail";
    $params = [':nick' => $nick, ':mail' => $mail];
    $stmt = executeQuery($query, $params);

    if ($stmt && $stmt->rowCount() > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return ['exists' => true, 'data' => $data];
    } else {
        return ['exists' => false, 'data' => null];
    }
}

function validateFields($requiredFields) {
    $errors = [];
    foreach ($requiredFields as $field => $displayName) {
        if (empty($_POST[$field])) {
            $errors[$field] = "El campo $displayName es obligatorio.";
        }
    }
    return $errors;
}

function redirect($url, $msgType, $msg) {
    $_SESSION[$msgType] = $msg;
    header("Location: $url");
    exit();
}


function password_verify_custom($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

?>

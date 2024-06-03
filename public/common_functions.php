<?php

function getDatabaseConnection() {
    $dsn = "mysql:host=localhost;dbname=PROYECTO;charset=utf8mb4";
    $username = "PROYECTO";
    $password = "11223344";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Error al conectarse a la base de datos: " . $e->getMessage();
        exit();
    }
}

function executeQuery($query, $params = []) {
    try {
        $pdo = getDatabaseConnection();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        // Manejo de errores
        echo "Error en la consulta: " . $e->getMessage(); // Agregar mensaje de error
        echo "<br>"; // Agregar salto de línea para una mejor legibilidad
        echo "Query: " . $query; // Mostrar la consulta que causó el error
        echo "<br>"; // Agregar salto de línea para una mejor legibilidad
        echo "Params: " . print_r($params, true); // Mostrar los parámetros de la consulta
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

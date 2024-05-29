<?php
session_start();
$usuario_id = $_SESSION['usuario_id'] ?? null;

if (!$usuario_id) {
    die("Usuario no autenticado");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $interest = $_POST['interest'] ?? null;
    $usuario_id = $_POST['usuario_id'] ?? null;

    if ($interest && $usuario_id) {
        $dsn = "mysql:host=localhost;dbname=PROYECTO;charset=utf8mb4";
        $username = "PROYECTO";
        $password = "11223344";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verificar si el usuario ya tiene un interés asociado
            $stmt = $pdo->prepare("SELECT INTERES FROM USUARIO WHERE ID = :id");
            $stmt->bindParam(':id', $usuario_id);
            $stmt->execute();
            $existingInterest = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingInterest && !empty($existingInterest['INTERES'])) {
                // Actualizar el interés existente
                $stmt = $pdo->prepare("UPDATE USUARIO SET INTERES = :interes WHERE ID = :id");
                $stmt->bindParam(':interes', $interest);
                $stmt->bindParam(':id', $usuario_id);
                $stmt->execute();

                echo "Interés actualizado con éxito";
            } else {
                // Insertar el nuevo interés
                $stmt = $pdo->prepare("UPDATE USUARIO SET INTERES = :interes WHERE ID = :id");
                $stmt->bindParam(':interes', $interest);
                $stmt->bindParam(':id', $usuario_id);
                $stmt->execute();

                echo "Interés guardado con éxito";
            }
        } catch (PDOException $e) {
            echo "Error al conectarse a la base de datos: " . $e->getMessage();
        }
    } else {
        echo "No se ha proporcionado ningún interés o usuario";
    }
}
?>

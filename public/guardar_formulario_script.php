<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el contenido de los textareas de CKEditor
    $descripcion = $_POST['descripcion'];
    $gancho = $_POST['gancho'];
    $intro = $_POST['intro'];
    $engage1 = $_POST['engage1'];
    $setup = $_POST['setup'];
    $engage2 = $_POST['engage2'];
    $engage3 = $_POST['engage3'];
    $climax = $_POST['climax'];
    $bajada = $_POST['bajada'];
    $desenlace = $_POST['desenlace'];
    $thumbnail_url = $_POST['miniatura'];
    echo $thumbnail_url;
    var_dump($_POST['miniatura']);


    // Verifica si se proporcionó un ID válido en la URL
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

            
            
            $target_folder = "assets/thumbnails/";

            // Obtener la extensión del archivo de la URL de la miniatura
            $extension = pathinfo($thumbnail_url, PATHINFO_EXTENSION);

            // Construir el nombre del archivo con la extensión correcta
            $filename = $target_folder . $id . "." . $extension;
            
            // Inicializar cURL
            $ch = curl_init($thumbnail_url);

            // Configurar opciones de cURL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Ejecutar la solicitud cURL
            $image_data = curl_exec($ch);

            // Verificar si la descarga fue exitosa
            if ($image_data === false) {
                
                echo "Error al descargar la miniatura.";
            } else {
                // Guardar la imagen en el servidor
                if (file_put_contents($filename, $image_data) !== false) {
                    echo "La miniatura se ha guardado correctamente en " . $filename;
                } else {
                    echo "Error al guardar la miniatura.";
                }
            }

            // Cerrar la conexión cURL
            curl_close($ch);
        // Conexión a la base de datos
        $dsn = "mysql:host=localhost;dbname=PROYECTO;charset=utf8mb4";
        $username = "PROYECTO";
        $password = "11223344";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Construir el nombre del archivo con la extensión correcta
            $extension = pathinfo($thumbnail_url, PATHINFO_EXTENSION);
            $filename = "assets/thumbnails/{$id}.{$extension}";

            // Guardar la miniatura en el servidor
            if (copy($thumbnail_url, $filename)) {
                // Prepara la consulta SQL para actualizar los datos en la tabla DETALLE
                $stmt = $pdo->prepare("UPDATE DETALLE SET DESCRIPCION = :descripcion, GANCHO = :gancho, INTRO = :intro, ENGAGE1 = :engage1, SETUP = :setup, ENGAGE2 = :engage2, ENGAGE3 = :engage3, CLIMAX = :climax, BAJADA = :bajada, DESENLACE = :desenlace, MINIATURA = :thumbnail_path WHERE ID = :id");

                // Bind values
                $stmt->bindParam(':descripcion', $descripcion);
                $stmt->bindParam(':gancho', $gancho);
                $stmt->bindParam(':intro', $intro);
                $stmt->bindParam(':engage1', $engage1);
                $stmt->bindParam(':setup', $setup);
                $stmt->bindParam(':engage2', $engage2);
                $stmt->bindParam(':engage3', $engage3);
                $stmt->bindParam(':climax', $climax);
                $stmt->bindParam(':bajada', $bajada);
                $stmt->bindParam(':desenlace', $desenlace);
                $stmt->bindParam(':thumbnail_path', $filename); // Utiliza el path de la miniatura
                $stmt->bindParam(':id', $id);

                // Ejecuta la consulta
                $stmt->execute();

                echo "Los datos se han actualizado correctamente.";
            } else {
                echo "Error al guardar la miniatura.";
            }
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al actualizar los datos en la base de datos: " . $e->getMessage();
        }
    } else {
        echo "No se proporcionó un ID válido.";
    }
}
?>

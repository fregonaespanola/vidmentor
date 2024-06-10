<?php
require 'common_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['descripcion'] ?? '';
    $gancho = $_POST['gancho'] ?? '';
    $intro = $_POST['intro'] ?? '';
    $engage1 = $_POST['engage1'] ?? '';
    $setup = $_POST['setup'] ?? '';
    $engage2 = $_POST['engage2'] ?? '';
    $engage3 = $_POST['engage3'] ?? '';
    $climax = $_POST['climax'] ?? '';
    $bajada = $_POST['bajada'] ?? '';
    $desenlace = $_POST['desenlace'] ?? '';
    $thumbnail_url = $_POST['miniatura'];
    $fecha = $_POST['fecha'] == '' ? null : $_POST['fecha'];

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $target_folder = "assets/thumbnails/";
        $extension = pathinfo($thumbnail_url, PATHINFO_EXTENSION);
        $filename = $target_folder . $id . "." . $extension;
        
        $ch = curl_init($thumbnail_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $image_data = curl_exec($ch);

        if ($image_data !== false) {
            file_put_contents($filename, $image_data);
        }

        curl_close($ch);

        $query = "UPDATE DETALLE SET DESCRIPCION = :descripcion, GANCHO = :gancho, INTRO = :intro, ENGAGE1 = :engage1, SETUP = :setup, ENGAGE2 = :engage2, ENGAGE3 = :engage3, CLIMAX = :climax, BAJADA = :bajada, DESENLACE = :desenlace, MINIATURA = :thumbnail_path, FECHA = :fecha WHERE ID = :id";
        $params = [
            ':descripcion' => $descripcion,
            ':gancho' => $gancho,
            ':intro' => $intro,
            ':engage1' => $engage1,
            ':setup' => $setup,
            ':engage2' => $engage2,
            ':engage3' => $engage3,
            ':climax' => $climax,
            ':bajada' => $bajada,
            ':desenlace' => $desenlace,
            ':thumbnail_path' => $filename,
            ':fecha' => $fecha,
            ':id' => $id
        ];

        if (executeQuery($query, $params)) {
            redirect("calendar.php", [
                'title' => "success",
                'text' => "Los datos se han actualizado correctamente.",
                'position' => 'top-end',
                'toast' => true,
                'showConfirmButton' => false,
                'timer' => 2000,
                'timerProgressBar' => true
            ]);
        } else {
            redirect('calendar.php', [
                'title' => 'error',
                'text' => 'Error al actualizar los datos. Contacta con la administración.',
                'position' => 'top-end',
                'toast' => true,
                'showConfirmButton' => false,
                'timer' => 2000,
                'timerProgressBar' => true
            ]);
        }
    } else {
        redirect('calendar.php', [
            'title' => 'error',
            'text' => 'No se proporcionó un ID válido.',
            'position' => 'top-end',
            'toast' => true,
            'showConfirmButton' => false,
            'timer' => 2000,
            'timerProgressBar' => true
        ]);
    }
}

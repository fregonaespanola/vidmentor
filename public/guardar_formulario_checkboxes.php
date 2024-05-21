<?php
// Verifica si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el valor de los campos del formulario
    $igStories = isset($_POST['igStories']) ? 1 : 0;
    $reelClips = isset($_POST['reelClips']) ? 1 : 0;
    $shareSocialMedia = isset($_POST['shareSocialMedia']) ? 1 : 0;
    $checkComments = isset($_POST['checkComments']) ? 1 : 0;
    $checkCTR = isset($_POST['checkCTR']) ? 1 : 0;
    $changeThumbnail2 = isset($_POST['changeThumbnail2']) ? 1 : 0;
    $changeTitle2 = isset($_POST['changeTitle2']) ? 1 : 0;
    $changeThumbnail3 = isset($_POST['changeThumbnail3']) ? 1 : 0;
    $changeTitle3 = isset($_POST['changeTitle3']) ? 1 : 0;
    $changeThumbnail4 = isset($_POST['changeThumbnail4']) ? 1 : 0;
    $changeTitle4 = isset($_POST['changeTitle4']) ? 1 : 0;

    // Verifica si se proporcionó un ID válido en la URL
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Conexión a la base de datos
        $dsn = "mysql:host=localhost;dbname=PROYECTO;charset=utf8mb4";
        $username = "PROYECTO";
        $password = "11223344";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepara la consulta SQL para actualizar los datos en la tabla DETALLE
            $stmt = $pdo->prepare("UPDATE DETALLE SET IG_STORIES = :igStories, REEL_CLIPS = :reelClips, SHARE_SOCIAL_MEDIA = :shareSocialMedia, CHECK_COMMENTS = :checkComments, CHECK_CTR = :checkCTR, CHANGE_THUMBNAIL_2 = :changeThumbnail2, CHANGE_TITLE_2 = :changeTitle2, CHANGE_THUMBNAIL_3 = :changeThumbnail3, CHANGE_TITLE_3 = :changeTitle3, CHANGE_THUMBNAIL_4 = :changeThumbnail4, CHANGE_TITLE_4 = :changeTitle4 WHERE ID = :id");

            // Vincula los parámetros
            $stmt->bindParam(':igStories', $igStories);
            $stmt->bindParam(':reelClips', $reelClips);
            $stmt->bindParam(':shareSocialMedia', $shareSocialMedia);
            $stmt->bindParam(':checkComments', $checkComments);
            $stmt->bindParam(':checkCTR', $checkCTR);
            $stmt->bindParam(':changeThumbnail2', $changeThumbnail2);
            $stmt->bindParam(':changeTitle2', $changeTitle2);
            $stmt->bindParam(':changeThumbnail3', $changeThumbnail3);
            $stmt->bindParam(':changeTitle3', $changeTitle3);
            $stmt->bindParam(':changeThumbnail4', $changeThumbnail4);
            $stmt->bindParam(':changeTitle4', $changeTitle4);
            $stmt->bindParam(':id', $id);

            // Ejecuta la consulta
            $stmt->execute();

            // Redirecciona a una página de éxito
            header("Location: ideas_user.php");
            exit();
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al actualizar los datos en la base de datos: " . $e->getMessage();
        }
    } else {
        echo "No se proporcionó un ID válido.";
    }
}
?>

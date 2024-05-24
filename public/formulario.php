<?php
session_start();

$_SESSION['usuario_id'] = 2;

// Verifica si se proporcionó un ID en la URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conexión a la base de datos (ajusta los detalles de conexión según tu configuración)
    $dsn = "mysql:host=localhost;dbname=PROYECTO;charset=utf8mb4";
    $username = "PROYECTO";
    $password = "11223344";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obtener los detalles del formulario basados en el ID
        $stmt = $pdo->prepare("SELECT * FROM DETALLE WHERE ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Si se encontraron resultados, rellenar el formulario con los datos obtenidos
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $titulo = $row['NOMBRE'];
          $descripcion = $row['DESCRIPCION'];
          $gancho = $row['GANCHO'];
          $intro = $row['INTRO'];
          $engage1 = $row['ENGAGE1'];
          $setup = $row['SETUP'];
          $engage2 = $row['ENGAGE2'];
          $engage3 = $row['ENGAGE3'];
          $climax = $row['CLIMAX'];
          $bajada = $row['BAJADA'];
          $desenlace = $row['DESENLACE'];

          $thumbnail_path = $row['MINIATURA'];
          if ($thumbnail_path !== 'default.jpg' && file_exists($thumbnail_path)) {
              $_SESSION['default_thumbnail'] = $thumbnail_path;
          } else {
              $_SESSION['default_thumbnail'] = null;
          }
      }
    } catch (PDOException $e) {
        echo "Error al obtener los detalles del formulario: " . $e->getMessage();
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vidmentor</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
</head>
<body>

  <div class="container mt-5">
    <h2 class="titulo-formulario-video">Formulario</h2>
    <form class="formulario-video" action="guardar_formulario_script.php?id=<?php echo $id; ?>" method="POST">
      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control title-form-inner" id="titulo" placeholder="Ingrese el título" value="<?php echo isset($titulo) ? $titulo : ''; ?>" disabled>
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" class="form-control" id="descripcion" rows="3"><?php echo isset($descripcion) ? $descripcion : ''; ?></textarea>
      </div>
      <div class="form-group">
          <label for="miniatura">Miniatura</label>
          <input type="hidden" name="miniatura" id="thumbnail_url" value="">
          <div id="thumbnails"></div>
          <!-- Agrega esto en tu HTML donde sea conveniente -->
          <div id="defaultThumbnail" data-url="<?php echo isset($_SESSION["default_thumbnail"]) ? $_SESSION["default_thumbnail"] : ""; ?>"></div>

      </div>
      <hr>
      <div class="form-group">
        <label for="acto1">Acto 1</label>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" name="gancho" id="gancho" placeholder="Gancho"><?php echo isset($gancho) ? $gancho : ''; ?></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" name="intro" id="intro" placeholder="Intro"><?php echo isset($intro) ? $intro : ''; ?></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" name="engage1" id="engage1" placeholder="Engage 1"><?php echo isset($engage1) ? $engage1 : ''; ?></textarea>
        </div>
      </div>
      <hr>
      <div class="form-group">
        <label for="acto2">Acto 2</label>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" name="setup" id="setup" placeholder="Set-up"><?php echo isset($setup) ? $setup : ''; ?></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" name="engage2" id="engage2" placeholder="Engage 2"><?php echo isset($engage2) ? $engage2 : ''; ?></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" name="engage3" id="engage3" placeholder="Engage 3"><?php echo isset($engage3) ? $engage3 : ''; ?></textarea>
        </div>
      </div>
      <hr>
      <div class="form-group">
        <label for="acto3">Acto 3</label>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" name="climax" id="climax" placeholder="Climax"><?php echo isset($climax) ? $climax : ''; ?></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" name="bajada" id="bajada" placeholder="Bajada"><?php echo isset($bajada) ? $bajada : ''; ?></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" name="desenlace" id="desenlace" placeholder="Desenlace"><?php echo isset($desenlace) ? $desenlace : ''; ?></textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>

  <script>
        var defaultThumbnailUrl = '<?php echo isset($default_thumbnail) ? $default_thumbnail : ''; ?>';
  </script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/form_script.js" data-title="<?php echo $titulo?>"></script>

</body>
</html>
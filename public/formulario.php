<?php
session_start();

$_SESSION['usuario_id'] = 2;

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
          $fecha = $row['FECHA'];
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
  <title>Formulario - Vidmentor</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
</head>
<body class="bg-gray-vidmentor-primary{">
    <div class="container mx-auto mt-10 p-5 bg-gray-vidmentor-secondary rounded-lg shadow-md">
        <form action="guardar_formulario_script.php?id=<?php echo $id; ?>" method="POST">
            <div class="mb-4">
                <label for="titulo" class="block text-md font-medium text-white">Título</label>
                <input type="text" id="titulo" class="block w-full mt-1 border-gray-300 rounded-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-md" placeholder="Ingrese el título" value="<?php echo isset($titulo) ? $titulo : ''; ?>" disabled>
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-md font-medium text-white">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="block text-white bg-gray-vidmentor-terciary w-full mt-1 border-gray-300 rounded-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-md"><?php echo isset($descripcion) ? $descripcion : ''; ?></textarea>
            </div>
            <div class="mb-4">
                <label for="fecha" class="block text-md font-medium text-white">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="block w-full text-white bg-gray-vidmentor-terciary mt-1 border-gray-300 rounded-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-md" value="<?php echo isset($fecha) ? $fecha : ''; ?>">
            </div>
            <div class="mb-4">
                <label for="miniatura" class="block text-md font-medium text-white">Miniatura</label>
                <input type="hidden" name="miniatura" id="thumbnail_url" value="">
                <div id="thumbnails" class="flex space-x-2"></div>
                <div id="defaultThumbnail" data-url="<?php echo isset($_SESSION["default_thumbnail"]) ? $_SESSION["default_thumbnail"] : ""; ?>"></div>
            </div>
            <hr class="my-4 text-gray-100">
            <div class="mb-4">
                <label for="acto1" class="block text-md font-medium text-white">Acto 1</label>
                <div class="ckeditor-container">
                    <textarea class="ckeditor w-full text-white bg-gray-vidmentor-terciary" name="gancho" id="gancho" placeholder="Gancho"><?php echo isset($gancho) ? $gancho : ''; ?></textarea><br>
                </div>
                <div class="ckeditor-container mt-2">
                    <textarea class="ckeditor w-full text-white bg-gray-vidmentor-terciary" name="intro" id="intro" placeholder="Intro"><?php echo isset($intro) ? $intro : ''; ?></textarea><br>
                </div>
                <div class="ckeditor-container mt-2">
                    <textarea class="ckeditor w-full text-white bg-gray-vidmentor-terciary" name="engage1" id="engage1" placeholder="Engage 1"><?php echo isset($engage1) ? $engage1 : ''; ?></textarea>
                </div>
            </div>
            <hr class="my-4 text-gray-100">
            <div class="mb-4">
                <label for="acto2" class="block text-md font-medium text-white">Acto 2</label>
                <div class="ckeditor-container">
                    <textarea class="ckeditor w-full text-white bg-gray-vidmentor-terciary" name="setup" id="setup" placeholder="Set-up"><?php echo isset($setup) ? $setup : ''; ?></textarea><br>
                </div>
                <div class="ckeditor-container mt-2">
                    <textarea class="ckeditor w-full text-white bg-gray-vidmentor-terciary" name="engage2" id="engage2" placeholder="Engage 2"><?php echo isset($engage2) ? $engage2 : ''; ?></textarea><br>
                </div>
                <div class="ckeditor-container mt-2">
                    <textarea class="ckeditor w-full text-white bg-gray-vidmentor-terciary" name="engage3" id="engage3" placeholder="Engage 3"><?php echo isset($engage3) ? $engage3 : ''; ?></textarea>
                </div>
            </div>
            <hr class="my-4 text-gray-100">
            <div class="mb-4">
                <label for="acto3" class="block text-md font-medium text-white">Acto 3</label>
                <div class="ckeditor-container">
                    <textarea class="ckeditor w-full text-white bg-gray-vidmentor-terciary" name="climax" id="climax" placeholder="Climax"><?php echo isset($climax) ? $climax : ''; ?></textarea><br>
                </div>
                <div class="ckeditor-container mt-2">
                    <textarea class="ckeditor w-full text-white bg-gray-vidmentor-terciary" name="bajada" id="bajada" placeholder="Bajada"><?php echo isset($bajada) ? $bajada : ''; ?></textarea><br>
                </div>
                <div class="ckeditor-container mt-2">
                    <textarea class="ckeditor w-full text-white bg-gray-vidmentor-terciary" name="desenlace" id="desenlace" placeholder="Desenlace"><?php echo isset($desenlace) ? $desenlace : ''; ?></textarea>
                </div>
            </div>
            <button type="submit" class="bg-red-vidmentor-secondary w-full text-white font-bold py-2 px-4 rounded">Enviar</button>
        </form>
    </div>

  <script>
        var defaultThumbnailUrl = '<?php echo isset($default_thumbnail) ? $default_thumbnail : ''; ?>';
  </script>

<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/form_script.js" data-title="<?php echo $titulo?>"></script>

</body>
</html>
<?php
session_start();

$_SESSION['usuario_id'] = 2;

// Valores predeterminados para los campos
$igstories_checked = "";
$reels_clips_checked = "";
$share_checked = "";
$check_comments_checked = "";
$check_ctr_checked = "";
$change_thb_2_checked = "";
$change_title_2_checked = "";
$change_thb_3_checked = "";
$change_title_3_checked = "";
$change_thb_4_checked = "";
$change_title_4_checked = "";

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
          $igstories = $row['IG_STORIES'];
          $reels_clips = $row['REEL_CLIPS'];
          $share = $row['SHARE_SOCIAL_MEDIA'];
          $check_comments = $row['CHECK_COMMENTS'];
          $check_ctr = $row['CHECK_CTR'];
          $change_thb_2 = $row['CHANGE_THUMBNAIL_2'];
          $change_title_2 = $row['CHANGE_TITLE_2'];
          $change_thb_3 = $row['CHANGE_THUMBNAIL_3'];
          $change_title_3 = $row['CHANGE_TITLE_3'];
          $change_thb_4 = $row['CHANGE_THUMBNAIL_4'];
          $change_title_4 = $row['CHANGE_TITLE_4'];

          // Verifica los valores y establece los campos como checked según corresponda
          $igstories_checked = $igstories == 1 ? "checked" : "";
          $reels_clips_checked = $reels_clips == 1 ? "checked" : "";
          $share_checked = $share == 1 ? "checked" : "";
          $check_comments_checked = $check_comments == 1 ? "checked" : "";
          $check_ctr_checked = $check_ctr == 1 ? "checked" : "";
          $change_thb_2_checked = $change_thb_2 == 1 ? "checked" : "";
          $change_title_2_checked = $change_title_2 == 1 ? "checked" : "";
          $change_thb_3_checked = $change_thb_3 == 1 ? "checked" : "";
          $change_title_3_checked = $change_title_3 == 1 ? "checked" : "";
          $change_thb_4_checked = $change_thb_4 == 1 ? "checked" : "";
          $change_title_4_checked = $change_title_4 == 1 ? "checked" : "";
      }
    } catch (PDOException $e) {
        echo "Error al obtener los detalles del formulario: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Tareas</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class="container mt-5">
    <h2 class="titulo-formulario-tareas">Formulario de Tareas</h2>
    <form class="formulario-tareas" method="post" action="guardar_formulario_checkboxes.php?id=<?php echo $id; ?>">
      <div class="form-group">
        <label for="tareas">Tareas:</label>
        <div class="form-check">
          <input class="form-check-input" name="igStories" type="checkbox" id="igStories" value="igStories" <?php echo $igstories_checked; ?>>
          <label class="form-check-label" for="igStories">
            Hacer historias de IG
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" name="reelClips" type="checkbox" id="reelClips" value="reelClips" <?php echo $reels_clips_checked; ?>>
          <label class="form-check-label" for="reelClips">
            Hacer Reels/Clips
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" name="shareSocialMedia" type="checkbox" id="shareSocialMedia" value="shareSocialMedia" <?php echo $share_checked; ?>>
          <label class="form-check-label" for="shareSocialMedia">
            Compartir en redes sociales
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" name="checkComments" type="checkbox" id="checkComments" value="checkComments" <?php echo $check_comments_checked; ?>>
          <label class="form-check-label" for="checkComments">
            Revisar comentarios
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" name="checkCTR" type="checkbox" id="checkCTR" value="checkCTR" <?php echo $check_ctr_checked; ?>>
          <label class="form-check-label" for="checkCTR">
            Después de 3h, verificar la línea de base de CTR e impresiones
          </label>
          <ul class="list-unstyled">
            <li>
              <div class="form-check">
                <input class="form-check-input" name="changeThumbnail2" type="checkbox" id="changeThumbnail2" value="changeThumbnail2" <?php echo $change_thb_2_checked; ?>>
                <label class="form-check-label" for="changeThumbnail2">
                  Si CTR e impresiones son más bajos que la línea de base → Cambiar miniatura a "Miniatura 2"
                </label>
              </div>
              <ul class="list-unstyled">
                <li>
                  <div class="form-check">
                    <input class="form-check-input" name="changeTitle2" type="checkbox" id="changeTitle2" value="changeTitle2" <?php echo $change_title_2_checked; ?>>
                    <label class="form-check-label" for="changeTitle2">
                      Si CTR e impresiones son más bajos que la línea de base → Cambiar título a "Título 2"
                    </label>
                  </div>
                  <ul class="list-unstyled">
                    <li>
                      <div class="form-check">
                        <input class="form-check-input" name="changeThumbnail3" type="checkbox" id="changeThumbnail3" value="changeThumbnail3" <?php echo $change_thb_3_checked; ?>>
                        <label class="form-check-label" for="changeThumbnail3">
                          Si CTR e impresiones son más bajos que la línea de base → Cambiar miniatura a "Miniatura 3"
                        </label>
                      </div>
                      <ul class="list-unstyled">
                        <li>
                          <div class="form-check">
                            <input class="form-check-input" name="changeTitle3" type="checkbox" id="changeTitle3" value="changeTitle3" <?php echo $change_title_3_checked; ?>>
                            <label class="form-check-label" for="changeTitle3">
                              Si CTR e impresiones son más bajos que la línea de base → Cambiar título a "Título 3"
                            </label>
                          </div>
                          <ul class="list-unstyled">
                            <li>
                              <div class="form-check">
                                <input class="form-check-input" name="changeThumbnail4" type="checkbox" id="changeThumbnail4" value="changeThumbnail4" <?php echo $change_thb_4_checked; ?>>
                                <label class="form-check-label" for="changeThumbnail4">
                                  Si CTR e impresiones son más bajos que la línea de base → Cambiar miniatura a "Miniatura 4"
                                </label>
                              </div>
                              <ul class="list-unstyled">
                                <li>
                                  <div class="form-check">
                                    <input class="form-check-input" name="changeTitle4" type="checkbox" id="changeTitle4" value="changeTitle4" <?php echo $change_title_4_checked; ?>>
                                    <label class="form-check-label" for="changeTitle4">
                                      Si CTR e impresiones son más bajos que la línea de base → Cambiar título a "Título 4"
                                    </label>
                                  </div>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/form_checkbox.js"></script>
</body>
</html>

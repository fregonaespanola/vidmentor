<?php
    require_once('common_functions.php');

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

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $pdo = getDatabaseConnection();

            $stmt = $pdo->prepare("SELECT * FROM DETALLE WHERE ID = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

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
    <link rel="icon" type="image/x-icon" href="./assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class="container mx-auto mt-5 w-full">
    <form class="w-full mx-auto bg-gray-vidmentor-secondary text-white p-6 rounded-lg shadow-md" method="post" action="guardar_formulario_checkboxes.php?id=<?php echo $id; ?>">
      <div class="mb-4">
        <label for="tareas" class="block text-4xl font-bold text-white text-left text-white font-bold">Tareas:</label><br>
        <div class="mt-2">
          <label for="igStories" class="inline-flex items-center">
            <input class="form-checkbox h-5 w-5 text-blue-600" name="igStories" type="checkbox" id="igStories" value="igStories" <?php echo $igstories_checked; ?>>
            <span class="ml-2">Hacer historias de IG</span>
          </label><br>
          <label for="reelClips" class="inline-flex items-center">
            <input class="form-checkbox h-5 w-5 text-blue-600" name="reelClips" type="checkbox" id="reelClips" value="reelClips" <?php echo $reels_clips_checked; ?>>
            <span class="ml-2">Hacer Reels/Clips</span>
          </label><br>
          <label for="shareSocialMedia" class="inline-flex items-center">
            <input class="form-checkbox h-5 w-5 text-blue-600" name="shareSocialMedia" type="checkbox" id="shareSocialMedia" value="shareSocialMedia" <?php echo $share_checked; ?>>
            <span class="ml-2">Compartir en redes sociales</span>
          </label><br>
          <label for="checkComments" class="inline-flex items-center">
            <input class="form-checkbox h-5 w-5 text-blue-600" name="checkComments" type="checkbox" id="checkComments" value="checkComments" <?php echo $check_comments_checked; ?>>
            <span class="ml-2">Revisar comentarios</span>
          </label><br>
          <label for="checkCTR" class="inline-flex items-center">
            <input class="form-checkbox h-5 w-5 text-blue-600" name="checkCTR" type="checkbox" id="checkCTR" value="checkCTR" <?php echo $check_ctr_checked; ?>>
            <span class="ml-2">Después de 3h, verificar la línea de base de CTR e impresiones</span>
          </label><br>
          <ul class="list-none ml-10">
            <li>
              <div class="form-check">
                <input class="form-checkbox h-5 w-5 text-blue-600" name="changeThumbnail2" type="checkbox" id="changeThumbnail2" value="changeThumbnail2" <?php echo $change_thb_2_checked; ?>>
                <label class="form-check-label" for="changeThumbnail2">
                  Si CTR e impresiones son más bajos que la línea de base → Cambiar miniatura a "Miniatura 2"
                </label><br>
              </div>
              <ul class="list-none ml-10">
                <li>
                  <div class="form-check">
                    <input class="form-checkbox h-5 w-5 text-blue-600" name="changeTitle2" type="checkbox" id="changeTitle2" value="changeTitle2" <?php echo $change_title_2_checked; ?>>
                    <label class="form-check-label" for="changeTitle2">
                      Si CTR e impresiones son más bajos que la línea de base → Cambiar título a "Título 2"
                    </label><br>
                  </div>
                  <ul class="list-none ml-10">
                    <li>
                      <div class="form-check">
                        <input class="form-checkbox h-5 w-5 text-blue-600" name="changeThumbnail3" type="checkbox" id="changeThumbnail3" value="changeThumbnail3" <?php echo $change_thb_3_checked; ?>>
                        <label class="form-check-label" for="changeThumbnail3">
                          Si CTR e impresiones son más bajos que la línea de base → Cambiar miniatura a "Miniatura 3"
                        </label><br>
                      </div>
                      <ul class="list-none ml-10">
                        <li>
                          <div class="form-check">
                            <input class="form-checkbox h-5 w-5 text-blue-600" name="changeTitle3" type="checkbox" id="changeTitle3" value="changeTitle3" <?php echo $change_title_3_checked; ?>>
                            <label class="form-check-label" for="changeTitle3">
                              Si CTR e impresiones son más bajos que la línea de base → Cambiar título a "Título 3"
                            </label><br>
                          </div>
                          <ul class="list-none ml-10">
                            <li>
                              <div class="form-check">
                                <input class="form-checkbox h-5 w-5 text-blue-600" name="changeThumbnail4" type="checkbox" id="changeThumbnail4" value="changeThumbnail4" <?php echo $change_thb_4_checked; ?>>
                                <label class="form-check-label" for="changeThumbnail4">
                                  Si CTR e impresiones son más bajos que la línea de base → Cambiar miniatura a "Miniatura 4"
                                </label><br>
                              </div>
                              <ul class="list-none ml-10">
                                <li>
                                  <div class="form-check">
                                    <input class="form-checkbox h-5 w-5 text-blue-600" name="changeTitle4" type="checkbox" id="changeTitle4" value="changeTitle4" <?php echo $change_title_4_checked; ?>>
                                    <label class="form-check-label" for="changeTitle4">
                                      Si CTR e impresiones son más bajos que la línea de base → Cambiar título a "Título 4"
                                    </label><br>
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
      <button type="submit" class="bg-red-vidmentor-secondary w-full text-white font-bold py-2 px-4 rounded">Enviar</button>
    </form>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/form_checkbox.js"></script>
<?php
    require_once('insertSwal.php');
?>
</body>
</html>

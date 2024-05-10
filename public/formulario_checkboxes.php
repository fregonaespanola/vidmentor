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
    <form class="formulario-tareas">
      <div class="form-group">
        <label for="tareas">Tareas:</label>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="igStories" value="igStories">
          <label class="form-check-label" for="igStories">
            Hacer historias de IG
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="reelClips" value="reelClips">
          <label class="form-check-label" for="reelClips">
            Hacer Reels/Clips
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="shareSocialMedia" value="shareSocialMedia">
          <label class="form-check-label" for="shareSocialMedia">
            Compartir en redes sociales
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="checkComments" value="checkComments">
          <label class="form-check-label" for="checkComments">
            Revisar comentarios
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="checkCTR" value="checkCTR">
          <label class="form-check-label" for="checkCTR">
            Después de 3h, verificar la línea de base de CTR e impresiones
          </label>
          <ul class="list-unstyled">
            <li>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="changeThumbnail2" value="changeThumbnail2">
                <label class="form-check-label" for="changeThumbnail2">
                  Si CTR e impresiones son más bajos que la línea de base → Cambiar miniatura a "Miniatura 2"
                </label>
              </div>
              <ul class="list-unstyled">
                <li>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="changeTitle2" value="changeTitle2">
                    <label class="form-check-label" for="changeTitle2">
                      Si CTR e impresiones son más bajos que la línea de base → Cambiar título a "Título 2"
                    </label>
                  </div>
                  <ul class="list-unstyled">
                    <li>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changeThumbnail3" value="changeThumbnail3">
                        <label class="form-check-label" for="changeThumbnail3">
                          Si CTR e impresiones son más bajos que la línea de base → Cambiar miniatura a "Miniatura 3"
                        </label>
                      </div>
                      <ul class="list-unstyled">
                        <li>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeTitle3" value="changeTitle3">
                            <label class="form-check-label" for="changeTitle3">
                              Si CTR e impresiones son más bajos que la línea de base → Cambiar título a "Título 3"
                            </label>
                          </div>
                          <ul class="list-unstyled">
                            <li>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="changeThumbnail4" value="changeThumbnail4">
                                <label class="form-check-label" for="changeThumbnail4">
                                  Si CTR e impresiones son más bajos que la línea de base → Cambiar miniatura a "Miniatura 4"
                                </label>
                              </div>
                              <ul class="list-unstyled">
                                <li>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="changeTitle4" value="changeTitle4">
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

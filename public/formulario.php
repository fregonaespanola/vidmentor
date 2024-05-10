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
    <form class="formulario-video">
      <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" placeholder="Ingrese el título">
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" id="descripcion" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="miniatura">Miniatura</label>
        <select class="form-control" id="miniatura">
          <!-- Aquí puedes agregar las opciones de miniatura -->
          <option>Miniatura 1</option>
          <option>Miniatura 2</option>
          <option>Miniatura 3</option>
        </select>
      </div>
      <hr>
      <div class="form-group">
        <label for="acto1">Acto 1</label>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" id="gancho" placeholder="Gancho"></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" id="intro" placeholder="Intro"></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" id="engage1" placeholder="Engage 1"></textarea>
        </div>
      </div>
      <hr>
      <div class="form-group">
        <label for="acto2">Acto 2</label>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" id="setup" placeholder="Set-up"></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" id="engage2" placeholder="Engage 2"></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" id="engage3" placeholder="Engage 3"></textarea>
        </div>
      </div>
      <hr>
      <div class="form-group">
        <label for="acto3">Acto 3</label>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" id="climax" placeholder="Climax"></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" id="bajada" placeholder="Bajada"></textarea><br>
        </div>
        <div class="ckeditor-container">
          <textarea class="form-control ckeditor" id="desenlace" placeholder="Desenlace"></textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/form_script.js"></script>
</body>
</html>

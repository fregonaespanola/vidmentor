<?php
session_start();
$urlCompleta = $_SERVER['REQUEST_URI'];

$errors = $_SESSION['errors'] ?? [];
require_once("load_user.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Vidmentor</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-fluid edicion">
        <h1 class="text-center text-white mt-2">Edición de usuario</h1>
        <div class="row justify-content-center mt-4">
            <div class="col-12 text-center">
                <form action="update_user.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="formType" value="updateProfile">
                    <label for="fileUpload">
                        <?php if (!empty($userData['AVATAR']) && $userData['AVATAR'] != "default.jpg") { ?>
                            <img src="<?= htmlspecialchars($userData['AVATAR']) ?>" alt="Imagen de perfil"
                                class="profile-image mx-auto img-pointer" id="imagePreview">
                        <?php } else { ?>
                            <img src="./images/default.png" alt="Imagen de perfil" class="profile-image mx-auto img-pointer"
                                id="imagePreview">
                        <?php } ?>
                    </label>

                    <input class="d-none" type="file" id="fileUpload" name="avatar"
                        onchange="previewImage(event)">

                    <div class="row mt-4 ml-5">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="lab-act" for="nick">Nombre de usuario</label>
                                <input type="text" class="form-control" id="nick" name="nick"
                                    value="<?= htmlspecialchars($userData['NICK'] ?? '') ?>">
                                <?php if (isset($errors['nick'])) { ?>
                                    <span class="error-white">
                                        <?= $errors['nick'] ?>
                                    </span>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label class="lab-act" for="mail">Email</label>
                                <input type="email" class="form-control" id="mail" name="mail"
                                    value="<?= htmlspecialchars($userData['MAIL'] ?? '') ?>">
                                <?php if (isset($errors['mail'])) { ?>
                                    <span class="error">
                                        <?= $errors['mail'] ?>
                                    </span>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label class="lab-act" for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                    value="<?= htmlspecialchars($userData['FECHA_NACIMIENTO'] ?? '') ?>">
                                <?php if (isset($errors['fecha_nacimiento'])) { ?>
                                    <span class="error">
                                        <?= $errors['fecha_nacimiento'] ?>
                                    </span>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label class="lab-act" for="interes">Intereses</label>
                                <textarea class="form-control" id="interes" name="interes"
                                    maxlength="255"><?= htmlspecialchars($userData['INTERES'] ?? '') ?></textarea>
                                <?php if (isset($errors['interes'])) { ?>
                                    <span class="error">
                                        <?= $errors['interes'] ?>
                                    </span>
                                <?php } ?>
                                <?php if (isset($errors['errors'])) { ?>
                                    <span class="error">
                                        <?= $errors['errors'] ?>
                                    </span>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label class="lab-act" for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <?php if (isset($errors['password'])) { ?>
                                    <span class="error"><?= $errors['password'] ?></span>
                                    <?php } ?>
                            </div>

                            <div class="form-group">
                                <label class="lab-act" for="confirm_password">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                <?php if (isset($errors['confirm_password'])) { ?>
                                    <span class="error"><?= $errors['confirm_password'] ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary act-button">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="js/editProfile.js"></script>
</html>

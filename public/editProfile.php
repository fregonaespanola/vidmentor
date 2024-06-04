<?php
session_start();
$urlCompleta = $_SERVER['REQUEST_URI'];

$errors = $_SESSION['errors'] ?? [];
$successMessage = $_SESSION['successMessage'] ?? '';
unset($_SESSION['successMessage']);
require_once("load_user.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Perfil - Vidmentor</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-vidmentor-primary text-white flex flex-col min-h-screen">
    <?php require_once("header-dashboard.php"); ?>

    <div class="flex flex-grow">
        <?php require_once("sidebar-dashboard.php"); ?>
        <div class="flex-grow p-6">
            <h1 class="text-4xl font-bold text-white mb-6 text-center mt-4">Edición de usuario</h1>
            <div class="max-w-3xl mx-auto bg-gray-vidmentor-secondary p-6 rounded-lg shadow-lg">
                <form action="update_user.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="formType" value="updateProfile">
                    <div class="text-center mb-4">
                        <label for="fileUpload" class="cursor-pointer">
                            <?php if (!empty($userData['AVATAR']) && $userData['AVATAR'] != "default.jpg") { ?>
                                <img src="<?= htmlspecialchars($userData['AVATAR']) ?>" alt="Imagen de perfil" class="w-32 h-32 rounded-full mx-auto" id="imagePreview">
                            <?php } else { ?>
                                <img src="./images/default.png" alt="Imagen de perfil" class="w-32 h-32 rounded-full mx-auto" id="imagePreview">
                            <?php } ?>
                        </label>
                        <input type="file" id="fileUpload" name="avatar" class="hidden" onchange="previewImage(event)">
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="nick" class="block font-semibold">Nombre de usuario</label>
                            <input type="text" id="nick" name="nick" class="w-full p-2 rounded bg-gray-vidmentor-primary border border-forms-vidmentor-gray-primary" value="<?= htmlspecialchars($userData['NICK'] ?? '') ?>">
                            <?php if (isset($errors['nick'])) { ?>
                                <span class="text-red-500 text-sm"><?= $errors['nick'] ?></span>
                            <?php } ?>
                        </div>
                        <div>
                            <label for="mail" class="block font-semibold">Email</label>
                            <input type="email" id="mail" name="mail" class="w-full p-2 rounded bg-gray-vidmentor-primary border border-forms-vidmentor-gray-primary" value="<?= htmlspecialchars($userData['MAIL'] ?? '') ?>">
                            <?php if (isset($errors['mail'])) { ?>
                                <span class="text-red-500 text-sm"><?= $errors['mail'] ?></span>
                            <?php } ?>
                        </div>
                        <div>
                            <label for="fecha_nacimiento" class="block font-semibold">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="w-full p-2 rounded bg-gray-vidmentor-primary border border-forms-vidmentor-gray-primary" value="<?= htmlspecialchars($userData['FECHA_NACIMIENTO'] ?? '') ?>">
                            <?php if (isset($errors['fecha_nacimiento'])) { ?>
                                <span class="text-red-500 text-sm"><?= $errors['fecha_nacimiento'] ?></span>
                            <?php } ?>
                        </div>
                        <div>
                            <label for="interes" class="block font-semibold">Intereses</label>
                            <textarea id="interes" name="interes" maxlength="255" class="w-full p-2 rounded bg-gray-vidmentor-primary border border-forms-vidmentor-gray-primary"><?= htmlspecialchars($userData['INTERES'] ?? '') ?></textarea>
                            <?php if (isset($errors['interes'])) { ?>
                                <span class="text-red-500 text-sm"><?= $errors['interes'] ?></span>
                            <?php } ?>
                        </div>
                        <div>
                            <label for="password" class="block font-semibold">Contraseña</label>
                            <input type="password" id="password" name="password" class="w-full p-2 rounded bg-gray-vidmentor-primary border border-forms-vidmentor-gray-primary">
                            <?php if (isset($errors['password'])) { ?>
                                <span class="text-red-500 text-sm"><?= $errors['password'] ?></span>
                            <?php } ?>
                        </div>
                        <div>
                            <label for="confirm_password" class="block font-semibold">Confirmar Contraseña</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="w-full p-2 rounded bg-gray-vidmentor-primary border border-forms-vidmentor-gray-primary">
                            <?php if (isset($errors['confirm_password'])) { ?>
                                <span class="text-red-500 text-sm"><?= $errors['confirm_password'] ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="text-center mt-6">
                        <button type="submit" class="bg-red-vidmentor-secondary hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if ($successMessage) { ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '<?= $successMessage ?>',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        </script>
    <?php } ?>
</body>
<script src="js/editProfile.js"></script>

</html>

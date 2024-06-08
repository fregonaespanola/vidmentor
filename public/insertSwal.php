<?php
    if(isset($_SESSION['swal'])){
        echo '<script src=\'https://cdn.jsdelivr.net/npm/sweetalert2@11\'></script>';
        $status = strtoupper($_SESSION['swal']['status']);
        $message = $_SESSION['swal']['message'];
        $icon = $_SESSION['swal']['status'];
        $toast = $_SESSION['swal']['toast'];
        $position = $_SESSION['swal']['position'];
        $showConfirmButton = $_SESSION['swal']['showConfirmButton'];
        $confirmButtonText = $_SESSION['swal']['confirmButtonText'];
        $timer = $_SESSION['swal']['timer'];
        $timerProgressBar = $_SESSION['swal']['timerProgressBar'];

        insertSwal($status, $message, $icon, $toast, $position, $showConfirmButton, $confirmButtonText, $timer, $timerProgressBar);

        unset($_SESSION['swal']);
    }else{
        echo '<script>console.log("No hay mensajes que mostrar.")</script>';
    }

    function insertSwal($title, $text, $icon, $toast, $position, $showConfirmButton, $confirmButtonText, $timer, $timerProgressBar): void
    {
        $title = strtoupper($title);
        $title = $title == 'SUCCESS' ? '¡ÉXITO!' : $title;
        $script = "
    Swal.fire({
        icon: '$icon',
        title: '$title',
        text: '$text',
        toast: " . json_encode($toast) . ",
        position: '$position',
        showConfirmButton: " . json_encode($showConfirmButton) . ",
        timer: $timer,
        timerProgressBar: " . json_encode($timerProgressBar) . ",
        customClass: {
            actions: 'swal-display-contents-center'
        }";

        if ($showConfirmButton) {
            $script .= ",
        confirmButtonText: '$confirmButtonText'";
        }

        $script .= "});";

        echo "<script>" . $script . "</script>";
    }





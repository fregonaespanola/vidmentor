$(document).ready(function() {
    // Función para cambiar entre las partes "Guion" y "Post-subida"
    $('#guion-tab').click(function() {
        $('#formulario-container').show();
        $('#formulario-checkboxes-container').hide();
        $(this).addClass('active');
        $('#post-subida-tab').removeClass('active');
    });

    $('#post-subida-tab').click(function() {
        $('#formulario-container').hide();
        $('#formulario-checkboxes-container').show();
        $(this).addClass('active');
        $('#guion-tab').removeClass('active');
    });
});

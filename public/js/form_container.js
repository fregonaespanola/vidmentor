$(document).ready(function() {
    $('#guion-tab').click(function() {
        $('#formulario-container').show();
        $('#formulario-checkboxes-container').hide();
        $(this).addClass('border-bottom-red-vidmentor-secondary text-white');
        $('#post-subida-tab').removeClass('border-bottom-red-vidmentor-secondary text-white');
    });

    $('#post-subida-tab').click(function() {
        $('#formulario-container').hide();
        $('#formulario-checkboxes-container').show();
        $(this).addClass('border-bottom-red-vidmentor-secondary text-white');
        $('#guion-tab').removeClass('border-bottom-red-vidmentor-secondary text-white');
    });

    // Set default form to display
    $('#guion-tab').click();
});
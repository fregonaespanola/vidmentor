$(window).on('load', function() {
    // Destruir todos los CKEditors al cargar la página
    var ckeditors = CKEDITOR.instances;
    for (var i in ckeditors) {
        ckeditors[i].destroy();
    }
});

$(document).ready(function() {
    var activeEditor = null;

    // Mostrar CKEditor cuando el textarea correspondiente está clickeado
    $('.ckeditor').click(function() {
        var textarea = $(this);
        if (activeEditor && textarea.attr('id') !== activeEditor) {
            CKEDITOR.instances[activeEditor].destroy();
        }
        activeEditor = textarea.attr('id');
        CKEDITOR.replace(activeEditor, {
            toolbar: 'Basic',
            height: 150,
            skin: 'moono-dark' // Configuración para el modo oscuro
        });
    });

    // Ocultar CKEditor cuando se hace clic fuera del textarea
    $(document).click(function(event) {
        if (!$(event.target).closest('.ckeditor-container').length) {
            if (activeEditor) {
                CKEDITOR.instances[activeEditor].destroy();
                activeEditor = null;
            }
        }
    });

    // Agrega un event listener para actualizar los textareas cuando cambia su contenido
    $('textarea').on('input', function() {
        var textarea = $(this);
        textarea.html(textarea.text());
    });
});

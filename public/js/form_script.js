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

$(document).ready(function() {
    var searchQuery = 'minecraft'; // Búsqueda por defecto

    $.get(
        'https://www.googleapis.com/youtube/v3/search', {
            part: 'snippet',
            q: searchQuery,
            key: 'AIzaSyD8bPxnG_Rr0v5bIok4iu8xAnjtOGR_ZOM',
            maxResults: 3, // Obtener solo 3 resultados
            type: 'video', // Solo obtener videos
            videoDuration: 'long', // Solo videos largos
            regionCode: 'US', // Limitar a videos en inglés (código de región de Estados Unidos)
            relevanceLanguage: 'en' // Configurar idioma de relevancia en inglés
        },
        function(data) {
            showResults(data.items);
        }
    );

    function showResults(items) {
        var thumbnailsDiv = $('#thumbnails');
        thumbnailsDiv.empty();

        items.forEach(function(item) {
            if (item.id.kind === 'youtube#video') {
                var videoId = item.id.videoId;
                var title = item.snippet.title;
                var thumbnailUrl = item.snippet.thumbnails.default.url;

                var thumbnailContainer = $('<div>').addClass('thumbnail-container');
                var thumbnailImage = $('<img>').attr('src', thumbnailUrl).addClass('thumbnail-image');
                var radioButton = $('<input>').attr({
                    type: 'radio',
                    name: 'video',
                    value: videoId
                }).addClass('radio-button');

                // Agregar evento clic a la imagen para seleccionar el radio button
                thumbnailImage.click(function() {
                    radioButton.prop('checked', true);
                });

                thumbnailContainer.append(thumbnailImage, radioButton);
                thumbnailsDiv.append(thumbnailContainer);
            }
        });
    }
});

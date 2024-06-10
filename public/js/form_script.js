$(window).on('load', function() {
    let ckeditors = CKEDITOR.instances;
    for (let i in ckeditors) {
        ckeditors[i].destroy();
    }
});

$(document).ready(function() {
    let activeEditor = null;

    $('.ckeditor').click(function() {
        let textarea = $(this);
        if (activeEditor && textarea.attr('id') !== activeEditor) {
            CKEDITOR.instances[activeEditor].destroy();
        }
        activeEditor = textarea.attr('id');
        CKEDITOR.replace(activeEditor, {
            toolbar: 'Basic',
            height: 150,
        });

        // Asegúrate de que CKEditor actualice el contenido del textarea al cambiar
        CKEDITOR.instances[activeEditor].on('change', function() {
            let editorContent = CKEDITOR.instances[activeEditor].getData();
            textarea.val(editorContent);
        });
    });

    $(document).click(function(event) {
        if (!$(event.target).closest('.ckeditor-container').length) {
            if (activeEditor) {
                CKEDITOR.instances[activeEditor].destroy();
                activeEditor = null;
            }
        }
    });

    // Funciones adicionales (por ejemplo, para búsquedas de YouTube)
    let searchQuery = $('script[src$="form_script.js"]').attr('data-title');

    $.get(
        'https://www.googleapis.com/youtube/v3/search', {
            part: 'snippet',
            q: searchQuery,
            key: 'AIzaSyD8bPxnG_Rr0v5bIok4iu8xAnjtOGR_ZOM',
            maxResults: 3,
            type: 'video',
            videoDuration: 'long',
            regionCode: 'US',
            relevanceLanguage: 'en'
        },
        function(data) {
            showResults(data.items);
            replaceThumbnailIfExists();
        }
    );

    function showResults(items) {
        let thumbnailsDiv = $('#thumbnails');
        thumbnailsDiv.empty();

        items.forEach(function(item) {
            if (item.id.kind === 'youtube#video') {
                let videoId = item.id.videoId;
                let title = item.snippet.title;
                let thumbnailUrl = item.snippet.thumbnails.default.url;

                let thumbnailContainer = $('<div>').addClass('thumbnail-container flex flex-col items-center');
                let thumbnailImage = $('<img>').attr('src', thumbnailUrl).addClass('thumbnail-image mb-2');
                let radioButton = $('<input>').attr({
                    type: 'radio',
                    name: 'video',
                    value: videoId
                }).addClass('radio-button mt-2');

                thumbnailImage.click(function() {
                    radioButton.prop('checked', true);
                    $('#thumbnail_url').val(thumbnailUrl);
                });

                thumbnailContainer.append(thumbnailImage, radioButton);
                thumbnailsDiv.append(thumbnailContainer);
            }
        });
    }

    function replaceThumbnailIfExists() {
        let firstThumbnailContainer = $('#thumbnails .thumbnail-container').first();
        let defaultThumbnailUrl = $('#defaultThumbnail').data('url');
        let firstRadioButton = firstThumbnailContainer.find('input[type="radio"]');

        if (defaultThumbnailUrl != null && defaultThumbnailUrl !== '') {
            let firstThumbnailImage = $('.thumbnail-image').first();

            firstThumbnailImage.attr('src', defaultThumbnailUrl);
            $('#thumbnail_url').val(defaultThumbnailUrl);
            firstRadioButton.prop('checked', true);
        }
    }
});

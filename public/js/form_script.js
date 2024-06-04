$(window).on('load', function() {
    var ckeditors = CKEDITOR.instances;
    for (var i in ckeditors) {
        ckeditors[i].destroy();
    }
});

$(document).ready(function() {
    var activeEditor = null;

    $('.ckeditor').click(function() {
        var textarea = $(this);
        if (activeEditor && textarea.attr('id') !== activeEditor) {
            CKEDITOR.instances[activeEditor].destroy();
        }
        activeEditor = textarea.attr('id');
        CKEDITOR.replace(activeEditor, {
            toolbar: 'Basic',
            height: 150,
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

    $('textarea').on('input', function() {
        var textarea = $(this);
        textarea.html(textarea.text());
    });

    var searchQuery = $('script[src$="form_script.js"]').attr('data-title');

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
        var thumbnailsDiv = $('#thumbnails');
        thumbnailsDiv.empty();

        items.forEach(function(item) {
            if (item.id.kind === 'youtube#video') {
                var videoId = item.id.videoId;
                var title = item.snippet.title;
                var thumbnailUrl = item.snippet.thumbnails.default.url;

                var thumbnailContainer = $('<div>').addClass('thumbnail-container flex flex-col items-center');
                var thumbnailImage = $('<img>').attr('src', thumbnailUrl).addClass('thumbnail-image mb-2');
                var radioButton = $('<input>').attr({
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
        var firstThumbnailContainer = $('#thumbnails .thumbnail-container').first();
        var defaultThumbnailUrl = $('#defaultThumbnail').data('url');
        var firstRadioButton = firstThumbnailContainer.find('input[type="radio"]');

        if (defaultThumbnailUrl != null && defaultThumbnailUrl != '') {
            var firstThumbnailImage = $('.thumbnail-image').first();

            firstThumbnailImage.attr('src', defaultThumbnailUrl);
            $('#thumbnail_url').val(defaultThumbnailUrl);
            firstRadioButton.prop('checked', true);
        }
    }
});

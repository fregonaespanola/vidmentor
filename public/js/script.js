function search() {
    var query = document.getElementById('searchQuery').value.trim();
    if (query !== '') {
        $.get(
            'https://www.googleapis.com/youtube/v3/search', {
                part: 'snippet',
                q: query,
                key: 'AIzaSyD8bPxnG_Rr0v5bIok4iu8xAnjtOGR_ZOM'
            },
            function(data) {
                showResults(data.items);
            }
        );
    }
}

function showResults(items) {
    var resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    items.forEach(function(item) {
        var title = item.snippet.title;
        var thumbnailUrl = item.snippet.thumbnails.default.url;
        var videoId = item.id.videoId;
        var videoUrl = 'https://www.youtube.com/watch?v=' + videoId;

        var videoElement = document.createElement('div');
        videoElement.innerHTML = '<h3>' + title + '</h3>' +
            '<a href="' + videoUrl + '" target="_blank">' +
            '<img src="' + thumbnailUrl + '" alt="' + title + '">' +
            '</a>';
        resultsDiv.appendChild(videoElement);
    });
}

        function search() {
            var query = document.getElementById('searchQuery').value.trim();
            if (query !== '') {
                $.get(
                    'https://www.googleapis.com/youtube/v3/search', {
                        part: 'snippet',
                        q: query,
                        key: 'AIzaSyD8bPxnG_Rr0v5bIok4iu8xAnjtOGR_ZOM',
                        maxResults: 10,
                        type: 'video',
                        videoDuration: 'long',
                        regionCode: 'US',
                        relevanceLanguage: 'en'
                    },
                    function(data) {
                        showResults(data.items);
                    }
                );
            }
        }

        async function translateTitle(titleElement, title) {
            try {
                const response = await fetch(`https://api.mymemory.translated.net/get?q=${title}&langpair=en|es`);
                const data = await response.json();
                const translatedTitle = data.responseData.translatedText;
                titleElement.textContent = translatedTitle;
            } catch (error) {
                console.error('Error translating title:', error);
            }
        }
        
        function showResults(items) {
            var resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = '';

            items.forEach(function(item) {
                if (item.id.kind === "youtube#video") {
                    var title = item.snippet.title;

                    var titleWrapper = document.createElement('div');
                    titleWrapper.classList.add('title-wrapper');

                    var titleElement = document.createElement('div');
                    titleElement.textContent = title;
                    titleElement.classList.add('title'); // Add class for styling

                    translateTitle(titleElement, title);

                    var addButton = document.createElement('button');
                    addButton.textContent = 'Añadir';
                    addButton.classList.add('add-button');
                    addButton.style.display = 'none'; // Hide the button initially

                    // Add event listener for hover effect
                    titleWrapper.addEventListener('mouseover', function() {
                        addButton.style.display = 'inline-block';
                    });

                    // Add event listener for mouseout
                    titleWrapper.addEventListener('mouseout', function() {
                        addButton.style.display = 'none';
                    });

                    // Append elements
                    titleWrapper.appendChild(titleElement);
                    titleWrapper.appendChild(addButton);
                    resultsDiv.appendChild(titleWrapper);
                }
            });
        }
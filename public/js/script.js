        function search() {
            var query = document.getElementById('searchQuery').value.trim();
            if (query !== '') {
                $.get(
                    'https://www.googleapis.com/youtube/v3/search', {
                        part: 'snippet',
                        q: query,
                        key: 'AIzaSyD8bPxnG_Rr0v5bIok4iu8xAnjtOGR_ZOM',
                        maxResults: 10, // Limitar a 10 resultados
                        type: 'video', // Solo obtener videos
                        regionCode: 'US', // Limitar a videos en inglés (código de región de Estados Unidos)
                        relevanceLanguage: 'en' // Configurar idioma de relevancia en inglés
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
                if (item.id.kind === "youtube#video") {
                    var title = item.snippet.title;
                    var titleElement = document.createElement('div');
                    titleElement.textContent = title;
                    titleElement.classList.add('title'); // Add class for styling
                    
                    var addButton = document.createElement('button');
                    addButton.textContent = 'Añadir';
                    addButton.classList.add('add-button');
                    addButton.style.display = 'none'; // Hide the button initially
                    
                    // Add event listener for hover effect on title
                    titleElement.addEventListener('mouseover', function() {
                        addButton.style.display = 'inline-block';
                    });
        
                    // Add event listener for mouseout on title
                    titleElement.addEventListener('mouseout', function() {
                        addButton.style.display = 'none';
                    });
                    
                    // Add event listener for hover effect on button
                    addButton.addEventListener('mouseover', function() {
                        addButton.style.display = 'inline-block';
                    });
        
                    // Add event listener for mouseout on button
                    addButton.addEventListener('mouseout', function() {
                        addButton.style.display = 'none';
                    });
                    
                    // Append the button to the title element
                    titleElement.appendChild(addButton);
                    
                    // Append the title element to the results div
                    resultsDiv.appendChild(titleElement);
                }
            });
        }
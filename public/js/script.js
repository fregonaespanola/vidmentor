document.addEventListener('DOMContentLoaded', function () {
    
    search(userInterest);
});

function search(query) {
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
            function (data) {
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

async function showResults(items) {
    var resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    var translationPromises = [];

    items.forEach(function (item) {
        if (item.id.kind === "youtube#video") {
            var title = item.snippet.title;

            // Filtrar títulos no deseados
            if (title.startsWith("NO QUERY") || title.startsWith("INVALID LANGUAGE") || title.startsWith("MYMEMORY")) {
                return; // Saltar este título y no mostrarlo
            }

            var titleWrapper = document.createElement('div');
            titleWrapper.classList.add('bg-gray-vidmentor-secondary', 'rounded-lg', 'shadow-md', 'p-4', 'flex', 'flex-col', 'justify-between', 'h-full');

            var titleElement = document.createElement('div');
            titleElement.textContent = title;
            titleElement.classList.add('text-white', 'font-medium', 'mb-4', 'flex-grow');

            var translationPromise = translateTitle(titleElement, title);
            translationPromises.push(translationPromise);

            var addButtonWrapper = document.createElement('div');
            addButtonWrapper.classList.add('flex', 'justify-end');

            var addButton = document.createElement('button');
            addButton.textContent = 'Añadir';
            addButton.classList.add('bg-red-vidmentor-secondary', 'text-white', 'px-4', 'py-2', 'rounded-lg');

            addButton.addEventListener('click', function () {
                addTitleToDatabase(title, addButton);
            });

            addButtonWrapper.appendChild(addButton);
            titleWrapper.appendChild(titleElement);
            titleWrapper.appendChild(addButtonWrapper);
            resultsDiv.appendChild(titleWrapper);
        }
    });

    await Promise.all(translationPromises);
    filterInvalidTitles();
}

async function addTitleToDatabase(title, button) {
    try {
        const response = await fetch(`https://api.mymemory.translated.net/get?q=${title}&langpair=en|es`);
        const data = await response.json();
        const translatedTitle = data.responseData.translatedText;

        $.ajax({
            type: 'POST',
            url: 'add_title.php',
            data: { title: translatedTitle },
            success: function (response) {
                console.log('Título añadido a la base de datos:', response);

                button.textContent = 'Añadido';
                button.classList.add('bg-red-vidmentor-secondary-2');
                
                setTimeout(function () {
                    button.textContent = 'Añadir';
                    button.classList.remove('bg-red-vidmentor-secondary-2');
                }, 1000);
            },
            error: function (xhr, status, error) {
                console.error('Error al añadir el título a la base de datos:', error);
            }
        });

        return translatedTitle;
    } catch (error) {
        console.error('Error al traducir el título:', error);
        return null;
    }
}

async function filterInvalidTitles() {
    var titleElements = document.querySelectorAll('.text-white');

    titleElements.forEach(function (titleElement) {
        var title = titleElement.textContent;
        console.log(title);

        if (title.startsWith("INVALID LANGUAGE") || title.startsWith("NO QUERY") || title.startsWith("MYMEMORY")) {
            titleElement.parentElement.style.display = 'none';
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    var copy = document.querySelector(".logos-slide").cloneNode(true);
    document.querySelector(".logos").appendChild(copy);
});




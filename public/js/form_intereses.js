var selectedInterest = '';

function nextQuestion(choice) {
    var questionsDiv = document.getElementById('questions');
    questionsDiv.innerHTML = '';

    if (choice === 'Vlogs') {
        selectedInterest = 'Vlogs';
        questionsDiv.innerHTML = `
            <div id="question2" class="text-center">
                <h2 class="text-2xl mb-4 text-white">¿Serán diarios o informativos?</h2>
                <div class="flex justify-center space-x-4">
                    <button class="btn px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none" onclick="finalQuestion('daily vlog')">Diarios</button>
                    <button class="btn px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none" onclick="showInformativeInput()">Informativos</button>
                </div>
            </div>
        `;
    } else if (choice === 'Videojuegos') {
        selectedInterest = 'Videojuegos';
        questionsDiv.innerHTML = `
            <div id="question2" class="text-center">
                <h2 class="text-2xl mb-4 text-white">¿Qué estilo?</h2>
                <div class="flex justify-center space-x-4">
                    <button class="btn px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none" onclick="finalQuestion('#videogames')">Genéricos</button>
                    <button class="btn px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none" onclick="showGameInput()">Específico</button>
                </div>
            </div>
        `;
    } else if (choice === 'Desarrollo') {
        selectedInterest = 'Desarrollo';
        questionsDiv.innerHTML = `
            <div id="question2" class="text-center">
                <h2 class="text-2xl mb-4 text-white">¿Qué tipo de desarrollo?</h2>
                <div class="flex justify-center space-x-4">
                    <button class="btn px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none" onclick="finalQuestion('programming')">Programación</button>
                    <button class="btn px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none" onclick="finalQuestion('personal development')">Personal</button>
                </div>
            </div>
        `;
    } else if (choice === 'Reacciones') {
        selectedInterest = 'Reacciones';
        questionsDiv.innerHTML = `
            <div id="question2" class="text-center">
                <h2 class="text-2xl mb-4 text-white">¿Qué tipo de reacciones?</h2>
                <div class="flex justify-center space-x-4">
                    <button class="btn px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none" onclick="finalQuestion('music')">Música</button>
                    <button class="btn px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none" onclick="finalQuestion('viral videos')">Contenido Horizontal</button>
                </div>
            </div>
        `;
    }
}

function showInformativeInput() {
    var questionsDiv = document.getElementById('questions');
    questionsDiv.innerHTML = `
        <div id="question3" class="text-center">
            <h2 class="text-2xl mb-4 text-white">¿Acerca de qué?</h2>
            <p class="text-white mb-4">Ejemplos: documentales, desarrollo personal, etc.</p>
            <input type="text" id="informativeInput" class="form-control border rounded-lg p-3 w-full mb-4" placeholder="Especifique el tipo">
            <button class="btn px-6 py-3 w-full bg-red-vidmentor-secondary text-white rounded-lg focus:outline-none" onclick="finalQuestion()">Guardar</button>
        </div>
    `;
}

function showGameInput() {
    var questionsDiv = document.getElementById('questions');
    questionsDiv.innerHTML = `
        <div id="question3" class="text-center">
            <h2 class="text-2xl mb-4 text-white">Nombre del juego</h2>
            <input type="text" id="gameInput" class="form-control border text-black rounded-lg p-3 w-full mb-4" placeholder="Escriba el nombre del juego">
            <button class="btn px-6 py-3 w-full bg-red-vidmentor-secondary text-white rounded-lg focus:outline-none" onclick="finalQuestion()">Guardar</button>
        </div>
    `;
}

async function finalQuestion(type = '') {
    if (selectedInterest === 'Vlogs' && type === '') {
        type = document.getElementById('informativeInput').value.trim();
    } else if (selectedInterest === 'Videojuegos' && type === '') {
        type = document.getElementById('gameInput').value.trim();
    }

    if (!type) {
        alert('Por favor, complete la información requerida.');
        return;
    }

    const translatedType = await translateToEnglish(type);

    saveInterestToDatabase(translatedType);
}

async function translateToEnglish(text) {
    try {
        const response = await fetch(`https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=es|en`);
        const data = await response.json();
        return data.responseData.translatedText;
    } catch (error) {
        console.error('Error translating text:', error);
        return text;
    }
}


function saveInterestToDatabase(interest) {
    const usuario_id = document.getElementById('usuario_id').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'guardar_intereses.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText.includes("éxito")) {
                localStorage.setItem('interests_changed', true);
                window.location.href = "dashboard.php";
            } else {
                alert(xhr.responseText);
            }
        }
    };
    xhr.send('interest=' + encodeURIComponent(interest) + '&usuario_id=' + encodeURIComponent(usuario_id));
}
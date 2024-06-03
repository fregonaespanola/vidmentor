var selectedInterest = '';

function nextQuestion(choice) {
    var questionsDiv = document.getElementById('questions');
    questionsDiv.innerHTML = ''; // Clear previous questions

    if (choice === 'Vlogs') {
        selectedInterest = 'Vlogs';
        questionsDiv.innerHTML = `
            <div id="question2" class="text-center">
                <h2 class="text-xl mb-4">¿Serán diarios o informativos?</h2>
                <div class="flex justify-center space-x-4">
                    <button class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="finalQuestion('daily vlog')">Diarios</button>
                    <button class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="showInformativeInput()">Informativos</button>
                </div>
            </div>
        `;
    } else if (choice === 'Videojuegos') {
        selectedInterest = 'Videojuegos';
        questionsDiv.innerHTML = `
            <div id="question2" class="text-center">
                <h2 class="text-xl mb-4">¿Qué estilo?</h2>
                <div class="flex justify-center space-x-4">
                    <button class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="finalQuestion('videogames')">Genéricos</button>
                    <button class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="showGameInput()">Específico</button>
                </div>
            </div>
        `;
    }
}

function showInformativeInput() {
    var questionsDiv = document.getElementById('questions');
    questionsDiv.innerHTML = `
        <div id="question3" class="text-center">
            <h2 class="text-xl mb-4">¿Acerca de qué?</h2>
            <p>Ejemplos: documentales, desarrollo personal, etc.</p>
            <input type="text" id="informativeInput" class="form-control border rounded p-2 w-full mb-4" placeholder="Especifique el tipo">
            <button class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="finalQuestion()">Guardar</button>
        </div>
    `;
}

function showGameInput() {
    var questionsDiv = document.getElementById('questions');
    questionsDiv.innerHTML = `
        <div id="question3" class="text-center">
            <h2 class="text-xl mb-4">Nombre del juego</h2>
            <input type="text" id="gameInput" class="form-control border rounded p-2 w-full mb-4" placeholder="Escriba el nombre del juego">
            <button class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="finalQuestion()">Guardar</button>
        </div>
    `;
}

async function finalQuestion(type = '') {
    if (selectedInterest === 'Vlogs' && type === '') {
        type = document.getElementById('informativeInput').value.trim();
    } else if (selectedInterest === 'Videojuegos' && type === '') {
        type = document.getElementById('gameInput').value.trim();
    }

    // Aquí puedes hacer la traducción del texto
    const translatedType = await translateToEnglish(type);

    // Envía el interés a la base de datos
    saveInterestToDatabase(translatedType);
}

async function translateToEnglish(text) {
    try {
        const response = await fetch(`https://api.mymemory.translated.net/get?q=${text}&langpair=es|en`);
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
            alert(xhr.responseText);
        }
    };
    xhr.send('interest=' + encodeURIComponent(interest) + '&usuario_id=' + encodeURIComponent(usuario_id));
}

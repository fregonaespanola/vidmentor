// Definir los nombres de los días de la semana
var dayNames = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];

var monthNames = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
];
$(document).ready(function() {
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth();
    var currentYear = currentDate.getFullYear();

    // Comprobar si hay una cookie guardada para la fecha del calendario
    var savedDate = getCookie("savedDate");
    if (savedDate) {
        var parts = savedDate.split("-");
        currentYear = parseInt(parts[0]);
        currentMonth = parseInt(parts[1]) - 1; // Meses en JavaScript son de 0 a 11
    }

    renderCalendar(currentMonth, currentYear);

    $('.prev-month').on('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
        saveDate(currentYear, currentMonth + 1);
    });

    $('.next-month').on('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
        saveDate(currentYear, currentMonth + 1);
    });
});

function saveDate(year, month) {
    var dateStr = year + "-" + month;
    document.cookie = "savedDate=" + dateStr;
}

function getCookie(name) {
    var cookieArr = document.cookie.split(";");
    for (var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        if (name == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

function renderCalendar(month, year) {
    var daysInMonth = new Date(year, month + 1, 0).getDate();
    var firstDayOfMonth = new Date(year, month, 1).getDay();

    var monthYearText = monthNames[month] + ' ' + year;
    $('.month-year').text(monthYearText);

    var $calendarBody = $('.calendar-body');
    $calendarBody.empty();

    // Agregar los días de la semana al calendario
    var $row = $('<div class="calendar-row"></div>');
    for (var i = 0; i < 7; i++) {
        $row.append('<div class="calendar-day">' + dayNames[i] + '</div>');
    }
    $calendarBody.append($row);

    // Iniciar la fila para los días del mes
    $row = $('<div class="calendar-row"></div>');

    // Añadir espacios en blanco para los días previos al primer día del mes
    for (var i = 0; i < firstDayOfMonth; i++) {
        $row.append('<div class="calendar-day"></div>');
    }

    // Añadir los días del mes
    for (var day = 1; day <= daysInMonth; day++) {
        var dateStr = year + '-' + (month + 1) + '-' + day;
        var $day = $('<div class="calendar-day" data-date="' + dateStr + '">' + day + '</div>');

        // Verificar si existe un registro en la base de datos para este día
        if (checkDatabaseForDate(dateStr)) {
            $day.addClass('highlighted'); // Aplicar clase CSS para resaltar el día
        }

        $row.append($day);

        if ($row.children('.calendar-day').length === 7) {
            $calendarBody.append($row);
            $row = $('<div class="calendar-row"></div>');
        }
    }

    // Si hay días restantes en la última fila, completamos con espacios en blanco
    while ($row.children('.calendar-day').length < 7) {
        $row.append('<div class="calendar-day"></div>');
    }

    $calendarBody.append($row);
}


function checkDatabaseForDate(dateStr) {
    var exists = false;

    // Realizar una solicitud AJAX para verificar si hay un registro en la base de datos para la fecha especificada
    $.ajax({
        type: 'POST',
        url: 'check_date.php', // Ruta al script PHP que maneja la verificación en la base de datos
        data: { date: dateStr },
        async: false, // Hacer la solicitud sincrónica para esperar la respuesta antes de continuar
        success: function(response) {
            exists = response === 'true'; // La respuesta debe ser 'true' o 'false'
        },
        error: function(xhr, status, error) {
            console.error('Error al verificar la fecha en la base de datos:', error);
        }
    });

    return exists;
}

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

    renderCalendar(currentMonth, currentYear);

    $('.prev-month').on('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    $('.next-month').on('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });
});
// JavaScript
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
        var $day = $('<div class="calendar-day" data-date="' + year + '-' + (month + 1) + '-' + day + '">' + day + '</div>');
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

function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
}
function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("text");
    var date = event.target.dataset.date;

    $.ajax({
        type: 'POST',
        url: 'calendar.php',
        data: { ideaId: data, date: date },
        success: function(response) {
            alert(response);
            location.reload(); // Recargar la página completa después del drag and drop
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

$(document).ready(function() {
    // Función para mostrar los títulos de las ideas cuando se hace hover sobre un día resaltado
    $(document).on('mouseenter', '.highlighted', function() {
        var $highlightedDay = $(this); // Almacena una referencia al día resaltado
        var dateStr = $highlightedDay.data('date');
        
        // Realizar una solicitud AJAX para obtener los nombres de las ideas para esta fecha
        $.ajax({
            type: 'POST',
            url: 'get_idea_name.php', // Script PHP que obtiene los nombres de las ideas
            data: { date: dateStr },
            success: function(response) {
                // Crear y mostrar el contenedor de títulos con los nombres de las ideas
                var ideas = response.split('|'); // Separar los nombres de las ideas
                var tooltipContent = '<div class="hover_mark">'; // Iniciar el contenedor
                for (var i = 0; i < ideas.length; i++) {
                    tooltipContent += '<div class="idea-title">' + ideas[i] + '</div>'; // Agregar cada título
                    if(ideas.length > 1){
                        if((i+1) != ideas.length){
                            tooltipContent += '<br>';
                        }
                    }
                }
                tooltipContent += '</div>'; // Cerrar el contenedor
                
                // Agregar el contenedor al día
                $highlightedDay.append(tooltipContent);
                
                // Calcular la altura total del tooltip
                var tooltipHeight = $('.hover_mark').outerHeight();
                
                // Ajustar la posición vertical del tooltip
                $('.hover_mark').css('top', -tooltipHeight + 'px');
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los nombres de las ideas:', error);
            }
        });
    });

    // Función para ocultar el contenedor de títulos cuando se retira el mouse del día resaltado
    $(document).on('mouseleave', '.highlighted', function() {
        $('.hover_mark').remove(); // Eliminar el contenedor
    });
});



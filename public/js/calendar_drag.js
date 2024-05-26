$(document).ready(function() {
    // Configura las áreas de soltar en el calendario
    $('.calendar-day').droppable({
        drop: function(event, ui) {
            var ideaId = ui.draggable.data('idea-id'); // Obtiene el ID de la idea arrastrada
            var date = $(this).data('date'); // Obtiene la fecha en la que se soltó la idea

            // Aquí puedes enviar una solicitud AJAX para actualizar la fecha en la base de datos
            $.post('update_idea_date.php', { ideaId: ideaId, date: date }, function(data) {
                // Maneja la respuesta del servidor si es necesario
            });
        }
    });

    // Configura las ideas para que sean arrastrables
    $('.idea').draggable({
        revert: true, // Devuelve la idea a su posición original si no se suelta en una zona de soltar válida
        cursor: 'move', // Cambia el cursor al arrastrar
        zIndex: 1000, // Asegura que las ideas arrastradas estén sobre otras capas
    });
});

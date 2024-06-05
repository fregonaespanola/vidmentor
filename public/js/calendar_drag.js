$(document).ready(function() {
    if (localStorage.getItem('showAlert') === 'true') {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'La idea se ha actualizado correctamente.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        localStorage.removeItem('showAlert');
    }
});

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
        url: 'ideas_guardadas.php',
        data: { ideaId: data, date: date },
        success: function(response) {
            localStorage.setItem('showAlert', 'true');
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

$(document).on('mouseenter', '.highlighted', function() {
    var $highlightedDay = $(this);
    var dateStr = $highlightedDay.data('date');
    
    $.ajax({
        type: 'POST',
        url: 'get_idea_name.php',
        data: { date: dateStr },
        success: function(response) {
            var ideas = response.split('|');
            var tooltipContent = '<div class="hover_mark">';
            for (var i = 0; i < ideas.length; i++) {
                tooltipContent += '<div class="idea-title">' + ideas[i] + '</div>';
                if(ideas.length > 1){
                    if((i+1) != ideas.length){
                        tooltipContent += '<br>';
                    }
                }
            }
            tooltipContent += '</div>';
            
            $highlightedDay.append(tooltipContent);
            
            var tooltipHeight = $('.hover_mark').outerHeight();
            
            $('.hover_mark').css('top', -tooltipHeight + 'px');
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los nombres de las ideas:', error);
        }
    });
});

$(document).on('mouseleave', '.highlighted', function() {
    $('.hover_mark').remove(); 
});
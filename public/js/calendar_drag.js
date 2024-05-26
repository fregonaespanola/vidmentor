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
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
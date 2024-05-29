$(document).ready(function() {

    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        var btnDelete = $(this);
        $.post('delete_title.php', { id: id }, function(data) {
            // Eliminar el elemento de la lista después de recibir una respuesta exitosa
            btnDelete.closest('li').remove();
            // Recargar la página completa para mostrar los cambios actualizados
            location.reload();
        });
    });

    $('.btn-edit').on('click', function() {
        // Código para editar la idea
    });
});

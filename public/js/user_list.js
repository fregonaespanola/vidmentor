$(document).ready(function() {
    // Manejar clic en el botón de eliminar
    $('.btn-delete').on('click', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará el registro de la base de datos.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar solicitud AJAX para eliminar el registro
                $.post('delete_title.php', { id: id }, function(data) {
                    // Manejar la respuesta del servidor
                    if (data.success) {
                        Swal.fire('Eliminado', 'El registro ha sido eliminado.', 'success');
                        // Actualizar la página después de eliminar
                        location.reload();
                    } else {
                        Swal.fire('Error', 'Hubo un error al eliminar el registro.', 'error');
                    }
                });
            }
        });
    });

    // Manejar clic en el botón de editar
    $('.btn-edit').on('click', function() {
        // Aquí puedes agregar la lógica para abrir un formulario de edición
        // Por ejemplo, mostrar un modal con un formulario prellenado con los datos actuales
    });
});

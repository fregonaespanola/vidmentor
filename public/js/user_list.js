$(document).ready(function() {

    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        var btnDelete = $(this);
        $.post('delete_title.php', { id: id }, function(data) {
                btnDelete.closest('li').remove();
        });
    });

    $('.btn-edit').on('click', function() {
    });
});

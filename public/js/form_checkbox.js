$(document).ready(function() {
    // Función para habilitar o deshabilitar los checkboxes secundarios en función del estado del checkbox principal
    function toggleSubElements() {
        var isChecked = $('#checkCTR').is(':checked');
        $('#changeThumbnail2, #changeTitle2, #changeThumbnail3, #changeTitle3, #changeThumbnail4, #changeTitle4').prop('disabled', !isChecked);
        if (!isChecked) {
            $('#changeThumbnail2, #changeThumbnail3, #changeThumbnail4').prop('checked', false);
            $('#changeTitle2, #changeTitle3, #changeTitle4').prop('checked', false);
            $('.form-check-label').css('text-decoration', 'none');
        }
    }

    // Llamar a la función al cargar la página
    toggleSubElements();

    // Llamar a la función cuando cambie el estado del checkbox principal
    $('#checkCTR').change(function() {
        toggleSubElements();
        disableNextCheckboxes();
    });

    // Función para tachar o destachar el texto según el estado del checkbox
    function tacharTexto(checkbox) {
        var label = checkbox.siblings('.form-check-label');
        if (checkbox.prop('checked')) {
            label.css('text-decoration', 'line-through');
        } else {
            label.css('text-decoration', 'none');
        }
    }

    // Agregar evento change a los checkboxes para tachar o destachar el texto
    $('.form-check-input').change(function() {
        tacharTexto($(this));
        disableNextCheckboxes();
    });

    // Función para deshabilitar los checkboxes secundarios si el checkbox anterior no está marcado
    function disableNextCheckboxes() {
        var isChecked = $('#checkCTR').is(':checked');
        var previousChecked = isChecked;
        var checkboxes = [$('#changeThumbnail2'), $('#changeTitle2'), $('#changeThumbnail3'), $('#changeTitle3'), $('#changeThumbnail4'), $('#changeTitle4')];
        checkboxes.forEach(function(checkbox, index) {
            if (index > 0 && !previousChecked) {
                checkbox.prop('disabled', true);
                checkbox.prop('checked', false);
                checkbox.siblings('.form-check-label').css('text-decoration', 'none');
            } else {
                checkbox.prop('disabled', !isChecked);
            }
            previousChecked = checkbox.prop('checked');
        });
    }

    // Deshabilitar los checkboxes secundarios al cargar la página
    disableNextCheckboxes();
});

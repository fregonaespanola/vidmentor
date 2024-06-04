$(document).ready(function() {
    function toggleSubElements() {
        var isChecked = $('#checkCTR').is(':checked');
        $('#changeThumbnail2, #changeTitle2, #changeThumbnail3, #changeTitle3, #changeThumbnail4, #changeTitle4').prop('disabled', !isChecked);
        if (!isChecked) {
            $('.form-check-label').css('text-decoration', 'none');
        }
    }

    toggleSubElements();

    $('#checkCTR').change(function() {
        toggleSubElements();
        disableNextCheckboxes();
    });

    function tacharTexto(checkbox) {
        var label = checkbox.siblings('label');
        if (checkbox.prop('checked')) {
            label.css('text-decoration');
        } else {
            label.css('text-decoration', 'none');
        }
    }

    $('.form-checkbox').change(function() {
        tacharTexto($(this));
        disableNextCheckboxes();
    });

    function disableNextCheckboxes() {
        var isChecked = $('#checkCTR').is(':checked');
        var previousChecked = isChecked;
        var checkboxes = [$('#changeThumbnail2'), $('#changeTitle2'), $('#changeThumbnail3'), $('#changeTitle3'), $('#changeThumbnail4'), $('#changeTitle4')];
        checkboxes.forEach(function(checkbox, index) {
            if (index > 0 && !previousChecked) {
                checkbox.prop('disabled', true);
                checkbox.prop('checked', false);
                checkbox.siblings('label').css('text-decoration', 'none');
            } else {
                checkbox.prop('disabled', !isChecked);
            }
            previousChecked = checkbox.prop('checked');
        });
    }

    disableNextCheckboxes();
});

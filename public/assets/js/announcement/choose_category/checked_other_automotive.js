$(document).ready(function () {
    $('#announcements_add_form_category').on('change', function () {
        var value = $(this).val();

        if (value == 9) {
            var a1 = $('#template9');
            var b1 = $('#button9');
            var b = a1.children()[0];
            var c1 = b1.children()[0];
            b.style.display = 'block';
            c1.style.display = 'block';
        }
    });
})
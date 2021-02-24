$(document).ready(function () {
    $('#announcements_add_form_category').on('change', function () {
        var value = $(this).val();

        if (value == 8) {
            var a1 = $('#template8');
            var b1 = $('#button8');
            var b = a1.children()[0];
            var c = a1.children()[1];
            var c1 = b1.children()[0];
            b.style.display = 'block';
            c.style.display = 'block';
            c1.style.display = 'block';
        }
    });
})

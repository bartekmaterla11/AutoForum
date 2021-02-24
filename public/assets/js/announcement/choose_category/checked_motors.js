$(document).ready(function () {
    $('#motors_form_name').on('change', function () {

        var a1 = $('#template2');
        var b1 = $('#button2');
        var b = a1.children()[1];
        var c = a1.children()[2];
        var c1 = b1.children()[0];
        b.style.display = 'block';
        c.style.display = 'block';
        c1.style.display = 'block';

    });
})
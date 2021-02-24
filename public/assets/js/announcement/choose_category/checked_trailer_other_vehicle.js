$(document).ready(function () {
    $('#trailer_form_name').on('change', function () {

        var a1 = $('#template7');
        var b1 = $('#button7');
        var b = a1.children()[1];
        var c = a1.children()[2];
        var c1 = b1.children()[0];
        b.style.display = 'block';
        c.style.display = 'block';
        c1.style.display = 'block';

    });
})
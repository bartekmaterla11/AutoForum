$(document).ready(function () {
    $('#tires_and_rims_form_name').on('change', function () {
        var value = $(this).val();

        var a1 = $('#template6');
        var b = a1.children()[1];
        var c = a1.children()[2];
        b.style.display = 'block';
        c.style.display = 'block';
        var z = $('#button6');
        var x = z.children()[0];
        x.style.display = 'block';

        var temp = $('.template6');
        var a = temp.children()[1];
        var b = temp.children()[2];
        var c = temp.children()[3];
        var d = temp.children()[4];
        var f = temp.children()[5];

        if(value==6){
            a.style.display = 'block';
            b.style.display = 'none';
            c.style.display = 'block';
            d.style.display = 'block';
            f.style.display = 'block';
        }
        if (value == 7){
            a.style.display = 'none';
            b.style.display = 'block';
            c.style.display = 'none';
            d.style.display = 'none';
            f.style.display = 'none';
        }
        if (value == 8){
            a.style.display = 'block';
            b.style.display = 'block';
            c.style.display = 'none';
            d.style.display = 'none';
            f.style.display = 'none';
        }
        if (value == 9){
            a.style.display = 'none';
            b.style.display = 'none';
            c.style.display = 'none';
            d.style.display = 'none';
            f.style.display = 'none';
        }
    });
})
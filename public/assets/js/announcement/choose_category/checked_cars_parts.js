$(document).ready(function () {
    $('#auto_parts_form_name').on('change', function () {
        var value = $(this).val();
        var a1 = $('#template4');
        var b1 = $('#button4');
        if (value == 3 || value == 4 || value == 19) {

            var select1 = $('#type_of_cars_parts_form_name');

            $.ajax({
                url: "/ajax/set-type-parts",
                type: "POST",
                dataType: "json",
                async: true,
                data: {
                    'id': 1,
                },
                success: function (data) {
                    if (data.array) {
                        select1.find('option').remove();
                        var tab = data.array;

                        var myselect = $('<select>');
                        myselect.append($('<option></option>').val(0).html('Wszystkie'));
                        $.each(tab, function (index, key,) {
                            myselect.append($('<option></option>').val(key.id).html(key.name));
                        });
                        select1.append(myselect.html());

                        var b = a1.children()[1];
                        var c = a1.children()[2];
                        var c1 = b1.children()[0];
                        b.style.display = 'block';
                        c.style.display = 'block';
                        c1.style.display = 'block';
                    }
                }
            });
            return false;
        }
        if (value == 5) {
            var b = a1.children()[1];
            var c = a1.children()[2];
            var c1 = b1.children()[0];
            if (c.style.display == 'block') {
                c.style.display = 'none';
            }
            b.style.display = 'block';
            c1.style.display = 'block';
        }
    });
})
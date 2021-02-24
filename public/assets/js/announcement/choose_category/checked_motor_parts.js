$(document).ready(function () {
    $('#announcements_add_form_category').on('change', function () {
        var value = $(this).val();
        var a1 = $('#template5');
        var b1 = $('#button5');

        if (value == 5) {
            var child5 = a1.children()[0];
            var child51 = a1.children()[1];
            child5.style.display = 'block';
            child51.style.display = 'block';

            var select1 = $('#type_of_motors_parts_form_name');

            $.ajax({
                url: "/ajax/set-type-parts",
                type: "POST",
                dataType: "json",
                async: true,
                data: {
                    'id': 2,
                },
                success: function (data) {
                    if (data.array) {
                        select1.find('option').remove();
                        var tab = data.array;

                        var myselect = $('<select>');
                        myselect.append($('<option></option>').val(0).html('-'));
                        $.each(tab, function (index, key,) {
                            myselect.append($('<option></option>').val(key.id).html(key.name));
                        });
                        select1.append(myselect.html());

                        var c1 = b1.children()[0];
                        c1.style.display = 'block';
                    }
                }
            });
            return false;
        }
    })
})
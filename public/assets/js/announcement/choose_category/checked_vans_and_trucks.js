$(document).ready(function () {
    $('#vans_or_trucks_form_name').on('change', function () {
        var value = $(this).val();

        console.log(value)
        if (value == 1 || value == 2) {
            var select1 = $('#mark_vans_trucks_form_name')

            var parent = $('#template3_3');
            var k = parent.children()[0];
            var l = parent.children()[1];
            k.style.display = 'none';
            l.style.display = 'none';

            var b1 = $('#button3_3');
            var c1 = b1.children()[0];
            c1.style.display = 'none';
            var g = $('#template3_3_3');
            var h = g.children()[0];
            var i = g.children()[0];
            h.style.display = 'none';
            i.style.display = 'none';
            var o = $('#button3_3_3');
            var p = o.children()[0];
            p.style.display = 'none';

            $.ajax({
                url: "/ajax/set-mark-vans-trucks",
                type: "POST",
                dataType: "json",
                async: true,
                data: {
                    'id':value,
                },
                success: function (data) {
                    if(data.array){
                        select1.find('option').remove();
                        var tab = data.array;

                        var myselect = $('<select>');
                        myselect.append($('<option></option>').val(0).html('Wszystkie'));
                        $.each(tab, function(index, key,) {
                            myselect.append( $('<option></option>').val(key.id).html(key.name) );
                        });
                        select1.append(myselect.html());

                        var a1 = $('#template3');
                        var b1 = $('#button3');
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
        if (value == 20) {
            var a1 = $('#template3');
            var b = a1.children()[1];
            var c = a1.children()[2];
            b.style.display = 'none';
            c.style.display = 'none';
            var parent = $('#template3_3');
            var k = parent.children()[0];
            var l = parent.children()[1];
            k.style.display = 'block';
            l.style.display = 'block';

            var b1 = $('#button3_3');
            var c1 = b1.children()[0];
            c1.style.display = 'block';

            var g = $('#template3_3_3');
            var h = g.children()[0];
            var i = g.children()[1];
            h.style.display = 'none';
            i.style.display = 'none';
            var o = $('#button3_3_3');
            var p = o.children()[0];
            p.style.display = 'none';
        }
        if (value == 21) {
            var a1 = $('#template3');
            var b = a1.children()[1];
            var c = a1.children()[2];
            b.style.display = 'none';
            c.style.display = 'none';
            var parent = $('#template3_3');
            var k = parent.children()[0];
            var l = parent.children()[1];
            k.style.display = 'none';
            l.style.display = 'none';

            var b1 = $('#button3_3');
            var c1 = b1.children()[0];
            c1.style.display = 'none';

            var g = $('#template3_3_3');
            var h = g.children()[0];
            var i = g.children()[1];
            h.style.display = 'block';
            i.style.display = 'block';
            var o = $('#button3_3_3');
            var p = o.children()[0];
            p.style.display = 'block';
        }
    });
})
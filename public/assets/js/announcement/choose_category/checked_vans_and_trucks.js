$(document).ready(function () {
    $('#vans_or_trucks_form_name').on('change', function () {
        var value = $(this).val();

        var a1 = $('#template3');
        var b1 = $('#button3');
        var b2 = a1.children()[1];
        var c2 = a1.children()[2];
        var c1 = b1.children()[0];
        b2.style.display = 'block';
        c2.style.display = 'block';
        c1.style.display = 'block';
        var temp = $('.template3');
        var a = temp.children()[0];
        var b = temp.children()[2];
        var c = temp.children()[3];
        var d = temp.children()[4];
        var f = temp.children()[5];
        var g = temp.children()[6];
        var h = temp.children()[7];
        var i = temp.children()[9];
        var j = temp.children()[10];

        console.log(value)
        if (value == 1 || value == 2) {
            var select1 = $('#mark_vans_trucks_form_name')

            if(value == 1) {
                a.style.display = 'block'
                b.style.display = 'block'
                c.style.display = 'block'
                d.style.display = 'block'
                f.style.display = 'block'
                g.style.display = 'block'
                h.style.display = 'none'
                i.style.display = 'block'
                j.style.display = 'block'

                $.ajax({
                    url: "/ajax/set-mark-vans-trucks",
                    type: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        'id': value,
                    },
                    success: function (data) {
                        if(data.array){
                            select1.find('option').remove();
                            var tab = data.array;

                            var myselect = $('<select>');
                            myselect.append($('<option></option>').val(0).html('-'));
                            $.each(tab, function(index, key,) {
                                myselect.append( $('<option></option>').val(key.id).html(key.name) );
                            });
                            select1.append(myselect.html());

                        }
                    }
                });
                return false;
            }
            if(value == 2) {
                a.style.display = 'block'
                b.style.display = 'block'
                c.style.display = 'block'
                d.style.display = 'block'
                f.style.display = 'block'
                g.style.display = 'block'
                h.style.display = 'block'
                i.style.display = 'block'
                j.style.display = 'block'

                $.ajax({
                    url: "/ajax/set-mark-vans-trucks",
                    type: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        'id': value,
                    },
                    success: function (data) {
                        if(data.array){
                            select1.find('option').remove();
                            var tab = data.array;

                            var myselect = $('<select>');
                            myselect.append($('<option></option>').val(0).html('-'));
                            $.each(tab, function(index, key,) {
                                myselect.append( $('<option></option>').val(key.id).html(key.name) );
                            });
                            select1.append(myselect.html());

                        }
                    }
                });
                return false;
            }
        }
        if (value == 20) {
            a.style.display = 'none'
            b.style.display = 'none'
            c.style.display = 'none'
            d.style.display = 'none'
            f.style.display = 'block'
            g.style.display = 'none'
            h.style.display = 'none'
            i.style.display = 'none'
            j.style.display = 'none'
        }
        if (value == 21) {
            a.style.display = 'none'
            b.style.display = 'none'
            c.style.display = 'none'
            d.style.display = 'none'
            f.style.display = 'none'
            g.style.display = 'none'
            h.style.display = 'none'
            i.style.display = 'none'
            j.style.display = 'none'
        }
    });
})
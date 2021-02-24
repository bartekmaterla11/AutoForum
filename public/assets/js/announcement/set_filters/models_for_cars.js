$(document).ready(function () {
    $('#markAnnounSelect').on('change', function () {
        var value = $(this).val();
        var select1 = $('#modelAnnounSelect');

        var dis = $('.modelsAnnounSelect').children()[0];
        dis.disabled=false
        console.log()

        $.ajax({
            url: "/ajax/set-models",
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

                    console.log(tab)

                    var myselect = $('<select>');
                    myselect.append($('<option></option>').val(0).html('Wszystkie'));
                    $.each(tab, function(index, key,) {
                        myselect.append( $('<option></option>').val(key.id).html(key.name) );
                    });
                    select1.append(myselect.html());
                }
            }
        });
        return false;
    });
});
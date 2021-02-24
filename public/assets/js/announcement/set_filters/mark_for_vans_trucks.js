$('#category-vans-trucks-block').on('change', function () {
    var value = $(this).val();
    var div = $('#set-vans-trucks-form');

    if (value == 1 || value == 2) {

        if (value == 1) {
            var child1 = div.children()[1];
            child1.style.display='none'
            var child2 = div.children()[2];
            child2.style.display='block'
            $('.form2').find('#lolo').children()[0].disabled=false;
            var child3 = div.children()[3];
            child3.style.display='none'
            var child4 = div.children()[4];
            child4.style.display='none'
            var child5 = div.children()[5];
            child5.style.display='none'
            var select1 = $('#mark-vans-trucks-block2');
        }
        if (value == 2) {
            var child1 = div.children()[1];
            child1.style.display='none'
            var child2 = div.children()[2];
            child2.style.display='none'
            var child3 = div.children()[3];
            child3.style.display='block'
            $('.form3').find('#lolo1').children()[0].disabled=false;
            var child4 = div.children()[4];
            child4.style.display='none'
            var child5 = div.children()[5];
            child5.style.display='none'
            var select1 = $('#mark-vans-trucks-block3');
        }

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
                }
            }
        });
        return false;
    }
    if (value == 20) {
        var child1 = div.children()[1];
        child1.style.display='none'
        var child2 = div.children()[2];
        child2.style.display='none'
        var child3 = div.children()[3];
        child3.style.display='none'
        var child4 = div.children()[4];
        child4.style.display='block'
        var child5 = div.children()[5];
        child5.style.display='none'
    }
    if (value == 21) {
        var child1 = div.children()[1];
        child1.style.display='none'
        var child2 = div.children()[2];
        child2.style.display='none'
        var child3 = div.children()[3];
        child3.style.display='none'
        var child4 = div.children()[4];
        child4.style.display='none'
        var child5 = div.children()[5];
        child5.style.display='block'
    }
    if (value == 0) {
        var child1 = div.children()[1];
        child1.style.display='block'
        var child2 = div.children()[2];
        child2.style.display='none'
        var child3 = div.children()[3];
        child3.style.display='none'
        var child4 = div.children()[4];
        child4.style.display='none'
        var child5 = div.children()[5];
        child5.style.display='none'
    }
});

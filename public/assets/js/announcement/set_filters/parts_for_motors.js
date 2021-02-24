$(document).ready(function () {
    var url = document.URL
    var parts = url.split('/');
    var last = parts[parts.length - 1];

    if(last.includes('czesci-motocyklowe')) {
        var select1 = $('#type-parts-motors-block');

        $.ajax({
            url: "/ajax/set-type-parts",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'id':2,
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

})

// $('#category-parts-cars-block').on('change', function () {
//     var value = $(this).val();
//     var div = $('#set-parts-cars-form');
//
//     if (value == 0 || value == 3 || value == 4 || value == 19) {
//
//         var child1 = div.children()[1];
//         child1.style.display='block'
//         var child2 = div.children()[2];
//         child2.style.display='none'
//
//     }
//     if (value == 5) {
//         var child1 = div.children()[1];
//         child1.style.display='none'
//         var child2 = div.children()[2];
//         child2.style.display='block'
//     }
//
// });
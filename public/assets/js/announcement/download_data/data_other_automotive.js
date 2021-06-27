$(document).ready(function () {
    $('#submit_9').on('click', function () {

        var div = $('#template9');

        var title = $('#announcements_title').children()[1];
        var titleValue = title.value;
        var categoryValue = $('#announcements_add_form_category').val()

        var price = div.find('.price_of_other_automotive_form_name');
        var child3 = price.children()[1];
        var priceValue = child3.value;

        var w = $('#description');
        var description = w.children()[1];
        var descriptionValue = description.value;

        var loc = $('#location_country_form_name');
        var locValue = loc.val();

        var lok = $('#location_form_name');
        var location1 = lok.children()[1];
        var locationValue = location1.value;

        var num = $('#number_form_name');
        var number = num.children()[1];
        var numberValue = number.value;

        var check = $('#price_arranged_other');
        var checkValue = 0;

        if(check.is(':checked') == true) {
            checkValue = 1;
        }

        console.log(locationValue)
        console.log(numberValue)
        console.log(titleValue);
        console.log(categoryValue);
        console.log(priceValue);
        console.log(descriptionValue);

        $.ajax({
            url: "/data-other-automotive/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'title': titleValue,
                'category': categoryValue,
                'price': priceValue,
                'description': descriptionValue,
                'location': locValue,
                'locationname': locationValue,
                'number': numberValue,
                'negotiation':checkValue,
            },
            success: function (data) {
                if (data.Error) {
                    var error = $('#Error');
                    var child4 = error.children()[0];

                    child4.style.display = "block";
                    child4.innerHTML = data.Error;
                }
                if (data.Message) {
                    var url = document.URL
                    var result = url.substring(0, url.lastIndexOf('/') + 1);
                    location.replace(result + '1');
                }
            }
        });
        return false;
    })
})
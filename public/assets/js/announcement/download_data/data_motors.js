$(document).ready(function () {
    $('#submit_2').on('click',function () {
        var that = $(this);
        var div = $('#template2');

        var title = $('#announcements_title').children()[1];
        var titleValue = title.value;
        var categoryValue = $('#announcements_add_form_category').val()

        var underCat = div.find('#motors_form_name');
        var underCatValue = underCat.val();

        var mark = div.find('#mark_of_motors_form_name');
        var markValue = mark.val();

        var price = div.find('.motors_price_form_name');
        var child3 = price.children()[1];
        var priceValue = child3.value;

        var year = div.find('#motors_year_form_name');
        var child = year.children()[1];
        var yearValue = child.value;

        var capacity = div.find('#power_of_motors_form_name');
        var child2 = capacity.children()[1];
        var capacityValue = child2.value;

        var condition = div.find('#technical_condition_of_motors_form_name');
        var conditionValue = condition.val();

        var country = div.find('#country_of_motor_form_name');
        var countryValue = country.val();

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

        var check = $('#price_arranged_motors');
        var checkValue = 0;

        if(check.is(':checked') == true) {
            checkValue = 1;
        }

        console.log(locationValue)
        console.log(numberValue)
        console.log(titleValue);
        console.log(categoryValue);
        console.log(underCatValue);
        console.log(markValue)
        console.log(priceValue);
        console.log(yearValue);
        console.log(capacityValue);
        console.log(conditionValue);
        console.log(countryValue);
        console.log(descriptionValue);

        $.ajax({
            url: "/data-motors/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'title':titleValue,
                'category':categoryValue,
                'underCat':underCatValue,
                'mark':markValue,
                'price':priceValue,
                'year':yearValue,
                'capacity':capacityValue,
                'condition':conditionValue,
                'country':countryValue,
                'description':descriptionValue,
                'location': locValue,
                'locationname': locationValue,
                'number':numberValue,
                'negotiation':checkValue,
            },
            success: function (data) {
                if(data.Error){
                    var error = $('#Error');
                    var child4 = error.children()[0];

                    child4.style.display = "block";
                    child4.innerHTML = data.Error;
                }
                if (data.Message){
                    var url = document.URL
                    var result = url.substring(0, url.lastIndexOf('/')+1);
                    location.replace(result + '1');
                }
            }
        });
        return false;
    })
})
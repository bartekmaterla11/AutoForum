$(document).ready(function () {
    $('#submit_4').on('click', function () {
        var that = $(this);
        var div = $('#template4');

        var title = $('#announcements_title').children()[1];
        var titleValue = title.value;
        var categoryValue = $('#announcements_add_form_category').val()

        var vehicle = div.find('#auto_parts_form_name');
        var vehicleValue = vehicle.val();

        var price = div.find('.price_of_auto_parts_form_name');
        var child3 = price.children()[1];
        var priceValue = child3.value;

        var type = div.find('#type_of_cars_parts_form_name');
        var typeValue = type.val();

        var condition = div.find('#condition_of_cars_parts_form_name');
        var conditionValue = condition.val();

        var state = div.find('#state_of_cars_parts_form_name');
        var stateValue = state.val();

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


        console.log(titleValue);
        console.log(categoryValue);
        console.log(vehicleValue)
        console.log(typeValue);
        console.log(priceValue);
        console.log(conditionValue);
        console.log(descriptionValue);
        console.log(locValue);
        console.log(locationValue)
        console.log(numberValue)

        $.ajax({
            url: "/data-cars-parts/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'title': titleValue,
                'category': categoryValue,
                'vehicle': vehicleValue,
                'price': priceValue,
                'type': typeValue,
                'state': stateValue,
                'condition': conditionValue,
                'description': descriptionValue,
                'location': locValue,
                'locationname': locationValue,
                'number': numberValue,
            },
            success: function (data) {
                if (data.Error) {
                    var error = $('#Error');
                    var child4 = error.children()[0];

                    child4.style.display = "block";
                    child4.innerHTML = data.Error;
                }
                if (data.Message) {

                    // var block = div.children()[0];
                    // console.log(div1)
                    // block.style.display='block';

                    var url = document.URL
                    var result = url.substring(0, url.lastIndexOf('/') + 1);
                    location.replace(result + '1');
                }
            }
        });
        return false;
    })
})
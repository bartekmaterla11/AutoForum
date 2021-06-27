$(document).ready(function () {
    $('#submit_1').on('click', function () {
        var div = $('#template1');

        var title = $('#announcements_title').children()[1];
        var titleValue = title.value;
        var categoryValue = $('#announcements_add_form_category').val()

        var mark = div.find('#mark_of_cars_form_name');
        var markValue = mark.val();

        var price = div.find('.price_of_cars_form_name');
        var child3 = price.children()[1];
        var priceValue = child3.value;

        var model = div.find('#model_of_cars_form_name');
        var modelValue = model.val();

        var year = div.find('#year_of_cars_form_name');
        var child = year.children()[1];
        var yearValue = child.value;

        var capacity = div.find('#capacity_of_cars_form_name');
        var child2 = capacity.children()[1];
        var capacityValue = child2.value;

        var fuel = div.find('#fuel_of_cars_form_name');
        var fuelValue = fuel.val();

        var power = div.find('#power_of_cars_form_name');
        var child5 = power.children()[1];
        var powerValue = child5.value;

        var mileage = div.find('#mileage_of_cars_form_name');
        var child1 = mileage.children()[1];
        var mileageValue = child1.value;

        var color = div.find('#color_of_cars_form_name');
        var colorValue = color.val();

        var overbody = div.find('#overbody_of_cars_form_name');
        var overbodyValue = overbody.val();

        var condition = div.find('#technical_condition_of_cars_form_name');
        var conditionValue = condition.val();

        var gearbox = div.find('#gearbox_of_cars_form_name');
        var gearboxValue = gearbox.val();

        var country = div.find('#country_of_cars_form_name');
        var countryValue = country.val();

        var handlebar = div.find('#handlebar_of_cars_form_name');
        var handlebarValue = handlebar.val();

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

        var check = $('#price_arranged_cars');
        var checkValue = 0;

        if (check.is(':checked') == true) {
            checkValue = 1;
        }

        $.ajax({
            url: "/data-cars/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'title': titleValue,
                'category': categoryValue,
                'mark': markValue,
                'price': priceValue,
                'model': modelValue,
                'year': yearValue,
                'capacity': capacityValue,
                'fuel': fuelValue,
                'power': powerValue,
                'mileage': mileageValue,
                'color': colorValue,
                'body': overbodyValue,
                'condition': conditionValue,
                'gearbox': gearboxValue,
                'country': countryValue,
                'handlebar': handlebarValue,
                'description': descriptionValue,
                'location': locValue,
                'locationname': locationValue,
                'number': numberValue,
                'negotiation': checkValue,
            },
            success: function (data) {
                if (data.Error) {
                    var error = $('#Error');
                    var child4 = error.children()[0];

                    child4.style.display = "block";
                    child4.innerHTML = data.Error;
                }
                if (data.Message) {
                    // var success = document.getElementById('success_ann');
                    // var child = success.children()[0];
                    // child.style.display = "block";
                    // child.innerHTML = data.Message;
                    var url = document.URL
                    var result = url.substring(0, url.lastIndexOf('/') + 1);
                    location.replace(result + '1');

                }
            }
        });
        return false;
    })
})

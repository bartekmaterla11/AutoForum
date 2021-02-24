$(document).ready(function () {
    $('#submit_1').on('click',function () {
        var that = $(this);
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

        // var parent1 = $('#photo-1');
        // var photo1 = parent1.children()[1];
        // var photo1Value = photo1.value;

        // var parent2 = $('#photo-2');
        // var photo2 = parent2.children()[1];
        // var photo2Value = photo2.value;
        // var parent3 = $('#photo-3');
        // var photo3 = parent3.children()[1];
        // var photo3Value = photo3.value;
        // var parent4 = $('#photo-4');
        // var photo4 = parent4.children()[1];
        // var photo4Value = photo4.value;
        // var parent5 = $('#photo-5');
        // var photo5 = parent5.children()[1];
        // var photo5Value = photo5.value;
        // var parent6 = $('#photo-6');
        // var photo6 = parent6.children()[1];
        // var photo6Value = photo6.value;
        // var parent7 = $('#photo-7');
        // var photo7 = parent7.children()[1];
        // var photo7Value = photo7.value;
        // var parent8 = $('#photo-8');
        // var photo8 = parent8.children()[1];
        // var photo8Value = photo8.value;

        // var photoTab = [];
        // var photos = [];
        // photos.push(photo1Value)
        // photos.push(photo2Value)
        // photos.push(photo3Value)
        // photos.push(photo4Value)
        // photos.push(photo5Value)
        // photos.push(photo6Value)
        // photos.push(photo7Value)
        // photos.push(photo8Value)
        //
        // for (i = 0; i < photos.length; i++){
        //
        //     if(photos[i].length > 0){
        //         photoTab.push(photos[i]);
        //     }
        // }

        // console.log(photos);
        // console.log(photoTab);

        console.log(titleValue);
        console.log(categoryValue);
        console.log(markValue)
        console.log(modelValue);
        console.log(priceValue);
        console.log(yearValue);
        console.log(capacityValue);
        console.log(fuelValue);
        console.log(powerValue);
        console.log(mileageValue);
        console.log(colorValue);
        console.log(overbodyValue);
        console.log(conditionValue);
        console.log(gearboxValue);
        console.log(countryValue);
        console.log(handlebarValue);
        console.log(descriptionValue);
        console.log(locValue);
        console.log(locationValue)
        console.log(numberValue)

        $.ajax({
            url: "/data-cars/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'title':titleValue,
                'category':categoryValue,
                'mark':markValue,
                'price':priceValue,
                'model':modelValue,
                'year':yearValue,
                'capacity':capacityValue,
                'fuel':fuelValue,
                'power':powerValue,
                'mileage':mileageValue,
                'color':colorValue,
                'body':overbodyValue,
                'condition':conditionValue,
                'gearbox':gearboxValue,
                'country':countryValue,
                'handlebar':handlebarValue,
                'description':descriptionValue,
                'location': locValue,
                'locationname': locationValue,
                'number':numberValue,
                // 'photos':photoTab,
            },
            success: function (data) {
                if(data.Error){
                    var error = $('#Error');
                    var child4 = error.children()[0];

                    child4.style.display = "block";
                    child4.innerHTML = data.Error;
                }
                if (data.Message){

                    // var block = div.children()[0];
                    // console.log(div1)
                    // block.style.display='block';

                    var url = document.URL
                    var result = url.substring(0, url.lastIndexOf('/')+1);
                    location.replace(result + '1');
                }
            }
        });
        return false;
    })
})
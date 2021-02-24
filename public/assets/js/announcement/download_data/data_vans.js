$(document).ready(function () {
    $('#submit_3').on('click',function () {
        var that = $(this);
        var div = $('#template3');

        var title = $('#announcements_title').children()[1];
        var titleValue = title.value;
        var categoryValue = $('#announcements_add_form_category').val()

        var underCat = div.find('#vans_or_trucks_form_name');
        var underCatValue = underCat.val();

        var mark = div.find('#mark_vans_trucks_form_name');
        var markValue = mark.val();

        var price = div.find('.price_of_vans_form_name');
        var child3 = price.children()[1];
        var priceValue = child3.value;

        var year = div.find('#year_vans_form_name');
        var child = year.children()[1];
        var yearValue = child.value;

        var capacity = div.find('#capacity_of_vans_form_name');
        var child2 = capacity.children()[1];
        var capacityValue = child2.value;

        var fuel = div.find('#fuel_vans_form_name');
        var fuelValue = fuel.val();

        var power = div.find('#power_of_vans_form_name');
        var child5 = power.children()[1];
        var powerValue = child5.value;

        var mileage = div.find('#mileage_of_vans_form_name');
        var child1 = mileage.children()[1];
        var mileageValue = child1.value;

        var size = div.find('#size_vans_form_name');
        var child6 = size.children()[1];
        var sizeValue = child6.value;

        var axis = div.find('#number_axis_form_name');
        var child7 = axis.children()[1];
        var axisValue = child7.value;

        var condition = div.find('#condition_of_vans_form_name');
        var conditionValue = condition.val();

        var gearbox = div.find('#gearbox_vans_form_name');
        var gearboxValue = gearbox.val();

        var country = div.find('#country_of_vans_form_name');
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


        console.log(titleValue);
        console.log(categoryValue);
        console.log(underCatValue);
        console.log(markValue)
        console.log(priceValue);
        console.log(yearValue);
        console.log(capacityValue);
        console.log(fuelValue);
        console.log(powerValue);
        console.log(mileageValue);
        console.log(conditionValue);
        console.log(gearboxValue);
        console.log(countryValue);
        console.log(descriptionValue);
        console.log(locValue);
        console.log(locationValue)
        console.log(numberValue)

        $.ajax({
            url: "/data-vans-and-trucks/ajax",
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
                'fuel':fuelValue,
                'power':powerValue,
                'mileage':mileageValue,
                'size': sizeValue,
                'axis': axisValue,
                'condition':conditionValue,
                'gearbox':gearboxValue,
                'country':countryValue,
                'description':descriptionValue,
                'location': locValue,
                'locationname': locationValue,
                'number':numberValue,
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
    $('#submit_3_3').on('click',function () {
        var that = $(this);
        var div = $('#template3_3');
        var div1 = $('#template3');

        var title = $('#announcements_title').children()[1];
        var titleValue = title.value;

        var categoryValue = $('#announcements_add_form_category').val()

        var underCat = div1.find('#vans_or_trucks_form_name');
        var underCatValue = underCat.val();

        var price = div.find('.price_of_semitrailer_form_name3');
        var child3 = price.children()[1];
        var priceValue = child3.value;

        var year = div.find('#year_semitrailer_form_name3');
        var child = year.children()[1];
        var yearValue = child.value;

        var mileage = div.find('#mileage_of_semitrailer_form_name3');
        var child1 = mileage.children()[1];
        var mileageValue = child1.value;

        var condition = div.find('#condition_of_semitrailer_form_name3');
        var conditionValue = condition.val();

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

        $.ajax({
            url: "/data-semitrailer/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'title':titleValue,
                'category':categoryValue,
                'underCat':underCatValue,
                'price':priceValue,
                'year':yearValue,
                'mileage':mileageValue,
                'condition':conditionValue,
                'description':descriptionValue,
                'location': locValue,
                'locationname': locationValue,
                'number':numberValue,
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
    $('#submit_3_3_3').on('click',function () {
        var that = $(this);
        var div = $('#template3_3_3');
        var div1 = $('#template3');

        var title = $('#announcements_title').children()[1];
        var titleValue = title.value;

        var categoryValue = $('#announcements_add_form_category').val()

        var underCat = div1.find('#vans_or_trucks_form_name');
        var underCatValue = underCat.val();

        var price = div.find('.price_of_semitrailer_form_name33');
        var child3 = price.children()[1];
        var priceValue = child3.value;

        var year = div.find('#year_semitrailer_form_name33');
        var child = year.children()[1];
        var yearValue = child.value;

        var condition = div.find('#condition_of_semitrailer_form_name33');
        var conditionValue = condition.val();

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

        $.ajax({
            url: "/data-others-vans-trucks/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'title':titleValue,
                'category':categoryValue,
                'underCat':underCatValue,
                'price':priceValue,
                'year':yearValue,
                'condition':conditionValue,
                'description':descriptionValue,
                'location': locValue,
                'locationname': locationValue,
                'number':numberValue,
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
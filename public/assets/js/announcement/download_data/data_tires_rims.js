$(document).ready(function () {
    $('#submit_6').on('click', function () {
        var that = $(this);
        var div = $('#template6');

        var title = $('#announcements_title').children()[1];
        var titleValue = title.value;
        var categoryValue = $('#announcements_add_form_category').val()

        var price = div.find('.price_of_tires_name');
        var child3 = price.children()[1];
        var priceValue = child3.value;

        var underCat = div.find('#tires_and_rims_form_name');
        var underCatValue = underCat.val();

        var vehicleTires = div.find('#vehicle_tires_form_name');
        var vehicleTiresValue = vehicleTires.val();

        var typeTires = div.find('#type_tires_form_name');
        var typeTiresValue = typeTires.val();

        var rims = div.find('#rims_tires_form_name');
        var rimsValue = rims.val();

        var inch = div.find('#inch_tires_form_name');
        var inchValue = inch.val();

        var widthTires = div.find('#width_tires_form_name');
        var widthTiresValue = widthTires.val();

        var profilTires = div.find('#profil_tires_form_name');
        var profilTiresValue = profilTires.val();

        var state = div.find('#state_tires_form_name');
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

        var check = $('#price_arranged_tires');
        var checkValue = 0;

        if(check.is(':checked') == true) {
            checkValue = 1;
        }


        console.log(titleValue);
        console.log(categoryValue);
        console.log(typeTiresValue);
        console.log(priceValue);
        console.log(stateValue);
        console.log(descriptionValue);
        console.log(locValue);
        console.log(locationValue)
        console.log(numberValue)

        $.ajax({
            url: "/data-tires-rims/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'title': titleValue,
                'category': categoryValue,
                'underCat': underCatValue,
                'price': priceValue,
                'vehicleTires': vehicleTiresValue,
                'typeTires': typeTiresValue,
                'rims': rimsValue,
                'inch': inchValue,
                'widthTires': widthTiresValue,
                'profilTires': profilTiresValue,
                'state': stateValue,
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
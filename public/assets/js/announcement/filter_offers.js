$(document).ready(function (){
    var parent1 = $('#set-cars-form')
    var mark = parent1.find('#markAnnounSelect')
    var markValue = mark.val();
    var model = $('#modelAnnounSelect')
    var modelV = model.val();
    if(markValue > 0){

        $.ajax({
            url: "/ajax/set-models",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'id':markValue,
            },
            success: function (data) {
                if(data.array){
                    var dis = $('.modelsAnnounSelect').children()[0];
                    dis.disabled=false

                    var select1 = $('#modelAnnounSelect');
                    select1.find('option').remove();
                    var tab = data.array;

                    var myselect = $('<select>');
                    myselect.append($('<option></option>').val(0).html('Wszystkie'));
                    $.each(tab, function(index, key,) {
                        if (modelV === key.id) {
                            myselect.append( $('<option></option>').val(key.id).html(key.name).attr('selected', 'selected'));
                        } else {
                            myselect.append( $('<option></option>').val(key.id).html(key.name) );
                        }
                    });
                    select1.append(myselect.html());
                }
            }
        });
        return false;
    }
    $('#check_filters').on('click', function () {

        var cat = $('#categoryAnnounSelect').val()

        // set-cars
        var locationValue = $('#location');

        if(cat == 1){
            var markValue = $('#markAnnounSelect').val();

            var modelV = $('#modelAnnounSelect').val();

            var priceFvalue = $('#cars_price_from').children()[0].value;
            var priceTvalue = $('#cars_price_to').children()[0].value;

            var yearF = $('#cars_year_from').children()[0].value;
            var yearT = $('#cars_year_to').children()[0].value;

            var capF = $('#cars_cap_from').children()[0].value;
            var capT = $('#cars_cap_to').children()[0].value;

            var milF = $('#cars_mil_from').children()[0].value;
            var milT = $('#cars_mil_to').children()[0].value;

            var powF = $('#cars_pow_from').children()[0].value;
            var powT = $('#cars_pow_to').children()[0].value;

            var fuel =  $('#fuel-cars-block');
            var gearbox =  $('#gearbox-cars-block');
            var body =  $('#body-cars-block');
            var country =  $('#country-cars-block')
            var color =  $('#color-cars-block')
            var handlebar =  $('#handlebar-cars-block')
            var condition =  $('#condition-cars-block')

            console.log(yearF)
            if (locationValue.val() > 0){
                locationValue.attr('name','location')
            }
            if(markValue > 0){
                mark.attr('name','mark')
            }
            if(modelV > 0){
                model.attr('name','model')
            }
            if(parseInt(priceFvalue) > 0){
                $('#cars_price_from1').attr('name','price_from')
            }
            if(parseInt(priceTvalue) > 0){
                $('#cars_price_to1').attr('name','price_to')
            }
            if(parseInt(yearF) > 0){
                $('#cars_year_from1').attr('name','year_from')
            }
            if(parseInt(yearT) > 0){
                $('#cars_year_to1').attr('name','year_to')
            }
            if(parseInt(capF) > 0){
                $('#cars_cap_from1').attr('name','capacity_from')
            }
            if(parseInt(capT) > 0){
                $('#cars_cap_to1').attr('name','capacity_to')
            }
            if(parseInt(milF) > 0){
                $('#cars_mil_from1').attr('name','mileage_from')
            }
            if(parseInt(milT) > 0){
                $('#cars_mil_to1').attr('name','mileage_to')
            }
            if(parseInt(powF) > 0){
                $('#cars_pow_from1').attr('name','power_from')
            }
            if(parseInt(powT) > 0){
                $('#cars_pow_to1').attr('name','power_to')
            }
            if(fuel.val() > 0){
                fuel.attr('name','fuel')
            }
            if(gearbox.val() > 0){
                gearbox.attr('name','gearbox')
            }
            if(body.val() > 0){
                body.attr('name','body')
            }
            if(country.val() > 0){
                country.attr('name','country')
            }
            if(handlebar.val() > 0){
                handlebar.attr('name','handlebar')
            }
            if(color.val() > 0){
                color.attr('name','color')
            }
            if(condition.val() > 0){
                condition.attr('name','condition')
            }
        }

        //set-motors
        if(cat == 2){
            var childCat = $('#category-motors-block')
            var markMValue = $('#mark-motors-block')
            var priceFvalue1 = $('#motors_price_from').children()[0].value;
            var priceTvalue1 = $('#motors_price_to').children()[0].value;
            var yearF1 = $('#motors_year_from').children()[0].value;
            var yearT1 = $('#motors_year_to').children()[0].value;

            var capF1 = $('#motors_cap_from').children()[0].value;
            var capT1 = $('#motors_cap_to').children()[0].value;
            var country1 =  $('#country-motors-block')
            var condition1 =  $('#condition-motors-block')

            if(childCat.val() > 0){
                childCat.attr('name','category')
            }
            if(markMValue.val() > 0){
                markMValue.attr('name','mark_motors')
            }
            if(parseInt(priceFvalue1) > 0){
                $('#motors_price_from1').attr('name','price_from')
            }
            if(parseInt(priceTvalue1) > 0){
                $('#motors_price_to1').attr('name','price_to')
            }
            if(parseInt(yearF1) > 0){
                $('#motors_year_from1').attr('name','year_from')
            }
            if(parseInt(yearT1) > 0){
                $('#motors_year_to1').attr('name','year_to')
            }
            if(parseInt(capF1) > 0){
                $('#motors_cap_from1').attr('name','capacity_from')
            }
            if(parseInt(capT1) > 0){
                $('#motors_cap_to1').attr('name','capacity_to')
            }
            if(country1.val() > 0){
                country1.attr('name','country')
            }
            if(condition1.val() > 0){
                condition1.attr('name','condition')
            }
        }

        //set-vans-and-trucks
        if(cat == 3){
            var childCat1 = $('#category-vans-trucks-block')
            var markVTValue = $('#mark-vans-trucks-block')
            var priceFvalue2 = $('#vans_price_from').children()[0].value;
            var priceTvalue2 = $('#vans_price_to').children()[0].value;
            var yearF2 = $('#vans_year_from').children()[0].value;
            var yearT2 = $('#vans_year_to').children()[0].value;

            var capF2 = $('#vans_cap_from').children()[0].value;
            var capT2 = $('#vans_cap_to').children()[0].value;
            var milF2 = $('#vans_mil_from').children()[0].value;
            var milT2 = $('#vans_mil_to').children()[0].value;

            var powF2 = $('#vans_pow_from').children()[0].value;
            var powT2 = $('#vans_pow_to').children()[0].value;

            var fuel2 =  $('#fuel-vans-trucks-block');
            var sizeF = $('#vans_size_from')
            var sizeT = $('#vans_size_to')
            var axisF = $('#vans_axis_from')
            var axisT = $('#vans_axis_to')
            var gearbox2 =  $('#gearbox-vans-block');
            var country2 =  $('#country-vans-trucks-block')
            var condition2 =  $('#condition-vans-trucks-block')

            if(childCat1.val() > 0){
                childCat1.attr('name','category')
            }
            if(markVTValue.val() > 0){
                markVTValue.attr('name','mark')
            }
            if(parseInt(priceFvalue2) > 0){
                $('#vans_price_from1').attr('name','price_from')
            }
            if(parseInt(priceTvalue2) > 0){
                $('#vans_price_to1').attr('name','price_to')
            }
            if(parseInt(yearF2) > 0){
                $('#vans_year_from1').attr('name','year_from')
            }
            if(parseInt(yearT2) > 0){
                $('#vans_year_to1').attr('name','year_to')
            }
            if(parseInt(capF2) > 0){
                $('#vans_cap_from1').attr('name','capacity_from')
            }
            if(parseInt(capT2) > 0){
                $('#vans_cap_to1').attr('name','capacity_to')
            }
            if(parseInt(milF2) > 0){
                $('#cars_mil_from1').attr('name','mileage_from')
            }
            if(parseInt(milT2) > 0){
                $('#cars_mil_to1').attr('name','mileage_to')
            }
            if(parseInt(powF2) > 0){
                $('#cars_pow_from1').attr('name','power_from')
            }
            if(parseInt(powT2) > 0){
                $('#cars_pow_to1').attr('name','power_to')
            }
            if(parseInt(sizeF) > 0){
                $('#vans_size_from1').attr('name','size_from')
            }
            if(parseInt(sizeT) > 0){
                $('#vans_size_to1').attr('name','size_to')
            }
            if(parseInt(axisF) > 0){
                $('#vans_axis_from1').attr('name','axis_from')
            }
            if(parseInt(axisT) > 0){
                $('#vans_axis_to1').attr('name','axis_to')
            }
            if(fuel2.val() > 0){
                fuel2.attr('name','fuel')
            }
            if(gearbox2.val() > 0){
                gearbox2.attr('name','gearbox')
            }
            if(country2.val() > 0){
                country2.attr('name','country')
            }
            if(condition2.val() > 0){
                condition2.attr('name','condition')
            }
        }

        //set-parts-car
        if( cat == 4){
            var vehicle =  $('#category-parts-cars-block')
            var type =  $('#type-parts-cars-block')
            var priceFvalue3 = $('#parts_cars_price_from').children()[0].value;
            var priceTvalue3 = $('#parts_cars_price_to').children()[0].value;
            var state = $('#state-parts-cars-block')

            if(vehicle.val() > 0){
                vehicle.attr('name','vehicle')
            }
            if(type.val() > 0){
                type.attr('name','type')
            }
            if(parseInt(priceFvalue3) > 0){
                $('#parts_cars_price_from1').attr('name','price_from')
            }
            if(parseInt(priceTvalue3) > 0){
                $('#parts_cars_price_to1').attr('name','price_to')
            }
            if(state.val() > 0){
                state.attr('name','state')
            }

        }
        //set-parts-motors
        if( cat == 5){
            var type1 =  $('#type-parts-motors-block')
            var priceFvalue4 = $('#parts_motors_price_from').children()[0].value;
            var priceTvalue4 = $('#parts_motors_price_to').children()[0].value;
            var state1 = $('#state-parts-motors-block')

            if(type1.val() > 0){
                type1.attr('name','type')
            }
            if(parseInt(priceFvalue4) > 0){
                $('#parts_motors_price_from1').attr('name','price_from')
            }
            if(parseInt(priceTvalue4) > 0){
                $('#parts_motors_price_to1').attr('name','price_to')
            }
            if(state1.val() > 0){
                state1.attr('name','state')
            }
        }

        //set-tires-and-rims
        if( cat == 6){
            var priceFvalue5 = $('#tires_price_from').children()[0].value;
            var priceTvalue5 = $('#tires_price_to').children()[0].value;
            var state3 = $('#state-tires-rims-block')
            var vehicle1 =  $('#vehicle-tires-rims-block')
            var type2 =  $('#type-tires-rims-block')
            var inch =  $('#inch-tires-rims-block')
            var width =  $('#width-tires-rims-block')
            var profil =  $('#profil-tires-rims-block')
            var rims =  $('#rims-tires-rims-block')

            if(parseInt(priceFvalue5) > 0){
                $('#tires_price_from1').attr('name','price_from')
            }
            if(parseInt(priceTvalue5) > 0){
                $('#tires_price_to1').attr('name','price_to')
            }
            if(state3.val() > 0){
                state3.attr('name','state')
            }
            if(vehicle1.val() > 0){
                vehicle1.attr('name','vehicle')
            }
            if(type2.val() > 0){
                type2.attr('name','type-tires')
            }
            if(inch.val() > 0){
                inch.attr('name','inch')
            }
            if(width.val() > 0){
                width.attr('name','width-tires')
            }
            if(profil.val() > 0){
                profil.attr('name','profil-tires')
            }
            if(rims.val() > 0){
                rims.attr('name','type-rims')
            }

        }

        //set-trailers-other-vehicles
        if( cat == 7){
            var priceFvalue6 = $('#trailers_price_from').children()[0].value;
            var priceTvalue6 = $('#trailers_price_to').children()[0].value;
            var con3 = $('#condition-trailers-block')
            var yearF4 = $('#trailers_year_from').children()[0].value;
            var yearT4 = $('#trailers_year_to').children()[0].value;

            if(parseInt(priceFvalue6) > 0){
                $('#trailers_price_from1').attr('name','price_from')
            }
            if(parseInt(priceTvalue6) > 0){
                $('#trailers_price_to1').attr('name','price_to')
            }
            if(con3.val() > 0){
                con3.attr('name','condition')
            }
            if(parseInt(yearF4) > 0){
                $('#trailers_year_from1').attr('name','year_from')
            }
            if(parseInt(yearT4) > 0){
                $('#trailers_year_to1').attr('name','year_to')
            }
        }

        //set-electronic-equipments
        if( cat == 8){
            var priceFvalue7 = $('#electronic_equipment_price_from').children()[0].value;
            var priceTvalue7 = $('#electronic_equipment_price_to').children()[0].value;
            var state4 = $('#state-electronic-equipment-block')

            if(parseInt(priceFvalue7) > 0){
                $('#electronic_equipment_price_from1').attr('name','price_from')
            }
            if(parseInt(priceTvalue7) > 0){
                $('#electronic_equipment_price_to1').attr('name','price_to')
            }
            if(state4.val() > 0){
                state4.attr('name','state')
            }
        }

        //set-other-automotive
        if( cat == 9){
            var priceFvalue8 = $('#other_automotive_price_from').children()[0].value;
            var priceTvalue8 = $('#other_automotive_price_to').children()[0].value;

            if(parseInt(priceFvalue8) > 0){
                $('#other_automotive_price_from1').attr('name','price_from')
            }
            if(parseInt(priceTvalue8) > 0){
                $('#other_automotive_price_to1').attr('name','price_to')
            }
        }

    })
})
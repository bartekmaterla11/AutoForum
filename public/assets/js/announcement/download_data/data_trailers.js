$(document).ready(function () {
    $('#submit_7').on('click', function () {

        var div = $('#template7');

        var title = $('#announcements_title').children()[1];
        var titleValue = title.value;
        var categoryValue = $('#announcements_add_form_category').val()

        var underCat = div.find('#trailer_form_name');
        var underCatValue = underCat.val();

        var price = div.find('.price_of_trailer_form_name');
        var child3 = price.children()[1];
        var priceValue = child3.value;

        var year = div.find('#year_of_trailer_form_name');
        var child = year.children()[1];
        var yearValue = child.value;

        var state = div.find('#state_of_trailer_form_name');
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

        console.log(locationValue)
        console.log(numberValue)
        console.log(titleValue);
        console.log(categoryValue);
        console.log(underCatValue);
        console.log(priceValue);
        console.log(yearValue);
        console.log(descriptionValue);

        $.ajax({
            url: "/data-trailer-other-vehicles/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'title': titleValue,
                'category': categoryValue,
                'underCat': underCatValue,
                'price': priceValue,
                'year': yearValue,
                'state': stateValue,
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
                    var url = document.URL
                    var result = url.substring(0, url.lastIndexOf('/') + 1);
                    location.replace(result + '1');
                }
            }
        });
        return false;
    })
})
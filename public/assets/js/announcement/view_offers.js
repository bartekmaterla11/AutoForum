$(document).ready(function () {
    $('#listType').on('click', function () {
        var value = 1;

        $(this).children()[0].style.color = 'rgb(255, 255, 255)'
        $('#groupType').children()[0].style.color = '#9c9b99'
        console.log(value)
        $.ajax({
            url: document.URL,
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'valueType': value
            },
            success: function (data) {}
        });
        return false;
    })
    $('#groupType').on('click', function () {
        var value = 2;
        console.log(value)

        // $(this).children()[0].style.color = 'rgb(255, 255, 255)'
        // $('#listType').children()[0].style.color = '#9c9b99'
        $.ajax({
            url: document.URL,
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'type': value
            },
            success: function (data) {}
        });

    })
    // $('#sortOffers').click(function () {
    //     var value = $(this).val()
    //     console.log(value)
    //     $.ajax({
    //         url: document.URL,
    //         type: "POST",
    //         dataType: "json",
    //         async: true,
    //         data: {
    //             'sort': value
    //         },
    //         success: function (data) {}
    //     });
    // })
})
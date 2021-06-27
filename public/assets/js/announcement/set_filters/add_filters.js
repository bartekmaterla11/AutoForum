$(document).ready(function () {
    $('.form_filters').on('click', function (){

        $.ajax({
            url: document.URL,
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'id': 1,
            },
            success: function (data) {
            }
        });
        return false;
    })
})
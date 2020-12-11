$(document).ready(function() {
    $('#like_down').on('click', function () {

        $.ajax({
            url: "/like/ajax",
            type: "POST",
            async: true,

            success: function (data) {

            }

        });
        return false;
    });
});

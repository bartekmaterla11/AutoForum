$(document).ready(function() {
    $('#like_up').on('click', function (event) {
        event.stopPropagation();
        var that = $(this);
        var id = that.data("id")

        $.ajax({
            url: "/like/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                "mark": id
            },
            success: function (data) {
            }

        });
        return false;
    });
});

$(document).ready(function() {
    $('#like_down').on('click', function () {
        that.data("id")
        var remove = that.data("id")

        $.ajax({
            url: "/like/ajax",
            type: "POST",
            async: true,

            success: function (data) {
                var divMain = $('div#main');
                divMain.html(data);
                divMain.attr({
                });
            }

        });
        return false;
    });
});

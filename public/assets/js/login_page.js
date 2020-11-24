$(document).ready(function() {
    $('#login').on('click', function (event) {
        event.stopPropagation();
        that = $(this);

        $.ajax({
            url: "/login/ajax",
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



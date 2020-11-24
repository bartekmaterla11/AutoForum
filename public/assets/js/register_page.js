$(document).ready(function() {
    $('#register').on('click', function (event) {
        event.stopPropagation();
        that = $(this);

        $.ajax({
            url: "/forum/register/ajax",
            type: "POST",
            async: true,
            success: function (data) {
                var divMain = $('div#main');
                divMain.html(data);
            }
        });
        return false;
    });
});
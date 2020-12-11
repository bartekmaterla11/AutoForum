$(document).ready(function(){
    $.ajax({
        url: "/infos/ajax",
        type: "POST",
        async: true,
        success: function (data) {
            var divMain = $('div#app_info');
            divMain.html(data);
        }
    });
    return false;
});
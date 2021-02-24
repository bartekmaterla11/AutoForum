$(document).ready(function () {
    var all = $('#categoryAnnouncementsSelect');
    var click = all.find("a");

    var url1 = document.URL
    var parts1 = url1.split('/');
    var announ1 = parts1[parts1.length - 1];

    click.click( function () {
        var value = $(this).data('value');
        console.log(value)
        $.ajax({
            url: "/ogloszenia/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                "value": value,
            },
            success: function (data) {
                var url = document.URL
                console.log(url)
                var parts = url.split('/');
                var announ = parts[parts.length - 1];

                if ( announ.length > 3) {
                    var result1 = url.substring(0, url.lastIndexOf('/')+1);
                    location.replace(result1 + data.categorySlug);
                }
                if ( announ != '1' && announ.length < 3 ) {

                    var par = url.substring(0, url.lastIndexOf('/')+1);
                    location.replace(par + '1' + '/' +  data.categorySlug  );
                } else {
                    if (announ.includes('1')) {
                        location.replace(url + '/' + data.categorySlug);
                    } else {
                        var result = url.substring(0, url.lastIndexOf('/') + 1);
                        location.replace(result + data.categorySlug);
                    }
                }
            }
        });
        return false;
    })
})
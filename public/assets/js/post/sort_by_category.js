$(document).ready(function () {
    $('#categoryPostSelect').on('change', function () {
        var value = $(this).val();

        $.ajax({
            url: "/forum/category/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                "option": value,
            },
            success: function (data) {
                var url3 = document.URL
                var url = url3.split("?")[0];
                var parts = url.split('/');
                var page = parts[parts.length - 1];
                console.log(page)

                if ( page.length > 3) {
                    console.log('adasda')
                    var result = url.substring(0, url.lastIndexOf('/')+1);
                    console.log(result)
                    location.replace(result + data.categorySlug);
                }

                if ( page != '1' && page.length < 3 ) {

                    var par = url.substring(0, url.lastIndexOf('/')+1);
                    location.replace(par + '1' + '/' +  data.categorySlug  );
                } else {
                    if (page.includes('1')) {
                        location.replace(url + '/' +  data.categorySlug  );
                    } else {
                        var result1 = url.substring(0, url.lastIndexOf('/')+1);
                        location.replace(result1 + data.categorySlug);
                    }
                }
            }
        });
        return false;
    });
})
$(document).ready(function () {
    $('#categorySelect').on('change', function () {
        var value = $(this).val();

        console.log($(this).find('option:active').attr('selected'));
        console.log(document.URL)
        $.ajax({
            url: "/forum/category/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                "option": value,
            },
            success: function (data) {
                var url = document.URL
                var parts = url.split('/');
                var forum = parts[parts.length - 1];

                if (forum.includes('forum')) {
                    location.replace(url + '/' + data.categorySlug);
                } else {
                    var result = url.substring(0, url.lastIndexOf('/')+1);
                    location.replace(result + data.categorySlug);
                }
            }
        });
        return false;
    });
})
$(document).ready(function () {
    $('#categoryAnnounSelect').on('change', function () {
        var value = $(this).val();

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
                var parts = url.split('/');
                var announ = parts[parts.length - 1];

                if (announ == '1') {
                    location.replace(url + '/' + data.categorySlug);

                } else {
                    var result = 'http://127.0.0.1:8000/ogloszenia/1/';
                    location.replace(result + data.categorySlug);
                }
            }
        });
        return false;
    })
})
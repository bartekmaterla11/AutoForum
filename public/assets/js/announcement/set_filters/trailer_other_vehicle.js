$(document).ready(function () {
    var url = document.URL
    var parts = url.split('/');
    var last2 = parts[parts.length - 1];
    var firstSlug = last2.split('?');

    $('#category-trailers-block').on('change', function () {
        var value = $(this).val();

        if(value == 'kempingowe'){
            if (last2 == 'przyczepy-i-inne-pojazdy') {
                location.replace(url + '/' + value);
            } else {
                var result = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'przyczepy-i-inne-pojazdy'){
                        location.replace(result + firstSlug[0] + '/' + value);
                    }else {
                        location.replace(result + value);
                    }
                }else {
                    location.replace(result + value);
                }
            }
        }
        if(value == 'przyczepy-towarowe'){
            if (last2 == 'przyczepy-i-inne-pojazdy') {
                location.replace(url + '/' + value);
            } else {
                var result1 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'przyczepy-i-inne-pojazdy'){
                        location.replace(result1 + firstSlug[0] + '/' + value);
                    }else {
                        location.replace(result1 + value);
                    }
                }else {
                    location.replace(result1 + value);
                }
            }
        }
        if(value == 'wozki-widlowe'){
            if (last2 == 'przyczepy-i-inne-pojazdy') {
                location.replace(url + '/' + value);
            } else {
                var result2 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'przyczepy-i-inne-pojazdy'){
                        location.replace(result2 + firstSlug[0] + '/' + value);
                    }else {
                        location.replace(result2 + value);
                    }
                }else {
                    location.replace(result2 + value);
                }
            }
        }
        if(value == 'pozostale'){
            if (last2 == 'przyczepy-i-inne-pojazdy') {
                location.replace(url + '/' + value);
            } else {
                var result3 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'przyczepy-i-inne-pojazdy'){
                        location.replace(result3 + firstSlug[0] + '/' + value);
                    }else {
                        location.replace(result3 + value);
                    }
                }else {
                    location.replace(result3 + value);
                }
            }
        }
        if (value == 0) {
            var result4 = url.substring(0, url.lastIndexOf('/') + 1);
            location.replace(result4);
        }
    })
})

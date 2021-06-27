$(document).ready(function () {
    var url = document.URL
    var parts = url.split('/');
    var last1 = parts[parts.length - 1];
    var firstSlug = last1.split('?');

    $('#category-parts-cars-block').on('change', function () {
        var value = $(this).val();

        if(value == 'osobowe'){
            if (last1 == 'czesci-samochodowe') {
                location.replace(url + '/' + value);
            } else {
                var result = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'czesci-samochodowe'){
                        console.log(result + firstSlug[0] + '/' + value)
                        location.replace(result + firstSlug[0] + '/' + value);
                    }else {
                        location.replace(result + value);
                    }
                }else {
                    location.replace(result + value);
                }
            }
        }
        if(value == 'dostawcze-ciezarowe'){
            if (last1 == 'czesci-samochodowe') {
                location.replace(url + '/' + value);
            } else {
                var result1 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'czesci-samochodowe'){
                        console.log(result1 + firstSlug[0] + '/' + value)
                        location.replace(result1 + firstSlug[0] + '/' + value);
                    }else {
                        location.replace(result1 + value);
                    }
                }else {
                    location.replace(result1 + value);
                }
            }
        }
        if(value == 'na-czesci'){
            if (last1 == 'czesci-samochodowe') {
                location.replace(url + '/' + value);
            } else {
                var result2 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'czesci-samochodowe'){
                        console.log(result2 + firstSlug[0] + '/' + value)
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
            if (last1 == 'czesci-samochodowe') {
                location.replace(url + '/' + value);
            } else {
                var result3 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'czesci-samochodowe'){
                        console.log(result3 + firstSlug[0] + '/' + value)
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
            console.log(value)
            var result4 = url.substring(0, url.lastIndexOf('/') + 1);
            console.log(result4)
            location.replace(result4);
        }
    })
    var div = $('#set-parts-cars-form');
    if(last1 == 'na-czesci') {
        var child2 = div.children()[1];
        child2.style.display='none'
        var child3 = div.children()[3];
        child3.style.display='none'
        var child4 = div.children()[4];
        child4.style.display='none'
    }
})

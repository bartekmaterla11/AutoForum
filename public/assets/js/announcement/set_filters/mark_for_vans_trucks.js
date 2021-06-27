$(document).ready(function () {
    var url = document.URL
    var parts = url.split('/');
    var announ = parts[parts.length - 1];
    var firstSlug = announ.split('?');

    $('#category-vans-trucks-block').on('change', function () {
        var value = $(this).val();

        if (value == 'dostawcze') {
            if (announ == 'dostawcze-i-ciezarowe') {
                location.replace(url + '/' + value);
            } else {
                var result = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'dostawcze-i-ciezarowe'){
                        location.replace(result + firstSlug[0] + '/' + value);
                    }else {
                        location.replace(result + value);
                    }
                }else {
                    location.replace(result + value);
                }
            }
        }
        if (value == 'ciezarowe') {
            if (announ.includes('dostawcze-i-ciezarowe')) {
                location.replace(url + '/' + value);
            } else {
                var result1 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'dostawcze-i-ciezarowe'){
                        location.replace(result1 + firstSlug[0] + '/' + value);
                    }else {
                        location.replace(result1 + value);
                    }
                }else {
                    location.replace(result1 + value);
                }
            }
        }
        if (value == 'naczepy') {
            if (announ == 'dostawcze-i-ciezarowe') {
                location.replace(url + '/' + value);
            } else {
                var result2 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'dostawcze-i-ciezarowe'){
                        location.replace(result2 + firstSlug[0] + '/' + value);
                    }else {
                        location.replace(result2 + value);
                    }
                }else {
                    location.replace(result2 + value);
                }
            }
        }
        if (value == 'pozostale') {
            if (announ == 'dostawcze-i-ciezarowe') {
                location.replace(url + '/' + value);
            } else {
                var result3 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'dostawcze-i-ciezarowe'){
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
    });

    var div = $('#set-vans-trucks-form');
    var child1 = div.children()[1];
    var child2 = div.children()[3];
    var child3 = div.children()[5];
    var child4 = div.children()[6];
    var child5 = div.children()[7];
    var child6 = div.children()[8];
    var child7 = div.children()[9];
    var child8 = div.children()[10];
    var child9 = div.children()[11];
    var child10 = div.children()[12];
    var child11 = div.children()[13];
    var child12 = div.children()[14];
    var child13 = div.children()[15];
    var child14 = div.children()[16];
    var child15 = div.children()[17];
    var child16 = div.children()[18];
    var child17 = div.children()[19];

    if (announ == 'dostawcze-i-ciezarowe') {
        child1.style.display = 'none'
        child2.style.display = 'none'
        child3.style.display = 'block'
        child4.style.display = 'block'
        child5.style.display = 'block'
        child6.style.display = 'none'
        child7.style.display = 'block'
        child8.style.display = 'none'
        child9.style.display = 'block'
        child10.style.display = 'none'
        child11.style.display = 'none'
        child12.style.display = 'block'
        child13.style.display = 'block'
        child14.style.display = 'none'
        child15.style.display = 'block'
        child16.style.display = 'none'
        child17.style.display = 'block'
    }
    if (firstSlug[0] == 'dostawcze') {
        child1.style.display = 'block'
        child2.style.display = 'block'
        child3.style.display = 'none'
        child4.style.display = 'block'
        child5.style.display = 'block'
        child6.style.display = 'none'
        child7.style.display = 'block'
        child8.style.display = 'block'
        child9.style.display = 'block'
        child10.style.display = 'block'
        child11.style.display = 'none'
        child12.style.display = 'none'
        child13.style.display = 'block'
        child14.style.display = 'none'
        child15.style.display = 'block'
        child16.style.display = 'block'
        child17.style.display = 'block'
    }
    if (firstSlug[0] == 'ciezarowe') {
        child1.style.display = 'block'
        child2.style.display = 'block'
        child3.style.display = 'none'
        child4.style.display = 'block'
        child5.style.display = 'block'
        child6.style.display = 'none'
        child7.style.display = 'block'
        child8.style.display = 'block'
        child9.style.display = 'block'
        child10.style.display = 'block'
        child11.style.display = 'block'
        child12.style.display = 'none'
        child13.style.display = 'block'
        child14.style.display = 'block'
        child15.style.display = 'block'
        child16.style.display = 'none'
        child17.style.display = 'block'
    }
    if (announ.includes('naczepy')) {
        child1.style.display = 'none'
        child2.style.display = 'none'
        child3.style.display = 'block'
        child4.style.display = 'none'
        child5.style.display = 'block'
        child6.style.display = 'none'
        child7.style.display = 'none'
        child8.style.display = 'none'
        child9.style.display = 'none'
        child10.style.display = 'none'
        child11.style.display = 'none'
        child12.style.display = 'none'
        child13.style.display = 'none'
        child14.style.display = 'none'
        child15.style.display = 'none'
        child16.style.display = 'none'
        child17.style.display = 'block'
    }
    if (announ == 'pozostale') {
        child1.style.display = 'none'
        child2.style.display = 'none'
        child3.style.display = 'block'
        child4.style.display = 'none'
        child5.style.display = 'none'
        child6.style.display = 'none'
        child7.style.display = 'none'
        child8.style.display = 'none'
        child9.style.display = 'none'
        child10.style.display = 'none'
        child11.style.display = 'none'
        child12.style.display = 'none'
        child13.style.display = 'none'
        child14.style.display = 'none'
        child15.style.display = 'none'
        child16.style.display = 'none'
        child17.style.display = 'block'
    }
});

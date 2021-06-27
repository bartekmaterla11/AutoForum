$(document).ready(function () {
    var url = document.URL
    var parts = url.split('/');
    var last1 = parts[parts.length - 1];
    var firstSlug = last1.split('?');

    $('#category-tires-rims-block').on('change', function () {
        var value = $(this).val();

        if(value == 'opony'){
            if (last1 == 'opony-i-felgi') {
                location.replace(url + '/' + value);
            } else {
                var result = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'opony-i-felgi'){
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
        if(value == 'felgi'){
            if (last1 == 'opony-i-felgi') {
                location.replace(url + '/' + value);
            } else {
                var result1 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'opony-i-felgi'){
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
        if(value == 'kola'){
            if (last1 == 'opony-i-felgi') {
                location.replace(url + '/' + value);
            } else {
                var result2 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'opony-i-felgi'){
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
        if(value == 'pozostale-opony-felgi'){
            if (last1 == 'opony-i-felgi') {
                location.replace(url + '/' + value);
            } else {
                var result3 = url.substring(0, url.lastIndexOf('/') + 1);
                if(firstSlug[1]){
                    if(firstSlug[0] == 'opony-i-felgi'){
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
            location.replace(result4);
        }
    })

    var div = $('#set-tires-rims-form');
    var a = div.children()[6];
    var b = div.children()[7];
    var c = div.children()[8];
    var d = div.children()[9];
    var e = div.children()[10];
    var f = div.children()[11];
    var g = div.children()[12];
    var h = div.children()[13];
    var k = div.children()[5];

    if (last1 == 'opony') {
        k.style.display = 'none'
        a.style.display = 'block'
        b.style.display = 'block'
        c.style.display = 'block'
        d.style.display = 'block'
        e.style.display = 'block'
        f.style.display = 'block'
        g.style.display = 'none'
        h.style.display = 'none'
    }
    if (last1 == 'felgi') {
        k.style.display = 'none'
        a.style.display = 'none'
        b.style.display = 'none'
        c.style.display = 'none'
        d.style.display = 'none'
        e.style.display = 'none'
        f.style.display = 'none'
        g.style.display = 'block'
        h.style.display = 'block'
    }
    if (last1 == 'kola') {
        k.style.display = 'none'
        a.style.display = 'block'
        b.style.display = 'none'
        c.style.display = 'none'
        d.style.display = 'none'
        e.style.display = 'none'
        f.style.display = 'none'
        g.style.display = 'block'
        h.style.display = 'block'
    }
    if (last1 == 'pozostale-opony-felgi' || last1 == 0) {
        k.style.display = 'block'
        a.style.display = 'none'
        b.style.display = 'none'
        c.style.display = 'none'
        d.style.display = 'none'
        e.style.display = 'none'
        f.style.display = 'none'
        g.style.display = 'none'
        h.style.display = 'none'
    }
})

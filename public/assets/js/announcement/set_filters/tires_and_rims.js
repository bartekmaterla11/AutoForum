$('#category-tires-rims-block').on('change', function () {
    var value = $(this).val();
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

    if (value == 6) {
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
    if (value == 7) {
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
    if (value == 8) {
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
    if (value == 9 || value == 0) {
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
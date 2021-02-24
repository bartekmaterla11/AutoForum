$(document).ready(function () {
    var url = document.URL;
    var parts = url.split('/');
    var a = parts[parts.length - 2]
    var announ = parts[parts.length - 1];

    $('.add-comment').on('click',function () {
        var div = $(this).parent();
        var c = div.parent();
        var child = c.children()[0];
        var id = c.children()[1];
        var content = child.value;

        $.ajax({
            url: "/forum/" + a + "/" + announ,
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                'con':content,
                'id':id.innerHTML,
            },
            success: function (data) {
                if(data.Success){
                 location.replace(url);
                }
            }
        });
        return false;
    })
})
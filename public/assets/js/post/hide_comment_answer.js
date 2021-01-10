$(document).ready(function () {
    $(".close1").each(function (index) {
        $(this).on('click', function (event){
            event.preventDefault();
            var answer = $(this);
            var comment = answer.parent("div:first");
            var a = comment.parent("div:first");
            var b = a.parent("div:first");
            var div = b.children()[1];
            var divhide = div.style.display="none";

        });
    });
});
$(document).ready(function () {
    $(".close1").each(function (index) {
        $(this).on('click', function (event){
            event.preventDefault();
            var answer = $(this);
            var comment = answer.parent("div:first");
            var a = comment.parent("div:first");
            var b = a.parent("div:first");

            var user1 = answer.data("username1");
            var user2 = answer.data("username2");

            if(user1 === user2){
                var div = b.children()[3];
                div.style.display="none";
            }else {
                var div1 = b.children()[2];
                div1.style.display="none";
            }
        });
    });
});
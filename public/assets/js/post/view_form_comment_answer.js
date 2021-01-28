$(document).ready(function () {
    var all = $('.all_answers');
    var commentform = all.find('button.comment');

    commentform.click(function (event){
        event.preventDefault()
        var answer = $(this);
        var comment = answer.parent("div:first");
        var user1 = answer.data("username1");
        var user2 = answer.data("username2");

        if(user1 === user2) {
            var a = comment.children()[3];
            a.style.display = 'block';
            console.log(a);
        }else {
            var b = comment.children()[2];
            b.style.display = 'block';
            console.log(b);
        }
    })
});
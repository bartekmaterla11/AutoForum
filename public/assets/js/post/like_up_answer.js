$(document).ready(function() {
    var all = $('.all_answers');
    var commentsanswers = all.find("div.Comment_like");

    commentsanswers.click(function (event) {
        event.preventDefault();
        var that = $(this);
        var id1 = that.data("id")
        var answerid = that.data("answerid")

        $.ajax({
            url: "/like/ajax/answer",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                "mark1": id1,
                "answerid": answerid,
            },
            success: function (data) {
                if(data.Error){
                    var span = that.find("i");
                    var span1 = span.children()[0];
                    span1.classList.toggle('show');
                }else {
                    var likes = that.find("span.like_answer_int");
                    var parent = likes.parent();
                    var child = parent.children()[1];
                    var int = parseInt(child.innerText);
                    var like = int + 1;
                    child.innerHTML ='+' + like;
                }
            }

        });
        return false;
    });
});

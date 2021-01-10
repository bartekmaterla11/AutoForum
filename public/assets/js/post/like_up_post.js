$(document).ready(function() {
    $('#like_up').on('click', function (event) {
        event.stopPropagation();
        var that = $(this);
        var id = that.data("id")
        var postid = that.data("postid")

        var popup1 = document.getElementById('PopupStopLikePost');

        $.ajax({
            url: "/like/ajax",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                "mark": id,
                "postid": postid,
            },
            success: function (data) {
                if(data.Error){
                    popup1.classList.toggle('show');
                }else{
                    var likes = that.find("span.like_post_int");
                    var parent = likes.parent();
                    var child = parent.children()[2];
                    var int = parseInt(child.innerText);
                    var like = int + 1;
                    child.innerHTML ='+' + like;
                }
            }
        });
        return false;
    });
});

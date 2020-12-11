$(document).ready(function() {
    var klik = 0;
    $('#like_up').on('click', function (event) {
            klik ++;
            if(klik%2==1) {
                event.stopPropagation();
                var that = $(this);
                var id = that.data("id")
                var postid = that.data("postid")

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
                    }

                });
                return false;
            }
    });
});

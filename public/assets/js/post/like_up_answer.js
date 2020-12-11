$(document).ready(function() {
    $('#like_up_answer').on('click', function (event) {
        event.stopPropagation();
        var that = $(this);
        var id = that.data("id")
        var answertid = that.data("answerid")

        $.ajax({
            url: "/like/ajax/answer",
            type: "POST",
            dataType: "json",
            async: true,
            data: {
                "mark1": id,
                "answerid": answertid,
            },
            success: function (data) {
            }

        });
        return false;
    });
});

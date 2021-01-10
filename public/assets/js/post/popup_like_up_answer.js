$(document).ready(function () {
    $(".like_answer").each(function (index) {
        $(this).on('click', function (event) {
            event.preventDefault();
            var popup =  $(this);
            var span = popup.children()[0];
            span.classList.toggle('show');
        });
    });
});
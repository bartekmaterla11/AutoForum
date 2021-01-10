// $(document).ready(function () {
//     $(".comment").each(function (index) {
//         $(this).on('click', function (event){
//             event.preventDefault();
//             var answer = $(this);
//             var comment = answer.parent("div:first");
//             var a = comment.children()[1];
//             a.style.display='block';
//         });
//     });
// });

$(document).ready(function () {
    var all = $('.all_answers');
    var commentform = all.find('button.comment');

    commentform.click(function (event){
        event.preventDefault()
        var answer = $(this);
        var comment = answer.parent("div:first");
        var a = comment.children()[1];
        a.style.display='block';

    })
});
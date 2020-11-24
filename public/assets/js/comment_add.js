
$('#comment').on('click', function (event) {
    event.stopPropagation();
    $(this).after(comment);

});
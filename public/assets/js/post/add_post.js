$('#confirm-delete').on('show.bs.modal', function(event) {
    $(this).find('.btn-ok1').attr('href', $(event.relatedTarget).data('href'));
});

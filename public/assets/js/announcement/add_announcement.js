$('#confirm-delete-1').on('show.bs.modal', function(event) {
    $(this).find('.btn-ok1').attr('href', $(event.relatedTarget).data('href'));
});
$('#confirm-delete-4').on('show.bs.modal', function(event) {
    $(this).find('.btn-ok2').attr('href', $(event.relatedTarget).data('href'));
});

window.triggerDelete = function (id, title, action) {
    $('#deleteTitle').html(title);
    $('#deleteId').val(id);
    $('#deleteForm').attr('action', action);
}

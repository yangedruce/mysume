// trigger print
function triggerPrint() {
    $('#print').addClass('d-none');
    window.print();
    $('#print').removeClass('d-none');
}
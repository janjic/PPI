
$('input:checkbox').addClass('js-switch');
Array.prototype.slice.call(document.querySelectorAll('.js-switch')).forEach(function(html) {
    new Switchery(html);
});
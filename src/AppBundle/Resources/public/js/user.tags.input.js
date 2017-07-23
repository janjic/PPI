$(function() {
    var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

    $('#user_phones').tagsInput({
        'defaultText':'Add new  phone number',
        pattern: regex
    });

    $('#user_roles').prop('multiple', false);
    // $('#user_plainPassword').prop('required', true);
});
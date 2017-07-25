$(function() {
    var regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

    $('#product_provisionContactPhone').tagsInput({
        'defaultText':'Add new  phone number',
        // pattern: regex,
        height: '80px',
        width: '100%'

    });

    var mailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    $('#product_provisionContactEmail').tagsInput({
        'defaultText':'Add new  email',
        pattern: mailRegex,
        height: '80px',
        width: '100%'

    });

});
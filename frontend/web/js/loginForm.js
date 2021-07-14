'use strict';

$(function() {
let form = $("form#loginForm");
form.submit(function() {
    let data = form.serialize();

    $('.help-block.help-block-error').text('').css( "margin-bottom", "0" );
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: data,
        success: function (data) {
            for (let prop in data) {
                $('.field-'+prop + '+p').text(data[prop].join(', ')).css({
                    "color": "red",
                    "margin-bottom": "15px"
                });
            }
        },
        error: function(jqXHR, errMsg) {
            // alert(errMsg);
        }
    });

    return false;
});
});
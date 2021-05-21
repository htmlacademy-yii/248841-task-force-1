"use strict";

$(function() {

    $(document).on('click','.feedback-card__actions>span.button', function() {
       let btn = $(this);

       $.ajax({
               url: '/tasks/answer',
               type: 'post',
               data: {
                   action: btn.data('action'),
                   id: btn.data('id'),
               },
               success: function (responseText) {
                   console.log(responseText);
                   $.pjax.reload({container: '#content-view__feedback'})
               },
               error: function(jqXHR, errMsg) {
                   // alert(errMsg);
               }
           }
       )
    })

});

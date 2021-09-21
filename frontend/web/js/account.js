'use strict';
$(function() {
    $('[name="Account[avatarUrl]"]').change(function() {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.account__redaction-avatar img').
                    attr('src', e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#account').submit(function(e) {
        console.log(e)
return false;
    })

});

Dropzone.autoDiscover = false;

var dropzone = new Dropzone('.create__file', {
    url: '/account',
    maxFiles: 6,
    uploadMultiple: true,
    acceptedFiles: 'image/*',
    dictDefaultMessage: 'Выбрать фотографии',
    addRemoveLinks: true,
    dictRemoveFile: 'удалить файл',
    // previewTemplate: '<span><img data-dz-thumbnail alt="Фото работы"></span>'
});

$('.photo-var').click(function() {
$('.create__file').click();
})



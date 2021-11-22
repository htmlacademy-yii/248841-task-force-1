'use strict';
$(function() {
  $('#upload-avatar').change(function() {

    if (this.files && this.files[0]) {
      var reader = new FileReader();

      reader.onloadend = function(e) {
        $('.account__redaction-avatar img').
            attr('src', e.target.result);
      };

      reader.readAsDataURL(this.files[0]);
    }
  });
});

Dropzone.autoDiscover = false;

var dropzone = new Dropzone('.create__file', {
  url: '/account',
  paramName: 'files',
  parallelUploads: 6,
  maxFiles: 6,
  maxFilesize: 10,
  autoProcessQueue: false,
  dictMaxFilesExceeded: 'Превышено макс. кол-во файлов. Макс. кол-во: {{maxFiles}}шт.',
  dictFileTooBig: 'Файл слишком большой ({{filesize}}MB). Макс. размер: {{maxFilesize}}MB.',
  uploadMultiple: true,
  dictDefaultMessage: 'Выбрать фотографии',
  addRemoveLinks: true,
  dictRemoveFile: 'удалить файл',
  init: function() {
    let dzClosure = this;

    document.querySelector('.button').
        addEventListener('click', function(e) {

          e.preventDefault();
          e.stopPropagation();
          if (dzClosure.files.length === 0) {
            let form = document.querySelector('form#account');
            let formData = new FormData(form);

            $('.preloader-conteiner').addClass('active');
            $.ajax({
              url: $('form#account').attr('action'),
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              success: function(responseText) {
                location.reload();
              },
              error: function(jqXHR, errMsg) {
                $('.preloader-conteiner').removeClass('active');
                console.log(jqXHR.responseJSON.message, errMsg);
                alert(jqXHR.responseJSON.message);
              },
            });
            return false;
          }

          dzClosure.processQueue();
        });
    //send all the form data along with the files:
    this.on('sendingmultiple', function(data, xhr, formData) {
      $('.preloader-conteiner').addClass('active');
      var file = document.getElementById('upload-avatar');
      formData.append('Account[avatarUrl]', file.files[0]);
      formData.append('Account[name]',
          $('#account-name').val());
      formData.append('Account[email]',
          $('#account-email').val());
      formData.append('Account[cityId]',
          $('#account-cityid').val());
      formData.append('Account[birthday]',
          $('#account-birthday').val());
      formData.append('_csrf-frontend',
          $('[name="_csrf-frontend"]').val());
      formData.append('Account[description]',
          $('[name="Account[description]"]').val());
      [].forEach.call($('[name="Account[category][]"]:checked'),
          function(element, index, list) {
            if (element.value) {
              formData.append('Account[category][]', element.value);
            }
          });

      formData.append('Account[password1]',
          $('[name="Account[password1]"]').val());
      formData.append('Account[password2]',
          $('[name="Account[password2]"]').val());
      formData.append('Account[phone]',
          $('[name="Account[phone]"]').val());
      formData.append('Account[skype]',
          $('[name="Account[skype]"]').val());
      formData.append('Account[telegram]',
          $('[name="Account[telegram]"]').val());
      [].forEach.call($('[name="Account[notification][]"]:checked'),
          function(element, index, list) {
            if (element.value) {
              formData.append('Account[notification][]', element.value);
            }
          });

      formData.append('Account[showContacts]', $('[name="Account[showContacts]"]').is(':checked')?'1':'0');
      formData.append('Account[notShowProfile]', $('[name="Account[notShowProfile]"]').is(':checked')?'1':'0');

    });
    this.on('successmultiple', function(file, responseText) {
      this.removeAllFiles();
      $('.preloader-conteiner').removeClass('active');
      location.reload();
    });

    this.on('error', function () {
      alert('An error occurred while uploading files');
    });
  },
});

$('.photo-var').click(function() {
  $('.create__file').click();
});



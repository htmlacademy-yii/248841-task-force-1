// 'use strict';

$(function() {
    let validate = function(responseText){
        $('.warning-item.warning-item--error > p,h3').remove();
        $('.field-container > span').css({
            "color": "#8a8a8d"
        });$('.field-container > .input').css({
            "border-color": "#e4e9f2"
        });
        for (let prop in responseText) {

            let blockHtml = '';
            $('.field-'+prop + '> span').css({
                "color": "red"
            });
            $('.field-'+prop + '> .input').css({
                "border-color": "red"
            });
            blockHtml = "<h3>" + $('.field-'+prop + '> label').text() + "</h3><p>" + responseText[prop].join(', ') + "<p>";
            $('.warning-item.warning-item--error').append(blockHtml);
        }
        $('.warning-item.warning-item--error').show("slow");
    };
    Dropzone.autoDiscover = false;
    var dropzone = new Dropzone('div.create__file', {
        url: '/tasks/create',
        autoProcessQueue: false,
        uploadMultiple: true,
        paramName: 'files',
        addRemoveLinks: true,
        dictRemoveFile: 'удалить файл',
        parallelUploads: 5,
        maxFiles: 5,
        maxFilesize: 10,
        dictMaxFilesExceeded: 'Превышено макс. кол-во файлов. Макс. кол-во: {{maxFiles}}шт.',
        dictFileTooBig: "Файл слишком большой ({{filesize}}MB). Макс. размер: {{maxFilesize}}MB.",
        init: function() {
            dzClosure = this;

            document.querySelector('.button').
                addEventListener('click', function(e) {

                    e.preventDefault();
                    e.stopPropagation();
                    if (dzClosure.files.length == 0){
                        let form = $("form#createForm");
                            let data = form.serialize();

                            $.ajax({
                                url: form.attr('action'),
                                type: 'POST',
                                data: data,
                                success: function (responseText) {
                                    validate(responseText);
                                },
                                error: function(jqXHR, errMsg) {
                                    // alert(errMsg);
                                }
                            });
                            return false;
                    }

                    dzClosure.processQueue();
                });
            //send all the form data along with the files:
            this.on('sendingmultiple', function(data, xhr, formData) {
                formData.append('CreateTask[title]',
                    $('#createtask-title').val());
                formData.append('CreateTask[description]',
                    $('#createtask-description').val());
                formData.append('CreateTask[category]',
                    $('#createtask-category').val());
                formData.append('CreateTask[price]',
                    $('#createtask-price').val());
                formData.append('CreateTask[deadline]',
                    $('#createtask-deadline').val());
                formData.append('_csrf-frontend',
                    $('[name="_csrf-frontend"]').val());
            });
            this.on("successmultiple", function(file, responseText) {
                if ( responseText  === Object(responseText)){
                    this.removeAllFiles();
                    validate(responseText);
                } else {
                    location.replace(location.origin + responseText);
                }
            });

        }
    });
});
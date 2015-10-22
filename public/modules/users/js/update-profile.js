$(function(){
    /** the plupload for user profile **/
    var uploader = new plupload.Uploader({
        runtimes: 'html5,flash',
        browse_button: 'pickfiles',
        container: 'container-upload',
        max_file_size: '10mb',
        url: $('#pickfiles').data('url'),
        flash_swf_url: '/js/Moxie.swf',
        silverlight_xap_url: '/js/Moxie.xap',
        multipart_params: {
            '_token': $('#pickfiles').data('token')
        },
        filters: [
            {title: "Image files", extensions: "jpg,gif,png"},
        ],
        resize: {
            quality: 90
        },
        init: {
            PostInit: function () {

            },
            FilesAdded: function (up, files) {
                $('#pickfiles').button('loading');
                uploader.start();
            },
            UploadProgress: function (up, file) {

            },
            Error: function (up, err) {
                swal({
                    title: "Ups!",
                    text: "Ha ocurrido un error, intenta de nuevo!",
                    type: "error",
                    confirmButtonText: "Ok"
                });
            },
            FileUploaded: function (up, file, info) {
                var response = $.parseJSON(info.response);
                $('#profileAvatar').attr('src', GLOBALS.site_url+'/image-manager/view/'+response.id+'/150');
                $('#pickfiles').button('reset');
                swal({
                    title: "Listo!",
                    text: "Hemos actualizado tu foto de perfil!",
                    type: "success",
                    confirmButtonText: "Ok"
                });
            }
        }
    });
    uploader.init();
});

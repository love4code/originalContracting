jQuery(document).ready(function($){

    var mediaUploader;
    var attachment;
// pass in the element var
    $( '#upload-button').on('click',function(e) {
        //event prevent default
        e.preventDefault();
        // if mediaUploader exists
        if( mediaUploader){
            // open mediaUploader
            mediaUploader.open();
            return;
        }

        //define media uploader
        mediaUploader = wp.media.frames.file_frame = wp.media( {
            // define custom options.
            title: 'Choose a Profile Picture',
            button: {
                text: 'Choose Picture'
            },
            multiple: false
        });

        mediaUploader.on('select', function(){
            attachment = mediaUploader.state().get('selection').first().toJSON();
           $('#profile-picture').val(attachment.url);
            // add preview of currently uploaded image.
            $('#profile-picture-preview').css('background-image', 'url('+attachment.url+')');
        });
        mediaUploader.open();

    });
    $('#remove-picture').on("click", function(e) {
        e.preventDefault();
        answer = confirm("Are You Sure You Want To Remove The Profile Image?");
        if(answer == true){
            $('#profile-picture').val('');
            $('.sgrove-general-form').submit();
        }
        return;
    });

});

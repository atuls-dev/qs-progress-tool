jQuery(document).ready(function($){
    var custom_uploader;
    jQuery('.upload_image_button').click(function(e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        var ach_id = jQuery(this).attr('ach_id');
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Achievement',
            button: {
                text: 'Choose Achievement'
            },
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            jQuery('#upload_image_'+ach_id).val(attachment.url);
            jQuery('#preview_image_'+ach_id).attr("src",attachment.url);
            jQuery('#full_ach_'+ach_id).attr("src",attachment.url);
        });
        //Open the uploader dialog
        custom_uploader.open();
    });
    jQuery('.achievement_table').DataTable();
    jQuery('.achievement_form').submit(function(e){
        e.preventDefault();
        jQuery.ajax({
            url: qs_ajax.ajaxurl,
            type: 'POST',
            data:jQuery(this).serialize(),
            success: function( data ){
              var options   = jQuery.parseJSON(data);
              tb_remove();

            }
          });
    });
});
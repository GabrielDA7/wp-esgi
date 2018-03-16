
$(document).ready(function() {
	jQuery('.upload_image').on('click', function( event ){
  		var $wrapper_element = $(this).prev('input');
  		 var id = $wrapper_element.attr("id");
  		 console.log(id);
	    event.preventDefault();

	    // Create the media frame.
	    file_frame = wp.media.frames.file_frame = wp.media({
	      title: jQuery( this ).data( 'uploader_title' ),
	      button: {
	        text: jQuery( this ).data( 'uploader_button_text' ),
	      },
	      multiple: false 
	    });
 
	    file_frame.on( 'select', function() {
	      attachment = file_frame.state().get('selection').first().toJSON();
	      $wrapper_element.val(attachment.url);
	    });

	    file_frame.open();
  	});

  	$("#form_save").click(function() {
		$("#form").submit();
		return false;
	});

});

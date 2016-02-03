jQuery(document).ready(function ($) {
	
	/**
	 * Metabox of Post Format
	 */
	$('input[name="post_format"]').each(function(){
		var post_format = $('input[name="post_format"]:checked').val();
		if (post_format == 'gallery') {
			$('#blog_format_metabox').show();
			$('#tr_st_blog_format_gallery').show();
			$('#tr_st_blog_format_quote').hide();
			$('#tr_st_blog_format_quote_author').hide();
			$('#tr_st_blog_format_video').hide();
			$('#tr_st_blog_format_audio').hide();
		} else if (post_format == 'quote') {
			$('#blog_format_metabox').show();
			$('#tr_st_blog_format_gallery').hide();
			$('#tr_st_blog_format_quote').show();
			$('#tr_st_blog_format_quote_author').show();
			$('#tr_st_blog_format_video').hide();
			$('#tr_st_blog_format_audio').hide();
		} else if (post_format == 'video') {
			$('#blog_format_metabox').show();
			$('#tr_st_blog_format_gallery').hide();
			$('#tr_st_blog_format_quote').hide();
			$('#tr_st_blog_format_quote_author').hide();
			$('#tr_st_blog_format_video').show();
			$('#tr_st_blog_format_audio').hide();
		} else if (post_format == 'audio') {
			$('#blog_format_metabox').show();
			$('#tr_st_blog_format_gallery').hide();
			$('#tr_st_blog_format_quote').hide();
			$('#tr_st_blog_format_quote_author').hide();
			$('#tr_st_blog_format_video').hide();
			$('#tr_st_blog_format_audio').show();
		} else {
			$('#blog_format_metabox').hide();
			$('#tr_st_blog_format_gallery').hide();
			$('#tr_st_blog_format_quote').hide();
			$('#tr_st_blog_format_quote_author').hide();
			$('#tr_st_blog_format_video').hide();
			$('#tr_st_blog_format_audio').hide();
		}
	});
	
	$('input[name="post_format"]').change(function(){
		var post_format = $('input[name="post_format"]:checked').val();
		if (post_format == 'gallery') {
			$('#blog_format_metabox').show();
			$('#tr_st_blog_format_gallery').fadeIn('slow');
			$('#tr_st_blog_format_quote').hide();
			$('#tr_st_blog_format_quote_author').hide();
			$('#tr_st_blog_format_video').hide();
			$('#tr_st_blog_format_audio').hide();
		} else if (post_format == 'quote') {
			$('#blog_format_metabox').show();
			$('#tr_st_blog_format_gallery').hide();
			$('#tr_st_blog_format_quote').fadeIn('slow');
			$('#tr_st_blog_format_quote_author').fadeIn('slow');
			$('#tr_st_blog_format_video').hide();
			$('#tr_st_blog_format_audio').hide();
		} else if (post_format == 'video') {
			$('#blog_format_metabox').show();
			$('#tr_st_blog_format_gallery').hide();
			$('#tr_st_blog_format_quote').hide();
			$('#tr_st_blog_format_quote_author').hide();
			$('#tr_st_blog_format_video').fadeIn('slow');
			$('#tr_st_blog_format_audio').hide();
		} else if (post_format == 'audio') {
			$('#blog_format_metabox').show();
			$('#tr_st_blog_format_gallery').hide();
			$('#tr_st_blog_format_quote').hide();
			$('#tr_st_blog_format_quote_author').hide();
			$('#tr_st_blog_format_video').hide();
			$('#tr_st_blog_format_audio').fadeIn('slow');
		} else {
			$('#blog_format_metabox').hide();
			$('#tr_st_blog_format_gallery').hide();
			$('#tr_st_blog_format_quote').hide();
			$('#tr_st_blog_format_quote_author').hide();
			$('#tr_st_blog_format_video').hide();
			$('#tr_st_blog_format_audio').hide();
		}
	});
	/**
	 * End Post Format
	 */

	/**
	 * Metabox of Image Multiple
	 */
	$(".cmb_sortable").sortable();
	$(".cmb_sortable").disableSelection();
	
	$(".cmb_meta_add").live('click', function(){		
		var metaContainer = $(this).prev();
		var metaId = metaContainer.attr('id');
		var metaInt = $('#'+metaId).attr('rel');
		
		var numArr = $('#'+metaId +' li').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
		var newSlide = '<li class="meta-' + newNum + '">\
							<span><label>Label</label> <input class="cmb_text_medium" type="text" name="' + metaId + '[' + newNum + '][name]" value="" /></span>\
							<span><label>Value</label> <input class="cmb_text_medium" type="text" name="' + metaId + '[' + newNum + '][value]" value="" /></span>\
							<button class="button-secondary cmb_meta_delete">Delete</button>\
						</li>';
		
		metaContainer.append(newSlide);
		
		return false; //prevent jumps, as always..
	});
	
	$('.cmb_meta_delete').live('click', function(){
		$(this).parent().remove();
		return false;
	});
	
	$('.cmb_image_field').live('click', function () {
		var buttonLabel;
		formfield = $(this).prev('input').attr('id');
		buttonLabel = 'Use as ' + $('label[for=' + formfield + ']').text();
		if ( typeof wp !== 'undefined' && wp.media && wp.media.editor ) {
			//wp.media.editor.open(this);
			var file_frame = wp.media({
				multiple : false,
				library : { type : 'image'},
				button : { text : buttonLabel },
			});
			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get('selection').first().toJSON();
				var uploadStatus = '<div class="img_status"><img src="' + attachment.url + '" alt="" /><a href="#" class="cmb_remove_file_button" rel="' + formfield + '">Remove Image</a></div>';
				$('#' + formfield).val(attachment.url);
				$('#' + formfield).siblings('.cmb_media_status').slideDown().html(uploadStatus);
			});
			file_frame.open();
		}
		else {
			tb_show('', 'media-upload.php?post_id=' + $('#post_ID').val() + '&type=image&cmb_force_send=true&cmb_send_label=' + buttonLabel + '&TB_iframe=true');
		}
		return false;
	});
	
	$('.cmb_image_single').live('click', function () {
		var buttonLabel;
		formfield = $(this).prev('input').attr('id');
		buttonLabel = 'Use as ' + $('label[for=' + formfield + ']').text();
		if ( typeof wp !== 'undefined' && wp.media && wp.media.editor ) {
			//wp.media.editor.open(this);
			var file_frame = wp.media({
				multiple : false,
				library : { type : 'image'},
				button : { text : buttonLabel },
			});
			file_frame.on( 'select', function() {
				var attachment = file_frame.state().get('selection').first().toJSON();
				if ( typeof attachment.sizes.thumbnail !== 'undefined' ) {
					var attachment_url = attachment.sizes.thumbnail.url;
				} else {
					var attachment_url = attachment.url;
				}
				var uploadStatus = '<div class="img_status img_post"><img src="' + attachment_url + '" alt="" /><a href="#" class="cmb_remove_file_button" rel="' + formfield + '">Remove Image</a></div>';
				$('#' + formfield).val(attachment.id);
				$('#' + formfield).siblings('.cmb_media_status').slideDown().html(uploadStatus);
			});
			file_frame.open();
		}
		else {
			tb_show('', 'media-upload.php?post_id=' + $('#post_ID').val() + '&type=image&cmb_force_send=true&cmb_send_label=' + buttonLabel + '&TB_iframe=true');
		}
		return false;
	});
	
	$('.cmb_image_gallery').live('click', function () {
		var buttonLabel;
		formfield = $(this).attr('id');
		formslider = true;
		buttonLabel = 'Use as ' + $('label[for=' + formfield + ']').text();
		if ( typeof wp !== 'undefined' && wp.media && wp.media.editor ) {
			//wp.media.editor.open(this);
			var file_frame = wp.media({
				multiple : true,
				library : { type : 'image'},
				button : { text : buttonLabel },
			});
			file_frame.on( 'select', function() {
				var selection = file_frame.state().get('selection');
				selection.map( function( attachment ) {
					attachment = attachment.toJSON();
					var uploadStatus = '<div class="img_status img_post"><input type="hidden" name="' + formfield + '[]" value="' + attachment.id + '" /><img src="' + attachment.sizes.thumbnail.url + '" alt="" /><a href="#" class="cmb_remove_image_button">Remove Image</a></div>';
					$('#' + formfield).siblings('.cmb_media_status').slideDown().append(uploadStatus);
				});
			});
			file_frame.open();
		}
		else {
			tb_show('', 'media-upload.php?post_id=' + $('#post_ID').val() + '&type=image&cmb_force_send=true&cmb_send_label=' + buttonLabel + '&TB_iframe=true');
		}
		return false;
	});
	
	$('.cmb_remove_image_button').live('click', function () {
		$(this).parent().remove();
		return false;
	});

});
<?php

/*******************************************************************
Register Meta Box
********************************************************************/
function slicetheme_post_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_st_blog_';
	
	$meta_boxes[] = array(
		'id'         => 'blog_format_metabox',
		'title'      => 'Post Formats',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Gallery', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'format_gallery',
				'type' => 'st_image_gallery',
			),
			array(
				'name' => esc_html__('Quote', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'format_quote',
				'type' => 'textarea_small',
			),
			array(
				'name' => esc_html__('Quote Author', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'format_quote_author',
				'type' => 'text_medium',
			),
			array(
				'name' => esc_html__('Video URL (oEmbed) or Embed Code', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'format_video',
				'type' => 'textarea_code',
			),
			array(
				'name' => esc_html__('Audio URL (oEmbed) or Embed Code', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'format_audio',
				'type' => 'textarea_code',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'slicetheme_post_metaboxes' );
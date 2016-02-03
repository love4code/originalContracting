<?php

/*******************************************************************
Register Meta Box
********************************************************************/
function slicetheme_global_metaboxes( array $meta_boxes ) {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_st_general_';
	
	$meta_boxes[] = array(
		'id'         => 'general_metabox',
		'title'      => 'General Options',
		'pages'      => array( 'page', 'st_portfolio', 'st_service' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => esc_html__('Header Transparent', 'slicetheme'),
				'desc'    => esc_html__('Only available for header style "default".', 'slicetheme'),
				'id'      => $prefix .'header_transparent',
				'type'    => 'select',
				'options' => array(
					array( 'value' => '', 'name' => '-- Theme Options --' ),
					array( 'value' => '0', 'name' => 'No' ),
					array( 'value' => '1', 'name' => 'Yes' ),
				),
			),
			array(
				'name' => esc_html__('Hide Title Area', 'slicetheme'),
				'desc' => esc_html__('This functionality will hide page title area.', 'slicetheme'),
				'id'   => $prefix .'title_hide',
				'type' => 'checkbox',
			),
			array(
				'name' => esc_html__('Title Attributes', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'_label_title',
				'type' => 'title',
			),
			array(
				'name'    => esc_html__('Title Align', 'slicetheme'),
				'desc'    => '',
				'id'      => $prefix .'title_align',
				'type'    => 'select',
				'std'     => '',
				'options' => array(
					array( 'value' => '', 'name' => '-- Theme Options --' ),
					array( 'value' => 'left', 'name' => 'Left' ),
					array( 'value' => 'center', 'name' => 'Center' ),
				),
			),
			array(
				'name' => esc_html__('Padding Top', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'title_padding_top',
				'type' => 'text_small',
			),
			array(
				'name' => esc_html__('Padding Bottom', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'title_padding_bottom',
				'type' => 'text_small',
			),
			array(
				'name' => esc_html__('Custom Title', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'title_custom',
				'type' => 'st_text_large',
			),
			array(
				'name' => esc_html__('Sub Title', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'title_sub',
				'type' => 'st_text_large',
			),
			array(
				'name' => esc_html__('Title Color', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'color_title',
				'type' => 'colorpicker',
			),
			array(
				'name' => esc_html__('Sub Title Color', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'color_subtitle',
				'type' => 'colorpicker',
			),
			array(
				'name' => esc_html__('Title Background', 'slicetheme'),
				'desc' => esc_html__('Upload an image or select from media or enter an URL.', 'slicetheme'),
				'id'   => $prefix .'style_bg_title',
				'type' => 'st_background',
			),
			array(
				'name' => esc_html__('Background Image Overlay', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'style_bg_overlay',
				'type' => 'colorpicker',
			),
			array(
				'name' => esc_html__('Background Image Parallax', 'slicetheme'),
				'desc' => esc_html__('This functionality will enable parallax image.', 'slicetheme'),
				'id'   => $prefix .'style_bg_title_parallax',
				'type' => 'select',
				'options' => array(
					array( 'value' => '', 'name' => '-- Theme Options --' ),
					array( 'value' => '0', 'name' => 'No' ),
					array( 'value' => '1', 'name' => 'Yes' ),
				),
			),
			array(
				'name'    => esc_html__('Breadcrumb', 'slicetheme'),
				'desc'    => '',
				'id'      => $prefix .'title_breadcrumb',
				'type'    => 'select',
				'std'     => '',
				'options' => array(
					array( 'value' => '', 'name' => '-- Theme Options --' ),
					array( 'value' => '0', 'name' => 'Hide' ),
					array( 'value' => '1', 'name' => 'Show' ),
				),
			),
			array(
				'name' => esc_html__('Breadcrumb Color', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'color_breadcrumb',
				'type' => 'colorpicker',
			),
		),
	);
	

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'slicetheme_global_metaboxes' );
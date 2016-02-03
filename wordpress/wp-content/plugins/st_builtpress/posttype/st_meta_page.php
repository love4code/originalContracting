<?php

/*******************************************************************
Register Meta Box
********************************************************************/
function slicetheme_page_metaboxes( array $meta_boxes ) {
	
	global $wp_registered_sidebars;
	
	$page_sidebars = array();
	$page_sidebars[0]['value'] = 'page_sidebar';
	$page_sidebars[0]['name'] = 'Page Sidebar';
	foreach ($wp_registered_sidebars as $key => $val) {		
		if ( substr($val['id'], 0, 3) == 'st_' ) {			
			$page_sidebars[$key]['value'] = $val['id'];
			$page_sidebars[$key]['name'] = $val['name'];
		}
	}
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_st_page_';

	$meta_boxes[] = array(
		'id'         => 'page_metabox',
		'title'      => 'Page Options',
		'pages'      => array( 'page', 'st_portfolio', 'st_service' ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => esc_html__('Layout', 'slicetheme'),
				'desc'    => '',
				'id'      => $prefix .'layout',
				'type'    => 'select',
				'std'     => 'fw',
				'options' => array(
					array( 'value' => 'fw', 'name' => 'Full Width' ),
					array( 'value' => 'lb', 'name' => 'Left Sidebar' ),
					array( 'value' => 'rb', 'name' => 'Right Sidebar' ),
				),
			),
			array(
				'name'    => esc_html__('Sidebar', 'slicetheme'),
				'desc'    => esc_html__('Available on left/right page layout.', 'slicetheme'),
				'id'      => $prefix .'sidebar',
				'type'    => 'select',
				'std'     => '',
				'options' => $page_sidebars,
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'slicetheme_page_metaboxes' );
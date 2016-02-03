<?php

/*******************************************************************
Register Post Type
********************************************************************/
function slicetheme_service_post_type() 
{
	$labels = array(
		'name'               => _x( 'Services', 'post type general name', 'slicetheme' ),
		'singular_name'      => _x( 'Service', 'post type singular name', 'slicetheme' ),
		'menu_name'          => _x( 'Services', 'admin menu', 'slicetheme' ),
		'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'slicetheme' ),
		'add_new'            => _x( 'Add New', 'service', 'slicetheme' ),
		'add_new_item'       => __( 'Add New Service', 'slicetheme' ),
		'new_item'           => __( 'New Service', 'slicetheme' ),
		'edit_item'          => __( 'Edit Service', 'slicetheme' ),
		'view_item'          => __( 'View Service', 'slicetheme' ),
		'all_items'          => __( 'All Services', 'slicetheme' ),
		'search_items'       => __( 'Search Services', 'slicetheme' ),
		'parent_item_colon'  => __( 'Parent Services:', 'slicetheme' ),
		'not_found'          => __( 'No services found.', 'slicetheme' ),
		'not_found_in_trash' => __( 'No services found in Trash.', 'slicetheme' )
	);
	
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'exclude_from_search'=> true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'service' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'excerpt', 'editor', 'thumbnail', 'page-attributes')
	);
	
	register_post_type( 'st_service' , $args );
	
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'slicetheme' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'slicetheme' ),
		'search_items'      => __( 'Search Categories', 'slicetheme' ),
		'all_items'         => __( 'All Categories', 'slicetheme' ),
		'parent_item'       => __( 'Parent Category', 'slicetheme' ),
		'parent_item_colon' => __( 'Parent Category:', 'slicetheme' ),
		'edit_item'         => __( 'Edit Category', 'slicetheme' ),
		'update_item'       => __( 'Update Category', 'slicetheme' ),
		'add_new_item'      => __( 'Add New Category', 'slicetheme' ),
		'new_item_name'     => __( 'New Category Name', 'slicetheme' ),
		'menu_name'         => __( 'Categories', 'slicetheme' ),
	);

	$args = array(
		'public'            => false,
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'query_var'         => false,
		'rewrite'           => array( 'slug' => 'service-category' ),
	);
	
	register_taxonomy( 'st_service_cat', array( 'st_service' ), $args );
}
add_action('init', 'slicetheme_service_post_type');


/*******************************************************************
Manage Columns
********************************************************************/
function slicetheme_service_edit_columns($columns)
{
	$newcolumns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'service-thumb' => esc_html__('Thumbnail', 'slicetheme')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}
add_filter('manage_edit-st_service_columns', 'slicetheme_service_edit_columns');

function slicetheme_service_custom_columns($column)
{
	global $post;
	
	switch ($column) {
		case 'service-thumb':
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('thumbnail', array('style' => 'width:75px; height:75px;'));
			} else {
				echo '<span aria-hidden="true">&#8212;</span>';
			}
		break;
	}
}
add_action('manage_posts_custom_column', 'slicetheme_service_custom_columns', 10, 2);


/*******************************************************************
Register Meta Box
********************************************************************/
function slicetheme_service_metaboxes( array $meta_boxes ) {

	global $wpdb;
	
	$icon_opts = array();
	$all_icons = slicetheme_get_icons();
	$icon_opts[0]['value'] = '';
	$icon_opts[0]['name'] = '';
	foreach ( $all_icons as $k => $dt ) {
		$icon_opts[$k]['value'] = $dt;
		$icon_opts[$k]['name'] = $dt;
	}
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_st_service_';

	$meta_boxes[] = array(
		'id'         => 'service_metabox',
		'title'      => 'Service Attributes',
		'pages'      => array( 'st_service' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Icon Font', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'icon',
				'type'    => 'select',
				'options' => $icon_opts,
			),		
			array(
				'name' => esc_html__('Icon Image', 'slicetheme'),
				'desc' => esc_html__('Override the icon.', 'slicetheme'),
				'id'   => $prefix .'icon_image',
				'type' => 'st_image_single',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'slicetheme_service_metaboxes' );
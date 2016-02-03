<?php

/*******************************************************************
Register Post Type
********************************************************************/
function slicetheme_client_post_type() 
{
	$labels = array(
		'name'               => _x( 'Clients', 'post type general name', 'slicetheme' ),
		'singular_name'      => _x( 'Client', 'post type singular name', 'slicetheme' ),
		'menu_name'          => _x( 'Clients', 'admin menu', 'slicetheme' ),
		'name_admin_bar'     => _x( 'Client', 'add new on admin bar', 'slicetheme' ),
		'add_new'            => _x( 'Add New', 'client', 'slicetheme' ),
		'add_new_item'       => __( 'Add New Client', 'slicetheme' ),
		'new_item'           => __( 'New Client', 'slicetheme' ),
		'edit_item'          => __( 'Edit Client', 'slicetheme' ),
		'view_item'          => __( 'View Client', 'slicetheme' ),
		'all_items'          => __( 'All Clients', 'slicetheme' ),
		'search_items'       => __( 'Search Clients', 'slicetheme' ),
		'parent_item_colon'  => __( 'Parent Clients:', 'slicetheme' ),
		'not_found'          => __( 'No clients found.', 'slicetheme' ),
		'not_found_in_trash' => __( 'No clients found in Trash.', 'slicetheme' )
	);
	
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'exclude_from_search'=> true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => false,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'client' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'thumbnail')
	);
	
	register_post_type( 'st_client' , $args );
}
add_action('init', 'slicetheme_client_post_type');


/*******************************************************************
Manage Columns
********************************************************************/
function slicetheme_client_edit_columns($columns)
{
	$newcolumns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'client-thumb' => esc_html__('Thumbnail', 'slicetheme'),
		'client-url' => esc_html__('Website URL', 'slicetheme')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}
add_filter('manage_edit-st_client_columns', 'slicetheme_client_edit_columns');

function slicetheme_client_custom_columns($column)
{
	global $post;
	
	switch ($column) {
		case 'client-thumb':
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('thumbnail', array('style' => 'width:75px; height:75px;'));
			} else {
				echo '<span aria-hidden="true">&#8212;</span>';
			}
		break;
		case 'client-url':
			$client_url = get_post_meta($post->ID, '_st_client_url', TRUE);
			if ( !empty($client_url) ) {
				echo '<span>'. esc_attr( $client_url ) .'</span>';
			}
			else {
				echo '<span aria-hidden="true">&#8212;</span>';
			}
		break;
	}
}
add_action('manage_posts_custom_column', 'slicetheme_client_custom_columns', 10, 2);


/*******************************************************************
Register Meta Box
********************************************************************/
function slicetheme_client_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_st_client_';

	$meta_boxes[] = array(
		'id'         => 'client_metabox',
		'title'      => 'Client Attributes',
		'pages'      => array( 'st_client' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Website URL', 'slicetheme'),
				'desc' => 'Optional',
				'id'   => $prefix .'url',
				'type' => 'st_text_large',
			),	
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'slicetheme_client_metaboxes' );

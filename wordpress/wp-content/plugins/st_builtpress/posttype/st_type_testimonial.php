<?php

/*******************************************************************
Register Post Type
********************************************************************/
function slicetheme_testimonial_post_type() 
{	
	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name', 'slicetheme' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name', 'slicetheme' ),
		'menu_name'          => _x( 'Testimonials', 'admin menu', 'slicetheme' ),
		'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'slicetheme' ),
		'add_new'            => _x( 'Add New', 'testimonial', 'slicetheme' ),
		'add_new_item'       => __( 'Add New Testimonial', 'slicetheme' ),
		'new_item'           => __( 'New Testimonial', 'slicetheme' ),
		'edit_item'          => __( 'Edit Testimonial', 'slicetheme' ),
		'view_item'          => __( 'View Testimonial', 'slicetheme' ),
		'all_items'          => __( 'All Testimonials', 'slicetheme' ),
		'search_items'       => __( 'Search Testimonials', 'slicetheme' ),
		'parent_item_colon'  => __( 'Parent Testimonials:', 'slicetheme' ),
		'not_found'          => __( 'No testimonials found.', 'slicetheme' ),
		'not_found_in_trash' => __( 'No testimonials found in Trash.', 'slicetheme' )
	);
	
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'exclude_from_search'=> true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => false,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonial' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'excerpt', 'thumbnail')
	);
	
	register_post_type( 'st_testimonial' , $args );
	
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
		'rewrite'           => array( 'slug' => 'testimonial-category' ),
	);
	
	register_taxonomy( 'st_testimonial_cat', array( 'st_testimonial' ), $args );
}
add_action('init', 'slicetheme_testimonial_post_type');


/*******************************************************************
Manage Columns
********************************************************************/
function slicetheme_testimonial_edit_columns($columns)
{
	$newcolumns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'testimonial-thumb' => esc_html__('Thumbnail', 'slicetheme'),
		'testimonial-position' => esc_html__('Position', 'slicetheme')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}
add_filter('manage_edit-st_testimonial_columns', 'slicetheme_testimonial_edit_columns');

function slicetheme_testimonial_custom_columns($column)
{
	global $post;
	
	switch ($column) {
		case 'testimonial-thumb':
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('thumbnail', array('style' => 'width:75px; height:75px;'));
			} else {
				echo '<span aria-hidden="true">&#8212;</span>';
			}
		break;
		case 'testimonial-position':
			$testimonial_position = get_post_meta($post->ID, '_st_testimonial_position', TRUE);
			if ( !empty($testimonial_position) ) {
				echo '<span>'. esc_attr( $testimonial_position ) .'</span>';
			}
			else {
				echo '<span aria-hidden="true">&#8212;</span>';
			}
		break;
	}
}
add_action('manage_posts_custom_column', 'slicetheme_testimonial_custom_columns', 10, 2);


/*******************************************************************
Register Meta Box
********************************************************************/
function slicetheme_testimonial_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_st_testimonial_';

	$meta_boxes[] = array(
		'id'         => 'testimonial_metabox',
		'title'      => 'Testimonial Attributes',
		'pages'      => array( 'st_testimonial' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Position', 'slicetheme'),
				'desc' => esc_html__('Enter position name in this person.', 'slicetheme'),
				'id'   => $prefix .'position',
				'type' => 'text_medium',
			),	
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'slicetheme_testimonial_metaboxes' );
<?php

/*******************************************************************
Register Post Type
********************************************************************/
function slicetheme_team_post_type() 
{
	$labels = array(
		'name'               => _x( 'Teams', 'post type general name', 'slicetheme' ),
		'singular_name'      => _x( 'Team', 'post type singular name', 'slicetheme' ),
		'menu_name'          => _x( 'Teams', 'admin menu', 'slicetheme' ),
		'name_admin_bar'     => _x( 'Team', 'add new on admin bar', 'slicetheme' ),
		'add_new'            => _x( 'Add New', 'team', 'slicetheme' ),
		'add_new_item'       => __( 'Add New Team', 'slicetheme' ),
		'new_item'           => __( 'New Team', 'slicetheme' ),
		'edit_item'          => __( 'Edit Team', 'slicetheme' ),
		'view_item'          => __( 'View Team', 'slicetheme' ),
		'all_items'          => __( 'All Teams', 'slicetheme' ),
		'search_items'       => __( 'Search Teams', 'slicetheme' ),
		'parent_item_colon'  => __( 'Parent Teams:', 'slicetheme' ),
		'not_found'          => __( 'No teams found.', 'slicetheme' ),
		'not_found_in_trash' => __( 'No teams found in Trash.', 'slicetheme' )
	);
	
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'exclude_from_search'=> true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => false,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'team' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'excerpt', 'editor', 'thumbnail', 'page-attributes')
	);
	
	register_post_type( 'st_team' , $args );
	
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
		'rewrite'           => array( 'slug' => 'team-category' ),
	);
	
	register_taxonomy( 'st_team_cat', array( 'st_team' ), $args );
}
add_action('init', 'slicetheme_team_post_type');


/*******************************************************************
Manage Columns
********************************************************************/
function slicetheme_team_edit_columns($columns)
{
	$newcolumns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'team-thumb' => esc_html__('Thumbnail', 'slicetheme'),
		'team-position' => esc_html__('Position', 'slicetheme')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}
add_filter('manage_edit-st_team_columns', 'slicetheme_team_edit_columns');

function slicetheme_team_custom_columns($column)
{
	global $post;
	
	switch ($column) {
		case 'team-thumb':
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('thumbnail', array('style' => 'width:75px; height:75px;'));
			} else {
				echo '<span aria-hidden="true">&#8212;</span>';
			}
		break;
		case 'team-position':
			$team_position = get_post_meta($post->ID, '_st_team_position', TRUE);
			if ( !empty($team_position) ) {
				echo '<span>'. esc_attr( $team_position ) .'</span>';
			}
			else {
				echo '<span aria-hidden="true">&#8212;</span>';
			}
		break;
	}
}
add_action('manage_posts_custom_column', 'slicetheme_team_custom_columns', 10, 2);


/*******************************************************************
Register Meta Box
********************************************************************/
function slicetheme_team_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_st_team_';

	$meta_boxes[] = array(
		'id'         => 'team_metabox',
		'title'      => 'Team Attributes',
		'pages'      => array( 'st_team' ), // Post type
		'context'    => 'normal',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Position', 'slicetheme'),
				'desc' => esc_html__('Enter position name in your company.', 'slicetheme'),
				'id'   => $prefix .'position',
				'type' => 'text_medium',
			),
			array(
				'name' => esc_html__('Phone', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'phone',
				'type' => 'text_medium',
			),
			array(
				'name' => esc_html__('Fax', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'fax',
				'type' => 'text_medium',
			),
			array(
				'name' => esc_html__('Email Address', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'email',
				'type' => 'text_medium',
			),
			array(
				'name' => esc_html__('Social Icons', 'slicetheme'),
				'desc' => '',
				'id'   => $prefix .'social',
				'type' => 'st_social_icons',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'slicetheme_team_metaboxes' );
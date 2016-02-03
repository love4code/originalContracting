<?php

/*******************************************************************
Register Post Type
********************************************************************/
function slicetheme_portfolio_post_type() 
{
	$labels = array(
		'name'               => _x( 'Portfolios', 'post type general name', 'slicetheme' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name', 'slicetheme' ),
		'menu_name'          => _x( 'Portfolios', 'admin menu', 'slicetheme' ),
		'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'slicetheme' ),
		'add_new'            => _x( 'Add New', 'portfolio', 'slicetheme' ),
		'add_new_item'       => __( 'Add New Portfolio', 'slicetheme' ),
		'new_item'           => __( 'New Portfolio', 'slicetheme' ),
		'edit_item'          => __( 'Edit Portfolio', 'slicetheme' ),
		'view_item'          => __( 'View Portfolio', 'slicetheme' ),
		'all_items'          => __( 'All Portfolios', 'slicetheme' ),
		'search_items'       => __( 'Search Portfolios', 'slicetheme' ),
		'parent_item_colon'  => __( 'Parent Portfolios:', 'slicetheme' ),
		'not_found'          => __( 'No portfolios found.', 'slicetheme' ),
		'not_found_in_trash' => __( 'No portfolios found in Trash.', 'slicetheme' )
	);
	
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'exclude_from_search'=> true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'thumbnail')
	);
	
	register_post_type( 'st_portfolio' , $args );
	
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
		'rewrite'           => array( 'slug' => 'portfolio-category' ),
	);
	
	register_taxonomy( 'st_portfolio_cat', array( 'st_portfolio' ), $args );
}
add_action('init', 'slicetheme_portfolio_post_type');


/*******************************************************************
Manage Columns
********************************************************************/
function slicetheme_portfolio_edit_columns($columns)
{
	$newcolumns = array(
		'cb' => '<input type="checkbox" />',
		'title' => 'Title',
		'portfolio-thumb' => esc_html__('Thumbnail', 'slicetheme')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}
add_filter('manage_edit-st_portfolio_columns', 'slicetheme_portfolio_edit_columns');

function slicetheme_portfolio_custom_columns($column)
{
	global $post;
	
	switch ($column) {
		case 'portfolio-thumb':
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('thumbnail', array('style' => 'width:75px; height:75px;'));
			} else {
				echo '<span aria-hidden="true">&#8212;</span>';
			}
		break;
	}
}
add_action('manage_posts_custom_column', 'slicetheme_portfolio_custom_columns', 10, 2);
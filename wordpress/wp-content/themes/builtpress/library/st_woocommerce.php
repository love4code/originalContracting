<?php

/*******************************************************************
WooCommerce
********************************************************************/
add_filter('woocommerce_show_page_title', '__return_false');

if ( !function_exists('builtpress_woo_thumbs') ) {
	function builtpress_woo_thumbs()
	{
		update_option('shop_catalog_image_size', array('width' => 600, 'height' => 750, 'crop' => true));
		update_option('shop_single_image_size', array('width' => 600, 'height' => 750, 'crop' => true));
		update_option('shop_thumbnail_image_size', array('width' => 90, 'height' => 90, 'crop' => true));
	}
}
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	add_action('init', 'builtpress_woo_thumbs', 1);
}


if ( !function_exists('builtpress_woo_shop_per_page') ) {
	function builtpress_woo_shop_per_page()
	{
		return intval( builtpress_opt('woo_count') );
	}
}
add_filter('loop_shop_per_page', 'builtpress_woo_shop_per_page', 20);


if ( !function_exists('builtpress_woo_shop_columns') ) {
	function builtpress_woo_shop_columns()
	{
		$cols = ( builtpress_opt('woo_layout') == 'fw' ) ? 4 : 3;
		return intval( $cols );
	}
}
add_filter('loop_shop_columns', 'builtpress_woo_shop_columns');


if ( !function_exists('builtpress_woo_related_products_args') ) {
	function builtpress_woo_related_products_args() {
		$cols = ( builtpress_opt('woo_layout') == 'fw' ) ? 4 : 3;
		$args = array(
			'posts_per_page' => intval( $cols ),
			'columns' => intval( $cols )
		);
	}
}
add_filter('woocommerce_output_related_products_args', 'builtpress_woo_related_products_args');


if ( !function_exists('builtpress_woo_breadcrumb') ) {
	function builtpress_woo_breadcrumb()
	{
		return array(
			'delimiter'   => '',
			'wrap_before' => '<ol class="breadcrumb">',
			'wrap_after'  => '</ol>',
			'before'      => '<li>',
			'after'       => '</li>',
			'home'        => _x('Home', 'breadcrumb', 'builtpress' ),
			);
	}
}
add_filter('woocommerce_breadcrumb_defaults', 'builtpress_woo_breadcrumb');
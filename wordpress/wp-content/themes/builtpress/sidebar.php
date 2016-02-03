<?php

if ( is_page() || is_singular( array('st_portfolio', 'st_service', 'st_team') ) ) {
	$sidebar = get_post_meta(get_the_ID(), '_st_page_sidebar', TRUE);
	if ( empty($sidebar) ) {
		$sidebar = 'page_sidebar';
	}
}
elseif ( class_exists('Woocommerce') && is_woocommerce() )
{
	$sidebar = 'shop_sidebar';
}
else {
	$sidebar = 'sidebar';
}

if ( is_active_sidebar( $sidebar ) ) { 
	dynamic_sidebar( esc_attr( $sidebar ) );
}
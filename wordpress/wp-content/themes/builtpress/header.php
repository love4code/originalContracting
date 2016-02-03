<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>	
</head>

<body <?php body_class(); ?>>

<div id="st-wrapper">
<?php

get_template_part( 'parts/header', esc_attr( builtpress_opt_page('header_style', 'v1') ) );

if ( !is_front_page() ) {
	if ( is_page() || is_singular( array('st_portfolio', 'st_service', 'st_team') ) ) {
		$general_title_hide = get_post_meta(get_the_ID(), '_st_general_title_hide', TRUE);
		if ( $general_title_hide <> 'on' ) {
			get_template_part( 'parts/header', 'pagetitle-custom' );
		}
	}
	elseif ( class_exists('Woocommerce') && is_woocommerce() ) {
		$general_title_hide = get_post_meta(get_option('woocommerce_shop_page_id'), '_st_general_title_hide', TRUE);
		if ( $general_title_hide <> 'on' ) {
			get_template_part( 'parts/header', 'pagetitle-custom' );
		}
	}
	else {
		get_template_part( 'parts/header', 'pagetitle' );
	}
}
<!-- main-container -->
<section id="content-wrapper" class="<?php echo builtpress_theme_isvc() ? 'is-vc' : 'not-vc'; ?>">

	<?php	
	$page_layout = 'fw';
	if ( is_page() || is_singular( array('st_portfolio', 'st_service', 'st_team') ) ) {
		$page_layout = get_post_meta(get_the_ID(), '_st_page_layout', TRUE);
	}
	elseif ( is_home() || is_archive() || is_search() || is_singular('post') ) {
		$page_layout = builtpress_opt('post_layout', 'rb');
	}
	if ( class_exists('Woocommerce') && is_woocommerce() )
	{
		$page_layout = builtpress_opt('woo_layout', 'rb');
	}
	
	switch ($page_layout):
		case 'rb':
			?>
			<div class="container">
			<div class="row">
			<main id="main-wrapper" class="col-md-9" role="main">
			<?php
		break;
		case 'lb':
			?>
			<div class="container">
			<div class="row">
			<main id="main-wrapper" class="col-md-9 col-md-push-3" role="main">
			<?php
		break;
		case 'fw':
		default:
			if ( !builtpress_theme_isvc() ) {
			?>
			<div class="container">
			<div class="row">
			<main id="main-wrapper" class="col-md-12" role="main">
			<?php
			}
		break;
	endswitch;
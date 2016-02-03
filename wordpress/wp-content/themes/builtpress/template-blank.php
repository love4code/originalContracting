<?php 
/*
Template Name: Blank Page
*/ 
?>
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
	
	<?php get_template_part( 'wrapper', 'start' ); ?>
	
		<?php	
		while ( have_posts() ) : the_post();
			get_template_part( 'parts/loop', 'page' );
		endwhile;
		?>
		   
	<?php get_template_part( 'wrapper', 'end' ); ?>
	
</div>
<!-- end .wrap -->

<?php wp_footer(); ?>
</body>
</html>
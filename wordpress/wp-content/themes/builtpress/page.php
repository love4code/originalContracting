<?php get_header(); ?>
	
	<?php get_template_part( 'wrapper', 'start' ); ?>
		
		<?php	
		while ( have_posts() ) : the_post();
			get_template_part( 'parts/single', 'page' );
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
		   
	<?php get_template_part( 'wrapper', 'end' ); ?>

<?php get_footer(); ?>
<?php get_header(); ?>
	
	<?php get_template_part( 'wrapper', 'start' ); ?>
		
		<?php	
		if ( have_posts() ) : 
			while ( have_posts() ) : the_post();
				get_template_part( 'parts/loop', 'search' );
			endwhile;
			the_posts_pagination( array(
				'mid_size'	=> 2,
				'prev_text'	=> '<i class="fa fa-angle-left"></i>',
				'next_text'	=> '<i class="fa fa-angle-right"></i>'
			) );
		else:
			get_template_part( 'parts/loop', 'none' );
		endif;
		?>
		   
	<?php get_template_part( 'wrapper', 'end' ); ?>

<?php get_footer(); ?>
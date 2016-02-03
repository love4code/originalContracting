<?php get_header(); ?>
	
	<?php get_template_part( 'wrapper', 'start' ); ?>
		
		<?php
		switch ( get_post_type() ):
			case 'st_portfolio':
				$single_loop = 'portfolio';
			break;
			case 'st_service':
				$single_loop = 'service';
			break;
			case 'st_team':
				$single_loop = 'team';
			break;
			case 'post':
			default:
				$single_loop = 'blog';
			break;
		endswitch;
		
		while ( have_posts() ) : the_post();
			get_template_part( 'parts/single', $single_loop );
			if ( is_singular('post') ) {
				the_post_navigation( array(
					'prev_text'	=> '%title',
					'next_text'	=> '%title'
				) );
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			}
		endwhile;
		?>
		   
	<?php get_template_part( 'wrapper', 'end' ); ?>

<?php get_footer(); ?>
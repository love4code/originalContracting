<?php get_header(); ?>
	
	<?php get_template_part( 'wrapper', 'start' ); ?>
		
		<!-- post entry -->
		<article class="page-404">
			
			<div class="post-content text-center">
				
				<div class="lead" style="font-size: 150px; line-height: normal; font-weight: bold;">404</div>
				
				<p class="lead"><?php esc_html_e('Apologies, but the page you requested could not be found.', 'builtpress'); ?></p>
				
				<div class="more-link"><a href="<?php echo esc_url( home_url('/') ); ?>"><?php esc_html_e('Back to Homepage', 'builtpress'); ?></a></div>
				
			</div>

		</article>
		<!-- end post entry -->
	
	<?php get_template_part( 'wrapper', 'end' ); ?>

<?php get_footer(); ?>
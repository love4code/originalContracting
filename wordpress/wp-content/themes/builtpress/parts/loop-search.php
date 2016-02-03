<!-- post entry -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
	<div class="blog-container">
        
		<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				
		<div class="post-excerpt">
			<?php
			the_excerpt();
			?>
			<div class="more-link"><a href="<?php the_permalink() ?>"><?php esc_html_e('Continue Reading', 'builtpress'); ?></a></div>
		</div>
	
	</div>
	
</article>
<!-- end post entry -->
<!-- post entry -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
	<div class="blog-container">
	
		<?php get_template_part( 'parts/partial', 'blog-media' ); ?>
		
		<div class="blog-inner">
        
        	<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
        	
            <div class="post-meta">
				<span class="post-author"><?php the_author_posts_link(); ?></span>
				<span class="post-date"><strong><?php echo get_the_time('j'); ?></strong><?php echo get_the_time('M'); ?></span>
				<span class="post-category"><?php the_category(', '); ?></span>
				<span class="post-comment"><i class="fa fa-comments-o"></i><?php comments_popup_link('0', '1', '%'); ?></span>
			</div>
					
			<div class="post-excerpt">
				<?php
				the_excerpt();
				?>
				<div class="more-link"><a href="<?php the_permalink() ?>"><?php esc_html_e('Continue Reading', 'builtpress'); ?></a></div>
			</div>
		
		</div>
	
	</div>
	
</article>
<!-- end post entry -->
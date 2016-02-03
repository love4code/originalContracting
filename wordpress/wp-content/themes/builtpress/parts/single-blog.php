<!-- post entry -->
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-single'); ?>>
    
    <h2 class="post-title"><?php the_title(); ?></h2>
	
	<div class="post-meta">
		<span class="post-author"><?php the_author_posts_link(); ?></span>
		<span class="post-date"><strong><?php echo get_the_time('j'); ?></strong><?php echo get_the_time('M'); ?></span>
		<span class="post-category"><?php the_category(', '); ?></span>
		<span class="post-comment"><i class="fa fa-comments-o"></i><?php comments_popup_link('0', '1', '%'); ?></span>
	</div>
		
	<?php get_template_part( 'parts/partial', 'blog-media' ); ?>
	
	<div class="post-content">
		<?php
		the_content();
		wp_link_pages( array(
			'before'      => '<div class="pagination"><strong>'. esc_html__('Pages:', 'builtpress') .'</strong>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>'
		) );
		edit_post_link('<i class="fa fa-pencil"></i>'. esc_html__('Edit Page', 'builtpress'), '<div class="edit-link">', '</div>');
		if ( builtpress_opt('post_tags') ) {
			the_tags('<div class="post-tags"><i class="fa fa-tags"></i> <strong>'. esc_html__('Tags:', 'builtpress') .'</strong>', ', ', '</div>');
		}
		?>
	</div>
	
	<?php if ( builtpress_opt('post_author') ) { ?>
	<div class="post-authors">
		<h3 class="st-subheading"><?php esc_html_e('About Author', 'builtpress'); ?></h3>
		<div class="author-left pull-left">
			<?php echo get_avatar(get_the_author_meta('email'), 75); ?>
		</div>
		<div class="author-right">
			<h4><?php the_author_posts_link(); ?></h4>		
			<div class="author-description"><?php the_author_meta('description'); ?></div>
		</div>
	</div>
	<?php } ?>
	
</article>
<!-- end post entry -->
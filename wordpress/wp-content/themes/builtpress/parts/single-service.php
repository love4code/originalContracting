<!-- post entry -->
<article id="post-<?php the_ID(); ?>" <?php post_class('service-single'); ?>>
	
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
		?>
	</div>

</article>
<!-- end post entry -->
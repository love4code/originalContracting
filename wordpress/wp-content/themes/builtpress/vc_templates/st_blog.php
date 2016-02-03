<?php

extract(shortcode_atts(array(
	'columns' => '4',
	'category' => '',
	'number' => '4'
), $atts));

$columns = ( intval( $columns ) > 4 ) ? 4 : intval( $columns );
$span = array(1 => 'col-md-12', 2 => 'col-md-6 col-sm-6 col-xs-12', 3 => 'col-md-4 col-sm-6 col-xs-12', 4 => 'col-md-3 col-sm-6 col-xs-12');
$columnstospan = $span[$columns];

if ( !empty($category) ) {
	$loop = new WP_Query('cat='.intval( $category ).'&posts_per_page='.intval( $number ));
}
else {
	$loop = new WP_Query('posts_per_page='.intval( $number ));
}

if ($loop->have_posts()) :
?>

<div class="st-blog">    
	<div class="row">
	<?php while ($loop->have_posts()) : $loop->the_post(); ?>
		<div class="<?php echo esc_attr( $columnstospan ); ?>">
			<div class="blog-container">
				<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-thumb"><a href="<?php the_permalink(); ?>" title=""><?php the_post_thumbnail('builtpress-small'); ?></a></div>
				<?php } ?>
				<div class="blog-inner">
					<h4 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<div class="post-excerpt">
						<?php echo builtpress_excerpt(15); ?>
					</div>
					<div class="post-meta">
                        <span class="post-date"><strong><?php echo get_the_time('j'); ?></strong><?php echo get_the_time('M'); ?></span>
						<span class="post-comment"><i class="fa fa-comments-o"></i><?php comments_popup_link('0', '1', '%'); ?></span>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
	</div>		
</div>

<?php
wp_reset_postdata();
endif;
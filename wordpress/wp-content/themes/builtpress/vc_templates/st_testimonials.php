<?php

extract(shortcode_atts(array(
	'animate' => '',
	'columns' => '2',
	'category' => '',
	'number' => '-1'
), $atts));

$animate_class = !empty($animate) ? ' wow animated '. $animate : '';

$columns = ( intval( $columns ) > 2 ) ? 2 : intval( $columns );
$span = array(1 => 'col-md-12', 2 => 'col-md-6 col-sm-6 col-xs-12');
$columnstospan = $span[$columns];

if ( !empty($category) ) {
	$args = array(
		'post_type' => 'st_testimonial',
		'posts_per_page' => intval( $number ),
		'tax_query' => array(
			array(
				'taxonomy' => 'st_testimonial_cat',
				'field' => 'term_id',
				'terms' => intval( $category )
			)
		)
	);
	$loop = new WP_Query($args);
}
else {
	$loop = new WP_Query('post_type=st_testimonial&order=ASC&posts_per_page='.intval( $number ));
}

if ($loop->have_posts()) :

	echo '<div class="st-testimonial">';
		echo '<div class="row">';
			while ($loop->have_posts()) : $loop->the_post();
				
				$testimonial_position = get_post_meta(get_the_ID(), '_st_testimonial_position', TRUE);
				
				echo '<div class="'. esc_attr( $columnstospan ) .'">';
					echo '<div class="testimonial-container'. esc_attr( $animate_class ) .'">';
						echo '<div class="testimonial-photo">'. builtpress_thumbnail('builtpress-testimonial') .'</div>';
						echo '<div class="testimonial-content">';
							echo get_the_excerpt();
							echo '<div class="testimonial-meta">';
								echo '<h4>'. get_the_title() .' </h4>';
								echo '<span class="testimonial-position">'. esc_attr( $testimonial_position ) .'</span>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			endwhile;
		echo '</div>';
	echo '</div>';

wp_reset_postdata();
endif;
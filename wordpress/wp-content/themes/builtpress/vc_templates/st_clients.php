<?php

extract(shortcode_atts(array(
	'animate' => '',
	'columns' => '4',
	'number' => '-1'
), $atts));

$animate_class = !empty($animate) ? ' wow animated '. $animate : '';

$columns = ( intval( $columns ) > 4 ) ? 4 : intval( $columns );
$span = array(2 => 'col-md-6 col-sm-6 col-xs-6', 3 => 'col-md-4 col-sm-4 col-xs-6', 4 => 'col-md-3 col-sm-4 col-xs-6');
$columnstospan = $span[$columns];

$loop = new WP_Query('post_type=st_client&posts_per_page='.intval( $number ));

if ($loop->have_posts()) :

	echo '<div class="st-client">';
		echo '<ul class="row list-inline">';
			while ($loop->have_posts()) : $loop->the_post();
				if ( has_post_thumbnail() ) {
					
					$client_url = get_post_meta(get_the_ID(), '_st_client_url', TRUE);
					
					echo '<li class="'. esc_attr( $columnstospan ) . esc_attr( $animate_class ) .'">';
					if ( !empty($client_url) ) {
						echo '<span><a href="'. esc_url( $client_url ) .'" title="'. the_title_attribute('echo=0') .'" target="_blank">'. get_the_post_thumbnail(get_the_ID(), 'builtpress-client') .'</a></span>';
					}
					else {
						echo '<span>'. get_the_post_thumbnail(get_the_ID(), 'builtpress-client') .'</span>';
					}
					echo '</li>';
				}
			endwhile;
		echo '</ul>';
	echo '</div>';

wp_reset_postdata();
endif;
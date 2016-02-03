<?php

extract(shortcode_atts(array(
	'number' => '-1'
), $atts));

$loop = new WP_Query('post_type=st_client&posts_per_page='.intval( $number ));

if ($loop->have_posts()) :

	echo '<div class="st-client-slider owl-carousel">';
		while ($loop->have_posts()) : $loop->the_post();
		
			$client_url = get_post_meta(get_the_ID(), '_st_client_url', TRUE);
			
			echo '<div class="client-container">';
				if ( !empty($client_url) ) {
					echo '<span><a href="'. esc_url( $client_url ) .'" title="'. the_title_attribute('echo=0') .'" target="_blank">'. get_the_post_thumbnail(get_the_ID(), 'builtpress-client') .'</a></span>';
				}
				else {
					echo '<span>'. get_the_post_thumbnail(get_the_ID(), 'builtpress-client') .'</span>';
				}
			echo '</div>';
		endwhile;
	echo '</div>';

wp_reset_postdata();
endif;
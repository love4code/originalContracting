<?php

extract(shortcode_atts(array(
	'style' => '1',
	'columns' => '3',
	'category' => '',
	'number' => '-1',
	'filter'	=> 'no',
	'link_label' => 'Learn More'
), $atts));

switch ($columns):
	case 2:
		$column_class = 'post-item col-md-6 col-sm-6 col-xs-12';
	break;
	case 3:
		$column_class = 'post-item col-md-4 col-sm-6 col-xs-12';
	break;
	case 4:
	default:
		$column_class = 'post-item col-md-3 col-sm-6 col-xs-12';
	break;
endswitch;

if ( !empty($category) ) {
	$args = array(
		'post_type' => 'st_service',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => intval( $number ),
		'tax_query' => array(
			array(
				'taxonomy' => 'st_service_cat',
				'field' => 'term_id',
				'terms' => intval( $category )
			)
		),
		'paged' => $paged
	);
	$loop = new WP_Query($args);
}
else {
	$loop = new WP_Query('post_type=st_service&orderby=menu_order&order=ASC&posts_per_page='.intval( $number ));
}

if ($loop->have_posts()) :

	echo '<div class="st-service">';
	
		if ( $filter == 'yes' ) echo builtpress_filters('st_service_cat', $category);
		
		echo '<div class="serviceHolder row" data-layout="fitRows">';
		
			while ($loop->have_posts()) : $loop->the_post();
				
				$terms = get_the_terms(get_the_ID(), 'st_service_cat');
				$datatype = array();
				foreach ( $terms as $term ) {
					$datatype[] = $term->slug;
				}
				
				$col_class = $column_class .' '. @implode(' ', $datatype);
				
				echo '<div class="'. esc_attr( $col_class ) .'">';
				
					$service_icon = get_post_meta(get_the_ID(), '_st_service_icon', TRUE);
					$service_icon_image = get_post_meta(get_the_ID(), '_st_service_icon_image', TRUE);
					
					switch ($style):
						case 2:
							echo '<div class="service-container style-'. intval( $style ) .'">';
								echo '<div class="service-image">';
									echo '<a href="'. get_permalink() .'">'. builtpress_thumbnail('builtpress-service') .'</a>';
								echo '</div>';
								echo '<div class="service-content">';
									echo '<h4><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
									echo '<div>'. get_the_excerpt() .'</div>';
									echo '<div class="service-link"><a href="'. get_permalink() .'">'. esc_attr( $link_label ) .'</a></div>';
								echo '</div>';
								echo '<div class="clearfix"></div>';
							echo '</div>';
						break;
						default:
							echo '<div class="service-container style-'. intval( $style ) .'">';
								if ( !empty($service_icon_image) ) {
									echo '<div class="service-image">';
										echo '<span>'. wp_get_attachment_image($service_icon_image, 'thumbnail') .'</span>';
									echo '</div>';
								} elseif ( !empty($service_icon) ) {
									echo '<div class="service-icon">';
										echo '<span><i class="'. esc_attr( $service_icon ) .'"></i></span>';
									echo '</div>';
								}								
								echo '<div class="service-content">';
									echo '<h4><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
									echo '<div>'. get_the_excerpt() .'</div>';
									echo '<div class="service-link"><a href="'. get_permalink() .'">'. esc_attr( $link_label ) .'</a></div>';
								echo '</div>';
								echo '<div class="clearfix"></div>';
							echo '</div>';
						break;
					endswitch;
				
				echo '</div>';
				
			endwhile;
			
		echo '</div>';
	
	echo '</div>';
	
wp_reset_postdata();
endif;
<?php

extract(shortcode_atts(array(
	'style' => '1',
	'columns' => '3',
	'category' => '',
	'number' => '3',
	'nospace'	=> 'no',
	'filter'	=> 'no',
	'load_more'	=> 'no',
	'link_label' => 'View Project'
), $atts));

$add_class = ( $nospace == 'yes' ) ? ' nospace' : '';
	
$portfolioID = 'portfolio'.md5($columns.$category.$number.$filter.$load_more);

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

$paged = get_query_var('paged') ? get_query_var('paged') : ( get_query_var('page') ? get_query_var('page') : 1 );
if ( !empty($category) ) {
	$args = array(
		'post_type' => 'st_portfolio',
		'posts_per_page' => intval( $number ),
		'tax_query' => array(
			array(
				'taxonomy' => 'st_portfolio_cat',
				'field' => 'term_id',
				'terms' => intval( $category )
			)
		),
		'paged' => $paged
	);
	$loop = new WP_Query($args);
}
else {
	$args = array(
		'post_type' => 'st_portfolio',
		'posts_per_page' => intval( $number ),
		'paged' => $paged
	);
	$loop = new WP_Query($args);
}

global $wp_query;
$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query   = $loop;

if ($loop->have_posts()) :
		
	echo '<div class="st-portfolio'. $add_class .'">';
	
		if ( $filter == 'yes' ) echo builtpress_filters('st_portfolio_cat', $category);
		
		echo '<div class="portfolioHolder '. $portfolioID .' row" data-layout="fitRows">';
		
		while ($loop->have_posts()) : $loop->the_post();
			
			$terms = get_the_terms(get_the_ID(), 'st_portfolio_cat');
			$datatype = array();
			foreach ( $terms as $term ) {
				$datatype[] = $term->slug;
			}
			
			$article_class = $column_class .' '. @implode(' ', $datatype);
			
			echo '<article class="'. $article_class .'">';
			
				switch ($style):
					case 2:
						echo '<div class="portfolio-container style-'. intval( $style ) .'">';
							echo '<div class="portfolio-image">';
								echo '<a href="'. get_permalink() .'">';
									echo builtpress_thumbnail('builtpress-portfolio');
									echo '<div class="zoom-overlay"></div>';
								echo '</a>';
							echo '</div>';
							echo '<div class="portfolio-content">';
								echo '<h4><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
							echo '</div>';
							echo '<div class="clearfix"></div>';
						echo '</div>';
					break;
					case 1:
					default:
						echo '<div class="portfolio-container style-'. intval( $style ) .'">';
							echo '<div class="portfolio-image">';
								echo builtpress_thumbnail('builtpress-portfolio');
								echo '<div class="zoom-overlay"></div>';
							echo '</div>';
							echo '<div class="portfolio-content">';
								echo '<h4>'. get_the_title() .'</h4>';
								echo '<div class="portfolio-link"><a href="'. get_permalink() .'">'. esc_attr( $link_label ) .'</a></div>';
							echo '</div>';
							echo '<div class="clearfix"></div>';
						echo '</div>';
					break;
				endswitch;							
			
			echo '</article>';
			
		endwhile;
			
		echo '</div>';
		
		if ( $load_more == 'yes' ) {
			echo '<div class="load-more load-'. $portfolioID .'">';
			echo get_next_posts_link( esc_html__('Show More', 'builtpress'), $loop->max_num_pages );
			echo '</div>';
		}
		
	echo '</div>';

wp_reset_postdata();
endif;

$wp_query = NULL;
$wp_query = $temp_query;
<?php

extract(shortcode_atts(array(
	'style' => '1',
	'animate' => '',
	'columns' => '3',
	'category' => '',
	'number' => '-1',
	'link_label' => 'Learn More'
), $atts));

$animate_class = !empty($animate) ? ' wow animated '. $animate : '';

$columns = ( intval( $columns ) > 4 ) ? 4 : intval( $columns );
$span = array(1 => 'col-md-12', 2 => 'col-md-6 col-sm-6 col-xs-12', 3 => 'col-md-4 col-sm-6 col-xs-12', 4 => 'col-md-3 col-sm-6 col-xs-12');
$columnstospan = $span[$columns];

if ( !empty($category) ) {
	$args = array(
		'post_type' => 'st_team',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => intval( $number ),
		'tax_query' => array(
			array(
				'taxonomy' => 'st_team_cat',
				'field' => 'term_id',
				'terms' => intval( $category )
			)
		)
	);
	$loop = new WP_Query($args);
}
else {
	$loop = new WP_Query('post_type=st_team&orderby=menu_order&order=ASC&posts_per_page='.intval( $number ));
}

if ($loop->have_posts()) :

	echo '<div class="st-team">';
		echo '<div class="row">';
			while ($loop->have_posts()) : $loop->the_post();
				
				$team_position = get_post_meta(get_the_ID(), '_st_team_position', TRUE);
				
				echo '<div class="'. esc_attr( $columnstospan ) .'">';
					echo '<div class="team-container style-'. intval( $style ) . esc_attr( $animate_class ) .'">';
						echo '<div class="team-photo">';
							echo '<span>'. builtpress_thumbnail('builtpress-team') .'</span>';
							echo '<div class="team-content">';
								echo get_the_excerpt();
								echo builtpress_team_socials();
							echo '</div>';
						echo '</div>';
						echo '<div class="team-inner">';
							echo '<div class="team-meta">';
								echo '<h4>'. get_the_title() .'</h4>';
								echo '<span class="team-position">'. esc_attr( $team_position ) .'</span>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			endwhile;
		echo '</div>';
	echo '</div>';
	
wp_reset_postdata();
endif;
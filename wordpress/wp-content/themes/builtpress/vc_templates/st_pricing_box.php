<?php

extract(shortcode_atts(array(
	'style' => '1',
	'featured' => 'no',
	'title' => '',
	'price' => '',
	'currency' => '',
	'note' => '',
	'link_label' => '',
	'link_url' => ''
), $atts));

$featured = ( $featured == 'yes' ) ? ' box-featured' : '';

$href = !empty($link_url) ? vc_build_link($link_url) : array('url' => '#', 'title' => '', 'target' => '_self');

echo '<div class="st-pricingbox style-'. intval( $style ) . esc_attr( $featured ) .'">';
	echo '<div class="box-meta">';
		echo '<h4 class="box-title">'. esc_attr( $title ) .'</h4>';
		echo '<div class="box-price">';
			echo '<span class="price-currency">'. esc_attr( $currency ) .'</span>';
			echo '<span class="price-cost">'. esc_attr( $price ) .'</span>';
			echo '<span class="price-note">'. esc_attr( $note ) .'</span>';
		echo '</div>';
	echo '</div>';
	echo '<div class="box-content">'. wp_kses_post( $content ) .'</div>';
	if ( !empty($href['url']) && !empty($link_label) ) echo '<div class="box-link"><a href="'. $href['url'] .'" target="'. $href['target'] .'">'. esc_attr( $link_label ) .'</a></div>';
echo '</div>';
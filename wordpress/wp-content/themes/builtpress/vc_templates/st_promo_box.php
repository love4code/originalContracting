<?php

extract(shortcode_atts(array(
	'image' => '',
	'title' => '',
	'sub_title' => '',
	'link_url' => ''
), $atts));

$href = !empty($link_url) ? vc_build_link($link_url) : array('url' => '#', 'title' => '', 'target' => '_self');

echo '<div class="st-promobox">';
	if ( !empty($href['url']) ) echo '<a href="'. $href['url'] .'" target="'. $href['target'] .'">';
		echo '<div class="box-image">';
			echo '<span>'. wp_get_attachment_image($image, 'full') .'</span>';
		echo '</div>';
		echo '<div class="box-content">';
			echo '<div class="box-content-inner">';
				if ( !empty($title) ) echo '<h4 class="box-title">'. esc_attr( $title ) .'</h4>';
				if ( !empty($sub_title) ) echo '<div class="box-subtitle">'. esc_attr( $sub_title ) .'</div>';
			echo '</div>';
		echo '</div>';
	if ( !empty($href['url']) ) echo '</a>';
echo '</div>';
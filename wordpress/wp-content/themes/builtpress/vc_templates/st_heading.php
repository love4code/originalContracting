<?php

extract(shortcode_atts(array(
	'style' => '1',
	'align' => 'left',
	'title' => ''
), $atts));

echo '<div class="st-heading style-'. intval( $style ) .' text-'. esc_attr( $align ) .'">';
	echo '<h3 class="box-title">'. esc_attr( $title ) .'</h3>';
	if ( !empty($content) ) echo '<div class="box-content">'. wp_kses_post( $content ) .'</div>';
echo '</div>';
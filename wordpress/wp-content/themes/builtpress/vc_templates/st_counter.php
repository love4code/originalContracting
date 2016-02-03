<?php

extract(shortcode_atts(array(
	'style' => 'default',
	'icon' => '',
	'icon_position' => 'top',
	'color' => '',
	'number' => '',
	'title' => ''
), $atts));

$color_css = !empty($color) ? ' style="color:'. esc_attr( $color ) .';"' : '';

if ( $style == 'icon' )
{
	echo '<div class="st-counter style-'. esc_attr( $style ) .' icon-'. esc_attr( $icon_position ) .'">';
		if ( !empty($icon) ) {
			echo '<div class="box-icon">';
				echo '<span><i class="'. esc_attr( $icon ) .'"'. $color_css .'></i></span>';
			echo '</div>';
		}
		echo '<div class="box-inner">';
			echo '<div class="counter-number" data-to="'. intval( $number ) .'">0</div>';
			if ( !empty($title) ) echo '<h4 class="box-title">'. esc_attr( $title ) .'</h4>';
		echo '</div>';
	echo '</div>';
}
else
{	
	echo '<div class="st-counter style-'. esc_attr( $style ) .'">';
		echo '<div class="box-inner">';
			echo '<div class="counter-number" data-to="'. intval( $number ) .'"'. $color_css .'>0</div>';
			if ( !empty($title) ) echo '<h4 class="box-title">'. esc_attr( $title ) .'</h4>';
		echo '</div>';
	echo '</div>';
}
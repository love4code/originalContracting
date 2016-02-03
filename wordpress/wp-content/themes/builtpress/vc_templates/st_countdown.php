<?php

extract(shortcode_atts(array(
	'date' => ''
), $atts));

if ( empty($date) ) {
	$date = date('Y/m/d', strtotime('+2 month'));	
}

echo '<div class="st-countdown">';
	echo '<div class="countdown" data-date='. esc_attr( $date ) .'></div>';
echo '</div>';
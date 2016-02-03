<?php

extract(shortcode_atts(array(
	'style' => '1',
	'values' => ''
), $atts));

$values = (array) vc_param_group_parse_atts( $values );

echo '<div class="st-metabox style-'. intval( $style ) .'">';
	echo '<ul>';		
		foreach ( $values as $data )
		{
			echo '<li><span class="box-label">'. esc_attr( $data['label'] ) .'</span><span class="box-value">'. esc_attr( $data['value'] ) .'</span></li>';
		}		
	echo '</ul>';
echo '</div>';
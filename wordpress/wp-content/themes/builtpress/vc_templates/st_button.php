<?php

extract(shortcode_atts(array(
	'style' => '1',
	'size' => 'small',
	'icon' => '',
	'link_label' => 'Read More',
	'link_url' => ''
), $atts));

$icon_class = !empty($icon) ? '<i class="'. esc_attr( $icon ) .'"></i>' : '';

$href = !empty($link_url) ? vc_build_link($link_url) : array('url' => '#', 'title' => '', 'target' => '_self');

printf(
	'<a class="st-button style-%s size-%s" href="%s" target="%s">%s<span>%s</span></a>',
	intval( $style ),
	esc_attr( $size ),
	$href['url'],
	$href['target'],
	$icon_class,
	esc_attr( $link_label )
	);
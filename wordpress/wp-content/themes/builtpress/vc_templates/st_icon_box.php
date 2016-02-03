<?php

extract(shortcode_atts(array(
	'style' => '1',
	'icon_type' => '',
	'icon_fontawesome' => '',
	'icon_openiconic' => '',
	'icon_typicons' => '',
	'icon_entypo' => '',
	'icon_linecons' => '',
	'icon_position' => 'left',
	'title' => '',
	'link_label' => '',
	'link_url' => '',
	'color_hover' => '',
	'bg_color_hover' => ''
), $atts));

$icon_type = empty($icon_type) ? 'fontawesome' : $icon_type;

$icon_font = '';
if ( in_array($icon_type, array('fontawesome', 'openiconic', 'typicons', 'entypo', 'linecons')) ) {
	$icon_font = ${'icon_'. $icon_type};
	wp_enqueue_style('vc_'. $icon_type);
}

$position_class = ( $style == 2 ) ? ' icon-'. esc_attr( $icon_position ) : '';
$align_class = ( $style == 2 ) ? ' text-'. esc_attr( $icon_position ) : '';

$att_data = '';
if ( $style == 3 ) {
	if ( !empty($bg_color_hover) ) {
		$att_data.= 'data-hover-background="'. esc_attr( $bg_color_hover ) .'" ';
	}
	if ( !empty($color_hover) ) {
		$att_data.= 'data-hover-color="'. esc_attr( $color_hover ) .'" ';
	}
}

$href = !empty($link_url) ? vc_build_link($link_url) : array('url' => '#', 'title' => '', 'target' => '_self');

echo '<div class="st-iconbox style-'. intval( $style ) . $position_class .'" '. $att_data .'>';
	echo '<div class="iconbox-container">';
		if ( !empty($icon_font) ) {
			echo '<div class="box-icon">';
				echo '<span><i class="'. esc_attr( $icon_font ) .'"></i></span>';
			echo '</div>';
		}
		echo '<div class="box-content'. $align_class .'">';
			if ( !empty($title) ) echo '<h4 class="box-title">'. esc_attr( $title ) .'</h4>';
			if ( !empty($content) ) echo '<div>'. wp_kses_post( $content ) .'</div>';
			if ( !empty($href['url']) && !empty($link_label) ) echo '<div class="box-link"><a href="'. $href['url'] .'" target="'. $href['target'] .'">'. esc_attr( $link_label ) .'</a></div>';
		echo '</div>';
		echo '<div class="clearfix"></div>';
	echo '</div>';
echo '</div>';
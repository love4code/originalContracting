<?php

class BuiltPress_Social_Widget extends BuiltPress_Widget {

	function __construct()
	{
		$this->widget = array(
			'id_base'     => 'st-social-wgt',
			'name'        => esc_html__('Social Icons', 'builtpress'),
			'description' => ''
		);

		parent::__construct();
	}
	
	function set_fields()
	{
		$getSocial = builtpress_get_socials();
		$social_opts = array();
		foreach ( $getSocial as $k => $v ) {
			$social_opts[$k] = $v[1];
		}
		
		$fields['title'] = array(
			'type'		=> 'text',
			'label'		=> esc_html__('Title', 'builtpress'),
		);
		
		$fields['social_show'] = array(
			'type'		=> 'checkbox',
			'label'		=> esc_html__('Social Icon?', 'builtpress'),
			'options'	=> $social_opts,
		);

		$this->fields = $fields;
	}

	function widget( $args, $instance )
	{
		extract($args, EXTR_SKIP);
		extract($instance, EXTR_SKIP);
		
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
		
		echo $before_widget;
		
		if ( !empty( $title ) ) { echo $before_title . esc_attr( $title ) . $after_title; }
		
		builtpress_theme_socials($social_show);
		
		echo $after_widget;
	}
	
}

function builtpress_social_widget()
{
	register_widget('BuiltPress_Social_Widget');
}
add_action('widgets_init', 'builtpress_social_widget');
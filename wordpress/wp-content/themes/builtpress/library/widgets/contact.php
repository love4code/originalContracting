<?php

class BuiltPress_Contact_Widget extends BuiltPress_Widget {

	function __construct()
	{
		$this->widget = array(
			'id_base'     => 'st-contact-wgt',
			'name'        => esc_html__('Contact Info', 'builtpress'),
			'description' => ''
		);

		parent::__construct();
	}
	
	function set_fields()
	{
		$fields['title'] = array(
			'type'		=> 'text',
			'label'		=> esc_html__('Title', 'builtpress'),
		);
		
		$fields['address'] = array(
			'type'		=> 'textarea',
			'label'		=> esc_html__('Address', 'builtpress'),
		);
		
		$fields['phone'] = array(
			'type'		=> 'text',
			'label'		=> esc_html__('Phone', 'builtpress'),
		);
		
		$fields['fax'] = array(
			'type'		=> 'text',
			'label'		=> esc_html__('Fax', 'builtpress'),
		);
		
		$fields['email'] = array(
			'type'		=> 'text',
			'label'		=> esc_html__('Email', 'builtpress'),
		);

		$this->fields = $fields;
	}

	function widget( $args, $instance )
	{
		extract($args, EXTR_SKIP);
		extract($instance, EXTR_SKIP);
		
		$title = apply_filters('widget_title', empty($title) ? $this->widget['name'] : $title, $instance, $this->id_base);
		
		echo $before_widget;
		
		if ( !empty( $title ) ) { echo $before_title . esc_attr( $title ) . $after_title; }
		
		?>
		<ul>
			<?php if ( !empty($address) ) { ?>
			<li><i class="fa fa-map-marker"></i> <?php echo wp_kses_post( $address ); ?></li>
			<?php } ?>
			<?php if ( !empty($phone) ) { ?>
			<li><i class="fa fa-phone"></i> <?php echo esc_attr( $phone ); ?></li>
			<?php } ?>
			<?php if ( !empty($fax) ) { ?>
			<li><i class="fa fa-print"></i> <?php echo esc_attr( $fax ); ?></li>
			<?php } ?>
			<?php if ( !empty($email) ) { ?>
			<li><i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_attr( $email ); ?></a></li>
			<?php } ?>
		</ul>
		<?php
		
		echo $after_widget;
	}
	
}

function builtpress_contact_widget()
{
	register_widget('BuiltPress_Contact_Widget');
}
add_action('widgets_init', 'builtpress_contact_widget');
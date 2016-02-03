<?php

class BuiltPress_Widget extends WP_Widget {

	protected $widget;
	protected $fields;

	function __construct()
	{
		$this->set_fields();
		
		parent::__construct(
			$this->widget['id_base'],
			'SliceTheme - ' . $this->widget['name'],
			array(
				'classname' => isset($this->widget['classname']) ? $this->widget['classname'] : $this->widget['id_base'],
				'description' => $this->widget['description']
			),
			isset($this->widget['control_ops']) ? $this->widget['control_ops'] : array()
		);
	}

    function set_fields()
	{
    	$this->fields = array();
    }

    function update( $new_instance, $old_instance )
	{
		$instance = wp_parse_args($new_instance, $old_instance);

		foreach ((array)$this->fields as $k => $v)
		{
			if ($v['type'] == 'text') {
				$instance[$k] = sanitize_text_field( $new_instance[$k] );
			}
			elseif ($v['type'] == 'checkbox') {
				if ( isset($v['options']) && is_array($v['options']) ) {
					foreach ($v['options'] as $opt_name => $opt_val) {
						$instance[$k][$opt_name] = isset($new_instance[$k][$opt_name]) ? 1 : 0;
					}
				}
				else {
					$instance[$k] = isset($new_instance[$k]) ? 1 : 0;
				}
			}
		}

		return $instance;
    }

    function form( $instance )
	{
		foreach ($this->fields as $k => $v)
		{
			echo '<p>';
			
			echo '<label for="' . $this->get_field_id($k) .'">' . $v['label'] . ':</label>' . "\n";
			
			$std = isset($v['std']) ? $v['std'] : '';
			$class = isset($v['class']) ? $v['class'] : 'widefat';
			$attributes = isset($v['attributes']) ? $v['attributes'] : '';
			
			$value = $instance ? $instance[$k] : $std;

			if ($v['type'] == 'checkbox') {
				if ( isset($v['options']) && is_array($v['options']) ) {
					foreach ($v['options'] as $opt_name => $opt_val) {
						$value[$opt_name] = $instance ? $instance[$k][$opt_name] : $std;
					}
				}
				else {
					$value = $instance ? $instance[$k] : $std;
				}
			}

			switch ($v['type']) {

				case 'text':
					printf(
						'<input type="text" name="%s" id="%s" value="%s" class="%s" %s />',
						$this->get_field_name($k),
						$this->get_field_id($k),
						esc_attr( $value ),
						esc_attr( $class ),
						esc_attr( $attributes )
					);
				break;

				case 'textarea':
					printf(
						'<textarea name="%s" id="%s" class="%s" rows="5" %s>%s</textarea>',
						$this->get_field_name($k),
						$this->get_field_id($k),
						esc_attr( $class ),
						esc_attr( $attributes ),
						wp_kses_post( $value )
					);
					break;

				case 'select':
					printf(
						'<select name="%s" id="%s" class="%s" %s>',
						$this->get_field_name($k),
						$this->get_field_id($k),
						esc_attr( $class ),
						esc_attr( $attributes )
					);
					foreach ((array)$v['options'] as $opt_name => $opt_val) {
						printf(
							'<option value="%s"%s>%s</option>',
							esc_attr( $opt_name ),
							selected($value, $opt_name, false),
							esc_attr( $opt_val )
						);
					}
					echo '</select>';
				break;

				case 'checkbox':
					if ( isset($v['options']) && is_array($v['options']) ) {
						foreach ($v['options'] as $opt_name => $opt_val) {
							printf(
								'<span style="display:block;margin-top:10px;"><input id="%s-%s" class="checkbox" type="checkbox" value="1" name="%s[%s]" %s>
								<label for="%s">%s</label></span>',
								$this->get_field_id($k),
								esc_attr( $opt_name ),
								$this->get_field_name($k),
								esc_attr( $opt_name ),
								checked($value[$opt_name], true, false),
								$this->get_field_id($k),
								esc_attr( $opt_val )
							);
						}
					}
					else {
						printf(
							'<input id="%s" class="checkbox" type="checkbox" value="1" name="%s" %s>
							<label for="%s">%s</label>',
							$this->get_field_id($k),
							$this->get_field_name($k),
							checked($value, true, false),
							$this->get_field_id($k),
							esc_attr( $v['label'] )
						);
					}
				break;

				case 'category':
					wp_dropdown_categories(array(
						'taxonomy'		  => $v['taxonomy'],
						'hide_empty'      => 0,
						'name'            => $this->get_field_name($k),
						'id'              => $this->get_field_id($k),
						'class'           => 'widefat',
						'hierarchical'    => 1,
						'show_option_all' => esc_html__('All Categories', 'builtpress'),
						'selected'        => esc_attr( $value ),
					));
				break;

			}
			
			echo '</p>';
		}
    }

}
<?php

class BuiltPress_Services_Widget extends BuiltPress_Widget {

	function __construct()
	{
		$this->widget = array(
			'id_base'     => 'st-services-wgt',
			'name'        => esc_html__('Service List', 'builtpress'),
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
		
		$fields['category'] = array(
			'type'		=> 'category',
			'taxonomy'	=> 'st_service_cat',
			'label'		=> esc_html__('Categories', 'builtpress'),
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
		
		if ( !empty($category) ) {
			$args = array(
				'post_type' => 'st_service',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'posts_per_page' => '-1',
				'tax_query' => array(
					array(
						'taxonomy' => 'st_service_cat',
						'field' => 'id',
						'terms' => intval( $category )
					)
				)
			);
			
			$loop = new WP_Query($args);
		}
		else {
			$loop = new WP_Query('post_type=st_service&orderby=menu_order&order=ASC&posts_per_page=-1');
		}
		
		if ($loop->have_posts()) :		
		?>
		<ul>
			<?php
			while ($loop->have_posts()) : $loop->the_post();
			
				$service_icon = get_post_meta(get_the_ID(), '_st_service_icon', TRUE);
				$service_icon_image = get_post_meta(get_the_ID(), '_st_service_icon_image', TRUE);
				?>
				<li>
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
					<?php
					if ( !empty($service_icon_image) ) {
						echo '<span class="service-image">'. wp_get_attachment_image($service_icon_image, 'thumbnail') .'</span>';
					} elseif ( !empty($service_icon) ) {
						echo '<span class="service-icon"><i class="'. esc_attr( $service_icon ) .'"></i></span>';
					}
					?>
					<?php the_title(); ?>
					</a>
				</li>
				<?php
			endwhile;
			?>
		</ul>
		<?php		
		wp_reset_postdata();
		endif;
		
		echo $after_widget;
	}
	
}

function builtpress_services_widget()
{
	register_widget('BuiltPress_Services_Widget');
}
add_action('widgets_init', 'builtpress_services_widget');
<?php

class BuiltPress_Posts_Widget extends BuiltPress_Widget {

	function __construct()
	{
		$this->widget = array(
			'id_base'     => 'st-blog-wgt',
			'name'        => esc_html__('Latest Posts', 'builtpress'),
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
			'taxonomy'	=> 'category',
			'label'		=> esc_html__('Categories', 'builtpress'),
		);
		
		$fields['count'] = array(
			'type'		=> 'text',
			'std'		=> '5',
			'label'		=> esc_html__('Number to display', 'builtpress'),
			'attributes'=> 'style="width:50px;"',
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
			$loop = new WP_Query('cat='.intval( $category ).'&posts_per_page='.intval( $count ));
		}
		else {
			$loop = new WP_Query('posts_per_page='.intval( $count ));
		}
		
		if ($loop->have_posts()) :		
		?>
		<ul class="media-list">
			<?php
			while ($loop->have_posts()) : $loop->the_post();
				?>
				<li class="media">
					<?php
					if ( has_post_thumbnail() ) {
						?>
						<div class="pull-left">
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail('thumbnail'); ?>
							</a>
						</div>
						<?php
					}
					?>
					<div class="media-body">
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						<span><?php the_time('M j, Y'); ?></span>
					</div>
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

function builtpress_posts_widget()
{
	register_widget('BuiltPress_Posts_Widget');
}
add_action('widgets_init', 'builtpress_posts_widget');
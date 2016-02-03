<?php

/*******************************************************************
Visual Composer
********************************************************************/
//vc_remove_element('vc_widget_sidebar');
vc_remove_element('vc_wp_search');
vc_remove_element('vc_wp_meta');
vc_remove_element('vc_wp_recentcomments');
vc_remove_element('vc_wp_calendar');
vc_remove_element('vc_wp_pages');
vc_remove_element('vc_wp_tagcloud');
vc_remove_element('vc_wp_custommenu');
vc_remove_element('vc_wp_text');
vc_remove_element('vc_wp_posts');
vc_remove_element('vc_wp_links');
vc_remove_element('vc_wp_categories');
vc_remove_element('vc_wp_archives');
vc_remove_element('vc_wp_rss');
vc_remove_element('vc_facebook');
vc_remove_element('vc_tweetmeme');
vc_remove_element('vc_googleplus');
vc_remove_element('vc_pinterest');
vc_remove_element('vc_button');
vc_remove_element('vc_button2');
vc_remove_element('vc_cta_button');
vc_remove_element('vc_cta_button2');
//vc_remove_element('vc_message');
//vc_remove_element('vc_toggle');
vc_remove_element('vc_tour');
vc_remove_element('vc_tabs');
vc_remove_element('vc_accordion');
//vc_remove_element('vc_progress_bar');
//vc_remove_element('vc_pie');
vc_remove_element('vc_gallery');
vc_remove_element('vc_carousel');
//vc_remove_element('vc_images_carousel');
vc_remove_element('vc_posts_slider');
//vc_remove_element('vc_gmaps');
//vc_remove_element('vc_video');

if ( function_exists('vc_remove_param') ) {
	vc_remove_param('vc_row', 'full_width');
}

if ( function_exists('vc_set_as_theme') ) {
	vc_set_as_theme(true);
}

if ( function_exists('vc_disable_frontend') ) {
	vc_disable_frontend();
}

if ( function_exists('vc_set_default_editor_post_types') ) {
	vc_set_default_editor_post_types( array('page', 'st_portfolio', 'st_service') );
}


/*-----------------------------------------------------------------------------------*/
/*	Shortcodes Extension
/*-----------------------------------------------------------------------------------*/
$css_animate = array(
	'None' => '',
	'Fade In'			=> 'fadeIn',
	'Zoom In'			=> 'zoomIn',
	'Fade In Left'		=> 'fadeInLeft',
	'Fade In Left Big'	=> 'fadeInLeftBig',
	'Fade In Right'		=> 'fadeInRight',
	'Fade In Right Big'	=> 'fadeInRightBig',
	'Fade In Up'		=> 'fadeInUp',
	'Fade In Up Big'	=> 'fadeInUpBig',
	'Fade In Down'		=> 'fadeInDown',
	'Fade In Down Big'	=> 'fadeInDownBig'
);

if ( !function_exists('builtpress_vc_taxonomy') ) {
	function builtpress_vc_taxonomy($taxonomy)
	{		
		global $wpdb;
		/*$sql = "SELECT DISTINCT t.term_id, t.name, t.slug 
				FROM		".$wpdb->prefix."terms t 
				INNER JOIN 	".$wpdb->prefix."term_taxonomy tax 
				ON 			tax.term_id = t.term_id
				WHERE 		( tax.taxonomy = '". $taxonomy ."' AND tax.count > 0 )
				ORDER BY	t.name ASC";
		$categories = $wpdb->get_results($sql , OBJECT);*/
		$categories = get_terms($taxonomy);
		
		$data	 = array();
		$data['All Categories'] = '';
		
		if ( is_array($categories) ) {
			foreach ( $categories as $cat ) {
				$data[$cat->name] = $cat->term_id;
			}
		}
		
		return $data;
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Row
/*-----------------------------------------------------------------------------------*/
vc_add_param('vc_row', array(
	'type' => 'colorpicker',
	'class' => '',
	'heading' => esc_html__('Font Color', 'builtpress'),
	'param_name' => 'st_font_color',
	'value' => '',
	'description' => ''
));

vc_add_param('vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => esc_html__('Remove Auto Padding Top', 'builtpress'),
	'param_name' => 'st_remove_padding',
	'value' => array(
		'No' => 'no',
		'Yes' => 'yes'
	),
	'description' => esc_html__('Remove auto padding top for first row only', 'builtpress')
));

vc_add_param('vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => esc_html__('Full Width Container', 'builtpress'),
	'param_name' => 'st_full_width',
	'value' => array(
		'No' => '',
		'Yes (In Grid)' => 1,
		'Yes (Full 100%)' => 2
	),
	'description' => ''
));

vc_add_param('vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => esc_html__('Video Background', 'builtpress'),
	'param_name' => 'st_video_bg',
	'value' => array(
		'No' => 'no',
		'Yes' => 'yes'
	),
	'description' => ''
));

vc_add_param('vc_row', array(
	'type' => 'colorpicker',
	'class' => '',
	'heading' => esc_html__('Video Background Overlay', 'builtpress'),
	'param_name' => 'st_video_overlay',
	'value' => '',
	'description' => '',
	'dependency' => array('element' => 'st_video_bg', 'value' => array('yes'))
));

vc_add_param('vc_row', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => esc_html__('Video mp4 URL', 'builtpress'),
	'param_name' => 'st_video_mp4',
	'value' => '',
	'description' => '',
	'dependency' => array('element' => 'st_video_bg', 'value' => array('yes'))
));

vc_add_param('vc_row', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => esc_html__('Video webm URL', 'builtpress'),
	'param_name' => 'st_video_webm',
	'value' => '',
	'description' => '',
	'dependency' => array('element' => 'st_video_bg', 'value' => array('yes'))
));

vc_add_param('vc_row', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => esc_html__('Video ogg URL', 'builtpress'),
	'param_name' => 'st_video_ogg',
	'value' => '',
	'description' => '',
	'dependency' => array('element' => 'st_video_bg', 'value' => array('yes'))
));

vc_add_param('vc_column', array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => esc_html__('CSS Animation', 'builtpress'),
	'param_name' => 'st_animate',
	'value' => $css_animate,
	'description' => ''
));


/*-----------------------------------------------------------------------------------*/
/*	Heading Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Heading', 'builtpress'),
	'base' => 'st_heading',
	'icon' => 'st-icon-heading',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Align', 'builtpress'),
			'param_name' => 'align',
			'value' => array(
				'Left' => 'left',
				'Center' => 'center',
				'Right' => 'right'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Title', 'builtpress'),
			'param_name' => 'title',
			'value' => 'Heading Title',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textarea',
			'class' => '',
			'heading' => esc_html__('Description', 'builtpress'),
			'param_name' => 'content',
			'value' => '',
			'description' => ''
		),
	)
) );
class WPBakeryShortCode_st_heading extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Button', 'builtpress'),
	'base' => 'st_button',
	'icon' => 'st-icon-button',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Style', 'builtpress'),
			'param_name' => 'style',
			'value' => array(
				'Solid' => '1',
				'Transparent' => '2'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Size', 'builtpress'),
			'param_name' => 'size',
			'value' => array(
				'Small' => 'small',
				'Medium' => 'medium',
				'Large' => 'large'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'iconpicker',
			'class' => '',
			'heading' => esc_html__('Icon Font', 'builtpress'),
			'param_name' => 'icon',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),	
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Link Label', 'builtpress'),
			'param_name' => 'link_label',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'vc_link',
			'class' => '',
			'heading' => esc_html__('Link URL', 'builtpress'),
			'param_name' => 'link_url',
			'value' => '',
			'description' => ''
		),
	)
) );
class WPBakeryShortCode_st_button extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Icon Box Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Icon Box', 'builtpress'),
	'base' => 'st_icon_box',
	'icon' => 'st-icon-iconbox',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Style', 'builtpress'),
			'param_name' => 'style',
			'value' => array(
				'Style 1' => '1',
				'Style 2' => '2',
				'Style 3' => '3'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Icon Position', 'builtpress'),
			'param_name' => 'icon_position',
			'value' => array(
				'Left' => 'left',
				'Right' => 'right'
			),
			'std' => 'left',
			'description' => '',
			'dependency' => array('element' => 'style', 'value' => array('2')),
			'admin_label' => true
		),
		/* start icon */
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Icon library', 'builtpress'),
			'value' => array(
				esc_html__('Font Awesome', 'builtpress') => 'fontawesome',
				esc_html__('Open Iconic', 'builtpress') => 'openiconic',
				esc_html__('Typicons', 'builtpress') => 'typicons',
				esc_html__('Entypo', 'builtpress') => 'entypo',
				esc_html__('Linecons', 'builtpress') => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__('Select icon library.', 'builtpress'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'builtpress'),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false,
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__('Select icon from library.', 'builtpress'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'builtpress'),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'openiconic',
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'openiconic',
			),
			'description' => esc_html__('Select icon from library.', 'builtpress'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'builtpress'),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'typicons',
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'typicons',
			),
			'description' => esc_html__('Select icon from library.', 'builtpress'),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'builtpress'),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'entypo',
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'entypo',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__('Icon', 'builtpress'),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false,
				'type' => 'linecons',
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'linecons',
			),
			'description' => esc_html__('Select icon from library.', 'builtpress'),
		),
		/* end icon */
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Title', 'builtpress'),
			'param_name' => 'title',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textarea',
			'class' => '',
			'heading' => esc_html__('Content', 'builtpress'),
			'param_name' => 'content',
			'value' => 'Content',
			'description' => ''
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Link Label', 'builtpress'),
			'param_name' => 'link_label',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'vc_link',
			'class' => '',
			'heading' => esc_html__('Link URL', 'builtpress'),
			'param_name' => 'link_url',
			'value' => '',
			'description' => ''
		),
		array(
			'type' => 'colorpicker',
			'class' => '',
			'heading' => esc_html__('Hover Color', 'builtpress'),
			'param_name' => 'color_hover',
			'value' => '',
			'description' => '',
			'dependency' => array('element' => 'style', 'value' => array('3'))
		),
		array(
			'type' => 'colorpicker',
			'class' => '',
			'heading' => esc_html__('Hover Background Color', 'builtpress'),
			'param_name' => 'bg_color_hover',
			'value' => '',
			'description' => '',
			'dependency' => array('element' => 'style', 'value' => array('3'))
		),
	)
) );
class WPBakeryShortCode_st_icon_box extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Meta Box Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Meta Box', 'builtpress'),
	'base' => 'st_meta_box',
	'icon' => 'st-icon-metabox',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Meta Field', 'builtpress' ),
			'param_name' => 'values',
			'description' => '',
			'value' => urlencode( json_encode( array(
				array(
					'label' => esc_html__('Label 1', 'builtpress'),
					'value' => 'Value 1',
				),
				array(
					'label' => esc_html__('Label 2', 'builtpress'),
					'value' => 'Value 2',
				),
			) ) ),
			'params' => array(	
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Label', 'builtpress'),
					'param_name' => 'label',
					'description' => '',
					'admin_label' => true
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Value', 'builtpress'),
					'param_name' => 'value',
					'description' => '',
					'admin_label' => true
				),
			),
		),
	),
	'js_view' => 'VcColumnView'
) );
class WPBakeryShortCode_st_meta_box extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Promo Box Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Promo Box', 'builtpress'),
	'base' => 'st_promo_box',
	'icon' => 'st-icon-promobox',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'attach_image',
			'class' => '',
			'heading' => esc_html__('Image', 'builtpress'),
			'param_name' => 'image',
			'value' => '',
			'description' => ''
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Title', 'builtpress'),
			'param_name' => 'title',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Sub Title', 'builtpress'),
			'param_name' => 'sub_title',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'vc_link',
			'class' => '',
			'heading' => esc_html__('Link URL', 'builtpress'),
			'param_name' => 'link_url',
			'value' => '',
			'description' => ''
		),
	)
) );
class WPBakeryShortCode_st_promo_box extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Pricing Box Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Pricing Box', 'builtpress'),
	'base' => 'st_pricing_box',
	'icon' => 'st-icon-pricingbox',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Featured', 'builtpress'),
			'param_name' => 'featured',
			'value' => array(
				'No' => 'no',
				'Yes' => 'yes'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Title', 'builtpress'),
			'param_name' => 'title',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Price', 'builtpress'),
			'param_name' => 'price',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Currency', 'builtpress'),
			'param_name' => 'currency',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Note', 'builtpress'),
			'param_name' => 'note',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textarea',
			'class' => '',
			'heading' => esc_html__('Content', 'builtpress'),
			'param_name' => 'content',
			'value' => '',
			'description' => ''
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Link Label', 'builtpress'),
			'param_name' => 'link_label',
			'value' => '',
			'description' => ''
		),
		array(
			'type' => 'vc_link',
			'class' => '',
			'heading' => esc_html__('Link URL', 'builtpress'),
			'param_name' => 'link_url',
			'value' => '',
			'description' => ''
		),
	)
) );
class WPBakeryShortCode_st_pricing_box extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Counter Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Counter', 'builtpress'),
	'base' => 'st_counter',
	'icon' => 'st-icon-counter',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Style', 'builtpress'),
			'param_name' => 'style',
			'value' => array(
				'Default' => 'default',
				'With Icon' => 'icon'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Icon Position', 'builtpress'),
			'param_name' => 'icon_position',
			'value' => array(
				'Top' => 'top',
				'Left' => 'left'
			),
			'description' => '',
			'dependency' => array('element' => 'style', 'value' => array('icon')),
			'admin_label' => true
		),
		array(
			'type' => 'iconpicker',
			'class' => '',
			'heading' => esc_html__('Icon Font', 'builtpress'),
			'param_name' => 'icon',
			'value' => '',
			'description' => '',
			'dependency' => array('element' => 'style', 'value' => array('icon')),
			'admin_label' => true
		),
		array(
			'type' => 'colorpicker',
			'class' => '',
			'heading' => esc_html__('Color', 'builtpress'),
			'param_name' => 'color',
			'value' => '',
			'description' => ''
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Number', 'builtpress'),
			'param_name' => 'number',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Title', 'builtpress'),
			'param_name' => 'title',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
	)
) );
class WPBakeryShortCode_st_counter extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Countdown Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Countdown', 'builtpress'),
	'base' => 'st_countdown',
	'icon' => 'st-icon-countdown',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Launch Date', 'builtpress'),
			'param_name' => 'date',
			'value' => '',
			'description' => 'Format: '. date('Y/m/d') .' - YYYY/MM/DD',			
			'admin_label' => true
		),
	)
) );
class WPBakeryShortCode_st_countdown extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Blog Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Blogs', 'builtpress'),
	'base' => 'st_blog',
	'icon' => 'st-icon-blog',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Columns', 'builtpress'),
			'param_name' => 'columns',
			'value' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4),
			'std' => '4',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Category', 'builtpress'),
			'param_name' => 'category',
			'value' => builtpress_vc_taxonomy('category'),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Number to display', 'builtpress'),
			'param_name' => 'number',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
	)
) );
class WPBakeryShortCode_st_blog extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Portfolios Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Portfolios', 'builtpress'),
	'base' => 'st_portfolios',
	'icon' => 'st-icon-portfolios',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Style', 'builtpress'),
			'param_name' => 'style',
			'value' => array(
				'Modern' => '1',
				'Classic' => '2'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Columns', 'builtpress'),
			'param_name' => 'columns',
			'value' => array(2 => 2, 3 => 3, 4 => 4),
			'std' => '3',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Category', 'builtpress'),
			'param_name' => 'category',
			'value' => builtpress_vc_taxonomy('st_portfolio_cat'),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Number to display', 'builtpress'),
			'param_name' => 'number',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Remove Space', 'builtpress'),
			'param_name' => 'nospace',
			'value' => array(
				'No' => 'no',
				'Yes' => 'yes'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Show Filter', 'builtpress'),
			'param_name' => 'filter',
			'value' => array(
				'No' => 'no',
				'Yes' => 'yes'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Show Load More', 'builtpress'),
			'param_name' => 'load_more',
			'value' => array(
				'No' => 'no',
				'Yes' => 'yes'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Link Label', 'builtpress'),
			'param_name' => 'link_label',
			'value' => '',
			'description' => '',
			'dependency' => array('element' => 'style', 'value' => array('1')),
			'admin_label' => true
		),
	)
) );
class WPBakeryShortCode_st_portfolios extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Services Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Services', 'builtpress'),
	'base' => 'st_services',
	'icon' => 'st-icon-services',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Style', 'builtpress'),
			'param_name' => 'style',
			'value' => array(
				'Icon' => '1',
				'Classic' => '2'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Columns', 'builtpress'),
			'param_name' => 'columns',
			'value' => array(2 => 2, 3 => 3, 4 => 4),
			'std' => '3',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Category', 'builtpress'),
			'param_name' => 'category',
			'value' => builtpress_vc_taxonomy('st_service_cat'),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Number to display', 'builtpress'),
			'param_name' => 'number',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Show Filter', 'builtpress'),
			'param_name' => 'filter',
			'value' => array(
				'No' => 'no',
				'Yes' => 'yes'
			),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Link Label', 'builtpress'),
			'param_name' => 'link_label',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
	)
) );
class WPBakeryShortCode_st_services extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Teams Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Teams', 'builtpress'),
	'base' => 'st_teams',
	'icon' => 'st-icon-teams',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Columns', 'builtpress'),
			'param_name' => 'columns',
			'value' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4),
			'std' => '3',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Category', 'builtpress'),
			'param_name' => 'category',
			'value' => builtpress_vc_taxonomy('st_team_cat'),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Number to display', 'builtpress'),
			'param_name' => 'number',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('CSS Animation', 'builtpress'),
			'param_name' => 'animate',
			'value' => $css_animate,
			'description' => ''
		),
	)
) );
class WPBakeryShortCode_st_teams extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Testimonials', 'builtpress'),
	'base' => 'st_testimonials',
	'icon' => 'st-icon-testimonials',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Columns', 'builtpress'),
			'param_name' => 'columns',
			'value' => array(1 => 1, 2 => 2),
			'std' => '2',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Category', 'builtpress'),
			'param_name' => 'category',
			'value' => builtpress_vc_taxonomy('st_testimonial_cat'),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Number to display', 'builtpress'),
			'param_name' => 'number',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('CSS Animation', 'builtpress'),
			'param_name' => 'animate',
			'value' => $css_animate,
			'description' => ''
		),
	)
) );
class WPBakeryShortCode_st_testimonials extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Slider Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Testimonials Slider', 'builtpress'),
	'base' => 'st_testimonials_slider',
	'icon' => 'st-icon-testimonialsslider',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Category', 'builtpress'),
			'param_name' => 'category',
			'value' => builtpress_vc_taxonomy('st_testimonial_cat'),
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Number to display', 'builtpress'),
			'param_name' => 'number',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
	)
) );
class WPBakeryShortCode_st_testimonials_slider extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Clients Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Clients', 'builtpress'),
	'base' => 'st_clients',
	'icon' => 'st-icon-clients',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('Columns', 'builtpress'),
			'param_name' => 'columns',
			'value' => array(2 => 2, 3 => 3, 4 => 4),
			'std' => '4',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Number to display', 'builtpress'),
			'param_name' => 'number',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => esc_html__('CSS Animation', 'builtpress'),
			'param_name' => 'animate',
			'value' => $css_animate,
			'description' => ''
		),
	)
) );
class WPBakeryShortCode_st_clients extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	Clients Slider Config
/*-----------------------------------------------------------------------------------*/
vc_map( array(
	'name' => esc_html__('Clients Slider', 'builtpress'),
	'base' => 'st_clients_slider',
	'icon' => 'st-icon-clientsslider',
	'class' => '',
	'category' => 'SliceTheme',
	'params' => array(
		array(
			'type' => 'textfield',
			'class' => '',
			'heading' => esc_html__('Number to display', 'builtpress'),
			'param_name' => 'number',
			'value' => '',
			'description' => '',
			'admin_label' => true
		),
	)
) );
class WPBakeryShortCode_st_clients_slider extends WPBakeryShortCode {}
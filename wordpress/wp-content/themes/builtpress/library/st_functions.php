<?php

if ( !isset($content_width) ) {
	$content_width = 1140;
}

if ( !function_exists('builtpress_setup') ) {
	function builtpress_setup()
	{
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array( 'gallery', 'quote', 'video', 'audio' ) );
		add_theme_support( 'woocommerce' );
		add_editor_style();
		
		add_image_size( 'builtpress-small', 600, 400, true );
		add_image_size( 'builtpress-large', 1200, 600, true );
		add_image_size( 'builtpress-portfolio', 600, 400, true );
		add_image_size( 'builtpress-service', 600, 400, true );
		add_image_size( 'builtpress-team', 550, 750, true );
		add_image_size( 'builtpress-testimonial', 150, 150, true );
		add_image_size( 'builtpress-client', 300, 200, true );
		
		register_nav_menus(
			array(
				'primary' => esc_html__('Primary Menu', 'builtpress'),
				'footer' => esc_html__('Footer Menu', 'builtpress')
			)
		);
		
		load_theme_textdomain('builtpress', get_template_directory() . '/languages');
		
		add_filter('widget_text', 'do_shortcode');		
		add_filter('use_default_gallery_style', '__return_false');
	}
}
add_action('after_setup_theme', 'builtpress_setup');


/*******************************************************************
Register Sidebar
********************************************************************/
if ( function_exists('register_sidebar') )
{
	$sidebar_1 = array(
					'sidebar'			=> esc_html__('Sidebar', 'builtpress'),
					'page_sidebar'		=> esc_html__('Page Sidebar', 'builtpress'),
					'shop_sidebar'		=> esc_html__('Shop Sidebar', 'builtpress'),
					'footer_column_1'	=> esc_html__('Footer Column 1', 'builtpress'),
					'footer_column_2'	=> esc_html__('Footer Column 2', 'builtpress'),
					'footer_column_3'	=> esc_html__('Footer Column 3', 'builtpress'),
					'footer_column_4'	=> esc_html__('Footer Column 4', 'builtpress')
					);
	
	foreach ($sidebar_1 as $sidebar_id => $sidebar_name)
	{		
		register_sidebar(array(
		'name' => $sidebar_name,
		'id' => $sidebar_id,
		'before_widget' => '<section id="%1$s" class="widget %2$s">', 
		'after_widget' => '</section>', 
		'before_title' => '<h3 class="widget-title"><span>', 
		'after_title' => '</span></h3>', 
		));
	}
	
	$get_sidebar_opt = get_option('theme_st_options');
	if ( isset($get_sidebar_opt['sidebar_widget']) && is_array($get_sidebar_opt['sidebar_widget']) )
	{
		$sidebars = array_filter($get_sidebar_opt['sidebar_widget'], 'strlen');
		if ( is_array($sidebars) )
		{
			foreach ($sidebars as $sidebar)
			{
				$sidebar_id = preg_replace('/[^a-zA-Z0-9\s]+/', '', $sidebar);
				$sidebar_id = preg_replace('/\s+/', '_', $sidebar_id);
				$sidebar_id = strtolower($sidebar_id);
				
				register_sidebar(array(
				'name' => esc_attr( $sidebar ),
				'id' => 'st_'.$sidebar_id,
				'before_widget' => '<section id="%1$s" class="widget %2$s">', 
				'after_widget' => '</section>', 
				'before_title' => '<h3 class="widget-title"><span>', 
				'after_title' => '</span></h3>', 
				));
			}
		}
	}
}


/*******************************************************************
Get Theme Options
********************************************************************/
function builtpress_opt($key, $default = '')
{
	global $get_theme_opt;
	
	if ( isset($get_theme_opt[$key]) && !empty($get_theme_opt[$key]) ) {		
		$option = stripslashes_deep($get_theme_opt[$key]);
	}
	else {
		$option = $default;
	}
	
	// Demo Header Style
	if ( $key == 'header_style' ) {
		if ( $_GET && array_key_exists('header-style', $_GET) ) {
			if ( in_array($_GET['header-style'], array('v1','v2','v3')) ) {
				$option = $_GET['header-style'];
			}
		}
	}
	
	return $option;
}

function builtpress_opt_page($key, $default = '')
{	
	if ( is_page() || is_singular( array('st_portfolio', 'st_service', 'st_team') ) ) {
		$page_opt = get_post_meta(get_the_ID(), '_st_general_'.$key, TRUE);
	}
	elseif ( class_exists('Woocommerce') && is_woocommerce() ) {
		$page_opt = get_post_meta(get_option('woocommerce_shop_page_id'), '_st_general_'.$key, TRUE);
	}
	
	$option = '';
	if ( isset($page_opt) && $page_opt <> '' ) {
		$option = $page_opt;
	}
	else {
		$option = builtpress_opt($key, $default);
	}
	
	// Demo Header Skins
	if ( $key == 'header_transparent' ) {
		if ( isset($_GET['header-transparent']) && $_GET['header-transparent'] == 'yes' ) {
			$option = 1;
		}
		elseif ( isset($_GET['header-transparent']) && $_GET['header-transparent'] == 'no' ) {
			$option = 0;
		}
	}
	
	return $option;
}

function builtpress_opts($id, $fallback = false, $key = false, $default = '')
{
	global $get_theme_opt;
	
	if ( $fallback == false ) {
		$fallback = '';
	}	
	$option = ( isset( $get_theme_opt[$id] ) && $get_theme_opt[$id] !== '' ) ? $get_theme_opt[$id] : $fallback;
	if ( !empty( $get_theme_opt[$id] ) && $key ) {
		$option = $get_theme_opt[$id][$key];
	}	
	if ( empty($option) ) {
		$option = $default;
	}

	return $option;
}


/*******************************************************************
Enqueue CSS + JS
********************************************************************/
if ( !function_exists('builtpress_wp_enqueue') ) {
	function builtpress_wp_enqueue()
	{			
		wp_enqueue_style('builtpress-bootstrap', get_template_directory_uri() .'/assets/css/bootstrap.min.css', array(), NULL);
		wp_enqueue_style('builtpress-font-awesome', get_template_directory_uri() .'/assets/css/font-awesome.min.css', array(), NULL);
		wp_enqueue_style('builtpress-owl.carousel', get_template_directory_uri() .'/assets/css/owl.carousel.css', array(), NULL);
		wp_enqueue_style('builtpress-prettyPhoto', get_template_directory_uri() .'/assets/js/prettyPhoto/prettyPhoto.css', array(), NULL);
		wp_enqueue_style('builtpress-animate', get_template_directory_uri() .'/assets/css/animate.min.css', array(), NULL);
		wp_enqueue_style('builtpress-base', get_template_directory_uri() .'/assets/css/base.css', array(), NULL);
		wp_enqueue_style('builtpress-widgets', get_template_directory_uri() .'/assets/css/widgets.css', array(), NULL);
		wp_enqueue_style('builtpress-shortcodes', get_template_directory_uri() .'/assets/css/shortcodes.css', array(), NULL);
		if ( class_exists('Woocommerce') ) {
			wp_enqueue_style('builtpress-woocommerce', get_template_directory_uri() .'/assets/css/woocommerce.css', array(), NULL);
		}
		wp_enqueue_style('builtpress-layout', get_template_directory_uri() .'/assets/css/layout.css', array(), NULL);
		wp_enqueue_style('builtpress-responsive', get_template_directory_uri() .'/assets/css/responsive.css', array(), NULL);
		wp_enqueue_style('builtpress-style', get_stylesheet_uri());
		
		wp_enqueue_script('builtpress-bootstrap', get_template_directory_uri() .'/assets/js/bootstrap.min.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-fitvids', get_template_directory_uri() .'/assets/js/jquery.fitvids.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-imagesloaded', get_template_directory_uri() .'/assets/js/jquery.imagesloaded.min.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-isotope', get_template_directory_uri() .'/assets/js/jquery.isotope.min.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-owl.carousel', get_template_directory_uri() .'/assets/js/jquery.owl.carousel.min.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-wow', get_template_directory_uri() .'/assets/js/jquery.wow.min.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-waypoints', get_template_directory_uri() .'/assets/js/jquery.waypoints.min.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-countdown', get_template_directory_uri() .'/assets/js/jquery.countdown.min.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-parallax', get_template_directory_uri() .'/assets/js/jquery.parallax.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-mediaelement', get_template_directory_uri() .'/assets/js/mediaelement-and-player.min.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-prettyPhoto', get_template_directory_uri() .'/assets/js/prettyPhoto/jquery.prettyPhoto.js', 'jquery', NULL, TRUE);
		wp_enqueue_script('builtpress-html5', get_template_directory_uri() .'/assets/js/html5.js', array(), NULL);
		wp_script_add_data('builtpress-html5', 'conditional', 'lt IE 9');
		wp_enqueue_script('builtpress-script', get_template_directory_uri() .'/assets/js/scripts.js', 'jquery', NULL, TRUE);
		
		if ( is_singular() && comments_open() && get_option('thread_comments') ) {
			wp_enqueue_script( 'comment-reply' ); 
		}
	}
}
add_action('wp_enqueue_scripts', 'builtpress_wp_enqueue');


/*******************************************************************
Body Class
********************************************************************/
if ( !function_exists('builtpress_wp_body_class') ) {
	function builtpress_wp_body_class($classes)
	{
		$classes[] = 'layout-'. esc_attr( builtpress_opt('site_layout', 'wide') );
		$classes[] = 'header-style-'. esc_attr( builtpress_opt('header_style', 'v1') );
	
		if ( builtpress_opt('header_sticky') ) {
			$classes[] = 'header-sticky';
		}
	
		if ( builtpress_opt('header_style') == 'v1' && builtpress_opt_page('header_transparent') ) {
			$classes[] = 'header-transparent';
		}
		
		if ( builtpress_opt_page('style_bg_title_parallax') ) {
			$classes[] = 'title-parallax';
		}
		
		return $classes;
	}
}
add_filter('body_class', 'builtpress_wp_body_class');


/*******************************************************************
Favicon
********************************************************************/
if ( !function_exists('builtpress_wp_favicon') ) {
	function builtpress_wp_favicon()
	{
		$favicon = builtpress_opts('site_favicon', false, 'url', get_template_directory_uri() .'/assets/images/favicon.ico');
		
		printf(
			'<link rel="shortcut icon" href="%s" />',
			esc_url( $favicon )
			);
	}
}
if ( !function_exists('has_site_icon') || !has_site_icon() ) {
	add_filter('wp_head', 'builtpress_wp_favicon');
}


/*******************************************************************
Footer Code
********************************************************************/
if ( !function_exists('builtpress_wp_footer') ) {
	function builtpress_wp_footer()
	{		
		if ( file_exists(get_template_directory() .'/assets/styleswitcher/index.php') ) {
			require_once get_template_directory() .'/assets/styleswitcher/index.php';
		}
		
		if ( $custom_js = builtpress_opt('custom_js') ) {
			echo htmlspecialchars_decode( esc_textarea( $custom_js ), ENT_QUOTES )."\n";
		}
	}
}
add_action('wp_footer', 'builtpress_wp_footer');


/*******************************************************************
Gallery Links
********************************************************************/
if ( !function_exists('builtpress_wp_gallery') ) {
	function builtpress_wp_gallery($attachment_link)
	{	
		$pattern		= "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
		$replacement	= '<a$1href=$2$3.$4$5 rel="prettyPhoto[gal_sc]"$6>$7</a>';
		$attachment_link= preg_replace($pattern, $replacement, $attachment_link);
		return $attachment_link;
	}
}
add_filter('wp_get_attachment_link', 'builtpress_wp_gallery');


/*******************************************************************
Theme Updater
********************************************************************/
if ( !function_exists('builtpress_updater') ) {
	function builtpress_updater()
	{		
		$envato_username = esc_attr( builtpress_opt('envato_username') );
		$envato_api_key  = esc_attr( builtpress_opt('envato_api') );
		if ( !empty( $envato_username ) && !empty( $envato_api_key ) ) {
			require_once get_template_directory() .'/library/vendor/updater/envato-theme-update.php';

			if ( class_exists( 'Envato_Theme_Updater' ) ) {
				Envato_Theme_Updater::init( $envato_username, $envato_api_key, 'builtpress' );
			}
		}		
	}
}
add_action( 'after_setup_theme', 'builtpress_updater' );


/*******************************************************************
Remove Metabox
********************************************************************/
if ( !function_exists('builtpress_metabox') ) {
	function builtpress_metabox() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach ( array( 'page', 'post', 'st_portfolio', 'st_service', 'st_team', 'st_testimonial', 'st_client' ) as $postType ) {
				remove_meta_box( 'postcustom', $postType, $context );
				remove_meta_box( 'mymetabox_revslider_0', $postType, $context );
				remove_meta_box( 'vc_teaser', $postType, $context );
			}
		}
	}
}
add_action('do_meta_boxes', 'builtpress_metabox');


/*******************************************************************
Remove Version
********************************************************************/
if ( !function_exists('builtpress_remove_version') ) {
	function builtpress_remove_version($src)
	{
		if ( strpos($src, '?rev=') ) {
			$src = remove_query_arg('rev', $src);
		}
		if ( strpos($src, 'ver=') ) {
			$src = remove_query_arg('ver', $src);
		}
		return $src;
	}
}
add_filter('script_loader_src', 'builtpress_remove_version');
add_filter('style_loader_src', 'builtpress_remove_version');


/*******************************************************************
Array Data
********************************************************************/
if ( !function_exists('builtpress_get_socials') ) {
	function builtpress_get_socials()
	{
		$icons = array(
			'facebook'	=> array('facebook',	'Facebook'),
			'google'	=> array('google-plus',	'Google+'),
			'twitter'	=> array('twitter',		'Twitter'),
			'linkedin'	=> array('linkedin',	'LinkedIn'),
			'dribbble'	=> array('dribbble',	'Dribbble'),
			'instagram'	=> array('instagram',	'Instagram'),
			'pinterest'	=> array('pinterest',	'Pinterest'),
			'foursquare'=> array('foursquare',	'Foursquare'),
			'tumblr'	=> array('tumblr',		'Tumblr'),
			'youtube'	=> array('youtube',		'Youtube'),
			'vimeo'		=> array('vimeo-square','Vimeo'),
			'flickr'	=> array('flickr',		'Flickr'),
			'rss'		=> array('rss',			'RSS')
			);
		return $icons;
	}
}


/*******************************************************************
Breadcrumb
********************************************************************/
if ( !function_exists('builtpress_breadcrumb') ) {
	function builtpress_breadcrumb()
	{
		global $post;
		
		$currentBefore = '<li class="active">';
		$currentAfter = '</li>';
		
		if ( !is_front_page() || is_paged() ) {
			
			echo '<ol class="breadcrumb">';
			
			echo '<li><a href="'. esc_url( home_url('/') ) .'">'. esc_html__('Home', 'builtpress') .'</a></li>';
			
			if ( is_home() ) {
				echo '<li>'. get_the_title( get_option('page_for_posts') ) .'</li>';
			}
			elseif ( is_tax() ) {
				  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				  echo '<li class="active">' . $term->name . '</li>';	
			}
			elseif ( is_category() ) {
				global $wp_query;
				$cat_obj	= $wp_query->get_queried_object();
				$thisCat	= $cat_obj->term_id;
				$thisCat	= get_category($thisCat);
				$parentCat	= get_category($thisCat->parent);
				if ( $thisCat->parent != 0 ) {
					echo '<li>'. get_category_parents($parentCat, TRUE, '</li><li>') .'</li>';
				}
				echo '<li class="active">' . single_cat_title('', false) . '</li>';
			}
			elseif ( is_tag() ) {
				echo '<li class="active">' . single_tag_title('', false) . '</li>';
			}
			elseif ( is_author() ) {
				echo '<li class="active">' . get_the_author() . '</li>';
			}
			elseif ( is_year() ) {
				echo '<li class="active">' . get_the_time('Y') . '</li>';
			}
			elseif ( is_month() ) {
				echo '<li><a href="'. get_year_link(get_the_time('Y')) .'">' . get_the_time('Y') . '</a></li>';
				echo '<li class="active">' . get_the_time('F') . '</li>';		
			}
			elseif ( is_day() ) {
				echo '<li><a href="'. get_year_link(get_the_time('Y')) .'">' . get_the_time('Y') . '</a></li>';
				echo '<li><a href="'. get_month_link(get_the_time('Y'),get_the_time('m')) .'">' . get_the_time('F') . '</a></li>';
				echo '<li class="active">' . get_the_time('d') . '</li>';	
			}
			elseif ( is_search() ) {
				echo '<li class="active">' . esc_html__('Search:', 'builtpress'). ' &quot;' . get_search_query() . '&quot;' . '</li>';	
			}
			elseif ( is_page() ) {
				if ( !$post->post_parent ) {
					$parent_id		= $post->post_parent;
					$breadcrumbs	= array();
					while ( $parent_id ) {
						$page			= get_page($parent_id);
						$breadcrumbs[]	= '<a href="'. get_permalink($page->ID) .'">' . get_the_title($page->ID) . '</a>';
						$parent_id		= $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ( $breadcrumbs as $breadcrumb ) {
						echo '<li>'. $breadcrumb .'</li>';
					}
				}
				echo '<li class="active">' . get_the_title() . '</li>';
			}
			elseif ( is_single() ) {
				$postType = get_post_type();
				if ( $postType == 'post' ) {
					$cat	= get_the_category();
					$cat	= $cat[0];
					$terms = '<li>'. get_category_parents($cat, TRUE, '</li><li>') .'</li>';
					echo str_replace('<li></li>', '', $terms);
				}
				elseif( $postType == 'st_portfolio' )
				{
					if ( $page_portfolio = builtpress_opt('page_portfolio') ) {
						echo '<li><a href="'. get_permalink( intval( $page_portfolio ) ) .'">'. get_the_title( intval( $page_portfolio ) ) .'</a></li>';
					}
				}
				elseif( $postType == 'st_service' )
				{
					if ( $page_service = builtpress_opt('page_service') ) {
						echo '<li><a href="'. get_permalink( intval( $page_service ) ) .'">'. get_the_title( intval( $page_service ) ) .'</a></li>';
					}
				}
				elseif( $postType == 'st_team' )
				{
					if ( $page_team = builtpress_opt('page_team') ) {
						echo '<li><a href="'. get_permalink( intval( $page_team ) ) .'">'. get_the_title( intval( $page_team ) ) .'</a></li>';
					}
				}
				echo '<li class="active">' . get_the_title() . '</li>';
			}
			elseif ( is_404() ) {
				echo '<li class="active">' . esc_html__('Page Not Found', 'builtpress') . '</li>';		
			}
		
			echo '</ol>';
		}
	}
}


/*******************************************************************
Post Excerpt
********************************************************************/
if ( !function_exists('builtpress_excerpt') ) {
	function builtpress_excerpt($length = 35, $echo = TRUE)
	{	
		global $post;
		
		$the_excerpt = strip_shortcodes( $post->post_content );
		$the_excerpt = str_replace(']]>', ']]&gt;', $the_excerpt);
		$the_excerpt = strip_tags($the_excerpt);
		$words = preg_split("/[\n\r\t ]+/", $the_excerpt, $length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count($words) > $length ) {
			array_pop($words);
			$the_excerpt = implode(' ', $words);
			$the_excerpt = $the_excerpt . ' ...';
		} else {
			$the_excerpt = implode(' ', $words);
		}
		
		$the_excerpt = wpautop($the_excerpt);
		
		if ( $echo ) {
			echo esc_html( $the_excerpt );
		} else {	
			return esc_html( $the_excerpt );
		}
	}
}


/*******************************************************************
Isotope Filter
********************************************************************/
if ( !function_exists('builtpress_filters') ) {
	function builtpress_filters($taxonomy, $get_category)
	{
		$out = '<div class="load-filter">';
			$out.= '<ul id="load-filter" class="list-unstyled">';
				$out.= '<li class="active"><a href="#" data-filter="*">'. esc_html__('All', 'builtpress') .'</a></li>';
				$categories = get_categories('taxonomy='.$taxonomy);
				foreach ( $categories as $category ) {
					if ( is_array($get_category) ) {
						$out.= '<li><a href="#" data-filter=".'. $category->slug .'">'. $category->cat_name .'</a></li>';
					}
					else {
						$out.= '<li><a href="#" data-filter=".'. $category->slug .'">'. $category->cat_name .'</a></li>';
					}
				}
			$out.= '</ul>';
		$out.= '</div>';
		
		return $out;
	}
}


/*******************************************************************
Team Contact
********************************************************************/
if ( !function_exists('builtpress_team_contact') ) {
	function builtpress_team_contact()
	{		
		$team_contact = array();
		$team_contact['phone'] = get_post_meta(get_the_ID(), '_st_team_phone', TRUE);
		$team_contact['fax'] = get_post_meta(get_the_ID(), '_st_team_fax', TRUE);
		$team_contact['email'] = get_post_meta(get_the_ID(), '_st_team_email', TRUE);
		
		$out = '<div class="team-contact">';
			$out.= '<ul class="list-unstyled">';
			if ( !empty($team_contact['phone']) ) {
				$out.= '<li><span><i class="fa fa-phone"></i> '. esc_attr( $team_contact['phone'] ) .'</span></li>';
			}
			if ( !empty($team_contact['fax']) ) {
				$out.= '<li><span><i class="fa fa-print"></i> '. esc_attr( $team_contact['fax'] ) .'</span></li>';
			}
			if ( !empty($team_contact['email']) ) {
				$out.= '<li><span><i class="fa fa-envelope-o"></i> <a href="mailto:'. esc_attr( $team_contact['email'] ) .'" target="_blank">'. esc_attr( $team_contact['email'] ) .'</a></span></li>';
			}
			$out.= '</ul>';
		$out.= '</div>';
			
		return $out;
	}
}


/*******************************************************************
Team Social
********************************************************************/
if ( !function_exists('builtpress_team_socials') ) {
	function builtpress_team_socials()
	{	
		$getSocial = builtpress_get_socials();
		unset($getSocial['rss']);
		
		$team_socials = get_post_meta(get_the_ID(), '_st_team_social', TRUE);
		
		$out = '';
		if ( is_array($team_socials) && count($team_socials) > 0 ) {
			$out.= '<div class="st-social">';
			$out.= '<ul class="list-inline">';
				foreach ( $getSocial as $k => $v ) {					
					if ( !empty($team_socials[$k]) ) {
						$out.= sprintf(
									'<li><a class="fa fa-%s" href="%s" title="%s" target="_blank"></a></li>',
									esc_attr( $v[0] ),
									esc_url( $team_socials[$k] ),
									esc_attr( $v[1] )
									);
					}
				}
			$out.= '</ul>';
			$out.= '</div>';
		}
		return $out;
	}
}


/*******************************************************************
Thumbnail Images
********************************************************************/
if ( !function_exists('builtpress_thumbnail') ) {
	function builtpress_thumbnail($size = 'full')
	{
		if ( has_post_thumbnail() ) {
			$out = get_the_post_thumbnail(get_the_ID(), $size);
		} else {
			$out = '<img src="'. get_template_directory_uri() .'/assets/images/default-image.png" alt="" />';
		}
		
		return $out;
	}
}


/*******************************************************************
Post Thumb
********************************************************************/
if ( !function_exists('builtpress_image') ) {
	function builtpress_image($image_size = 'full')
	{	
		$imageLink = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		$imageLink = $imageLink[0];
		$imageURL = get_the_post_thumbnail(get_the_ID(), $image_size);
		
		printf(
			'<a href="%s" title="%s" rel="prettyPhoto">%s</a>',
			esc_url( $permalink ),
			the_title_attribute('echo=0'),
			$imageURL
			);
	}
}


/*******************************************************************
Post Slider
********************************************************************/
if ( !function_exists('builtpress_slider') ) {
	function builtpress_slider($arr_slider, $image_size = 'full')
	{	
		$rand = rand();
		
		echo '<div class="post-slider owl-carousel">';
		foreach ( $arr_slider as $k => $image_id )
		{		
			$imageLink = wp_get_attachment_image_src($image_id, 'full');
			$imageLink = $imageLink[0];
			$imageURL = wp_get_attachment_image($image_id, $image_size);
			
			$permalink = is_single() ? $imageLink : get_permalink();
			$prettyPhoto = is_single() ? ' rel="prettyPhoto[group'.$rand.']"' : '';
			
			printf(
				'<a href="%s"%s>%s</a>',
				esc_url( $permalink ),
				$prettyPhoto,
				$imageURL
				);
		}
		echo '</div>';
	}
}


/*******************************************************************
Theme Function
********************************************************************/
if ( !function_exists('builtpress_theme_logo') ) {
	function builtpress_theme_logo()
	{
		if ( builtpress_opt('header_style') == 'v1' && builtpress_opt_page('header_transparent') ) {
			$logo = builtpress_opts('site_logo_transparent', false, 'url', get_template_directory_uri() .'/assets/images/logo-transparent.png');
		}
		else {
			$logo = builtpress_opts('site_logo', false, 'url', get_template_directory_uri() .'/assets/images/logo.png');
		}
		
		printf(
			'<a class="st-logo" href="%s" title="%s">
				<img class="logo-standart" src="%s" alt="%s" />
			</a>',
			esc_url( home_url('/') ),
			esc_attr( get_bloginfo('name') ),
			esc_url( $logo ),
			esc_attr( get_bloginfo('name') )
			);
	}
}

if ( !function_exists('builtpress_theme_search') ) {
	function builtpress_theme_search()
	{
		printf(
			'<div class="st-searchform">
				<div class="search-form">
					<form action="%s" method="get">
						<input type="text" name="s" id="s" placeholder="%s" />
					</form>
				</div>
			</div>
			<div class="search-icon"><i class="fa fa-search"></i></div>',
			esc_url( home_url('/') ),
			esc_html__('Search...', 'builtpress')
			);
	}
}

if ( !function_exists('builtpress_theme_socials') ) {
	function builtpress_theme_socials($socials = '')
	{
		$getSocial = builtpress_get_socials();	
		$social_url = builtpress_opt('social_url');
		$social_show = !empty($socials) ? $socials : builtpress_opt('header_social_show');
		
		echo '<div class="st-social">';
			echo '<ul class="list-inline">';
			foreach ( $getSocial as $k => $v ) {
				if ( isset($social_show[$k]) && $social_show[$k] == 1 ) {
					printf(
						'<li><a class="fa fa-%s" href="%s" title="%s" target="_blank"></a></li>',
						$v[0],
						esc_url( $social_url[$k] ),
						$v[1]
						);
				}
			}
			echo '</ul>';
		echo '</div>';
	}
}

if ( !function_exists('builtpress_theme_menu') ) {
	function builtpress_theme_menu($position)
	{
		switch ($position):
			case 'header':
				if ( has_nav_menu('primary') ) {
					wp_nav_menu( array( 'menu_id' => 'primary-menu', 'menu_class' => 'primary-menu list-inline', 'theme_location' => 'primary' ) );
				}
			break;
			case 'footer':
				if ( has_nav_menu('footer') ) {
					wp_nav_menu( array( 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu list-inline', 'theme_location' => 'footer', 'fallback_cb' => '', 'depth' => 1 ) );
				}
			break;
		endswitch;	
	}
}

if ( !function_exists('builtpress_theme_isvc') ) {
	function builtpress_theme_isvc()
	{
		global $post;
		
		$return = FALSE;
		
		if ( is_page() ) {
			$sc_pattern = get_shortcode_regex();
			if ( preg_match_all( '/'. $sc_pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'vc_row', $matches[2] ) ) {
				$return = TRUE;
			}		
		}
		
		return $return;
	}
}


/*******************************************************************
Print Styles
********************************************************************/
if ( !function_exists('builtpress_print_styles') ) {
	function builtpress_print_styles()
	{		
		$post_id = ( class_exists('Woocommerce') && is_woocommerce() ) ? get_option('woocommerce_shop_page_id') : get_the_ID();
		
		$logo_height	= 135;
		$topbar_height	= builtpress_opt('topbar_enable') ? 40 : 0;
		$padding_top	= $logo_height + $topbar_height;
		
		$title_padding_top		= builtpress_opt_page('title_padding_top', 40);
		$title_padding_bottom	= builtpress_opt_page('title_padding_bottom', 40);
		$color_title			= builtpress_opt_page('color_title');
		$color_subtitle 		= builtpress_opt_page('color_subtitle');
		$color_breadcrumb		= builtpress_opt_page('color_breadcrumb');
		
		$general_title_hide = get_post_meta($post_id, '_st_general_title_hide', TRUE);
		
		ob_start();
		
		require_once get_template_directory() .'/assets/css/style-custom.php';
		
		// Title Padding
		if ( !empty($title_padding_top) ) {
			echo ".title-holder { padding-top: ". intval( $title_padding_top ) ."px; }\n";
		}
		if ( !empty($title_padding_bottom) ) {
			echo ".title-holder { padding-bottom: ". intval( $title_padding_bottom ) ."px; }\n";
		}
		
		// Title Color
		if ( !empty($color_title) ) {
			echo ".page-title { color: ". esc_attr( $color_title ) ." !important; }\n";
		}
		
		// Subtitle Color
		if ( !empty($color_subtitle) ) {
			echo ".page-subtitle { color: ". esc_attr( $color_subtitle ) ." !important; }\n";
		}
		
		// Breadcrumb Color
		if ( !empty($color_breadcrumb) ) {
			echo ".breadcrumb li, .breadcrumb li a, .breadcrumb > .active { color: ". esc_attr( $color_breadcrumb ) ." !important; }\n";
		}
		
		// Padding Top
		if ( builtpress_opt('header_style') == 'v1' && builtpress_opt_page('header_transparent') ) {
			if ( $general_title_hide <> 'on' ) {
				echo "#title-wrapper { padding-top: ". intval( $padding_top ) ."px; }\n";
				echo "#content-wrapper.is-vc .post-content > .wpb_padding:first-child { padding-top: 80px; }\n";
			}
			else {
				echo "#content-wrapper.not-vc { padding-top: ". (intval( $padding_top ) + 80) ."px; }\n";
			}
		}
		else {
			if ( builtpress_opt('header_style') == 'v2' && $general_title_hide <> 'on' ) {
				echo "#title-wrapper { padding-top: 205px; }\n";
			}
			echo "#content-wrapper.is-vc .post-content > .wpb_padding:first-child { padding-top: 80px; }\n";
		}
		
		// Background Title	
		$custom_bg_title = FALSE;
		if ( is_page() || is_singular( array('st_portfolio', 'st_service', 'st_team') ) ) {
			$custom_bg_title = TRUE;
		}
		elseif ( class_exists('Woocommerce') && is_woocommerce() ) {
			$custom_bg_title = TRUE;
		}
	
		$style_bg_title = builtpress_opt('style_bg_title');
		if ( $custom_bg_title ) {
			$general_style_bg_title = builtpress_opt_page('style_bg_title');
			if ( is_array($general_style_bg_title) ) {
				if ( preg_match('/[A-F0-9]{6}/', strtoupper($general_style_bg_title['background-color'])) ) {
					$style_bg_title['background-color'] = $general_style_bg_title['background-color'];
					$style_bg_title['background-image'] = '';
				}
				if ( preg_match('/[\w\-]+\.(jpg|png|gif|jpeg)/', strtolower($general_style_bg_title['background-image'])) ) {
					$style_bg_title['background-color'] = '';
					$style_bg_title['background-image'] = $general_style_bg_title['background-image'];
				}
				if ( !empty($general_style_bg_title['background-repeat']) ) {
					$style_bg_title['background-repeat'] = $general_style_bg_title['background-repeat'];
				}
				if ( !empty($general_style_bg_title['background-size']) ) {
					$style_bg_title['background-size'] = $general_style_bg_title['background-size'];
				}
				if ( !empty($general_style_bg_title['background-attachment']) ) {
					$style_bg_title['background-attachment'] = $general_style_bg_title['background-attachment'];
				}
				if ( !empty($general_style_bg_title['background-position']) ) {
					$style_bg_title['background-position'] = $general_style_bg_title['background-position'];
				}
			}
		}
		
		if ( is_array($style_bg_title) ) {
			$output = '';
			if ( !empty($style_bg_title['background-color']) ) {
																		$output.= "background-color: ". esc_attr( $style_bg_title['color'] ) .";\n";
			}
			if ( !empty($style_bg_title['background-image']) && preg_match('/[\w\-]+\.(jpg|png|gif|jpeg)/', strtolower($style_bg_title['background-image'])) ) {
																		$output.= "background-image: url('". esc_url( $style_bg_title['background-image'] ) ."');\n";
				if ( !empty($style_bg_title['background-repeat']) ) 	$output.= "background-repeat: ". esc_attr( $style_bg_title['background-repeat'] ) .";\n";
				if ( !empty($style_bg_title['background-size']) ) 		$output.= "background-size: ". esc_attr( $style_bg_title['background-size'] ) .";\n";
				if ( !empty($style_bg_title['background-attachment']) )	$output.= "background-attachment: ". esc_attr( $style_bg_title['background-attachment'] ) .";\n";
				if ( !empty($style_bg_title['background-position']) ) 	$output.= "background-position: ". esc_attr( $style_bg_title['background-position'] ) .";\n";
			}
			if ( !empty($output) ) {
				echo "#title-wrapper {\n";
					echo htmlspecialchars_decode( esc_textarea( $output ), ENT_QUOTES );
				echo "}\n";
			}
		}
		
		if ( $custom_css = builtpress_opt('custom_css') ) {
			echo htmlspecialchars_decode( esc_textarea( $custom_css ), ENT_QUOTES )."\n";
		}
		
		$print_styles = ob_get_contents();
		ob_end_clean();
		
		$print_styles = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $print_styles);
		$print_styles = str_replace(': ', ':', $print_styles);
		$print_styles = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $print_styles);
		
		wp_add_inline_style('builtpress-style', $print_styles);
	}
}
add_action('wp_enqueue_scripts', 'builtpress_print_styles');
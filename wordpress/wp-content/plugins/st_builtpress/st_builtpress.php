<?php
/*	
Plugin Name: ST BuiltPress
Plugin URI: http://themeforest.net/user/SliceTheme
Description: Extensions plugin for BuiltPress Theme
Version: 1.0
Author: SliceTheme
Author URI: http://themeforest.net/user/SliceTheme
*/

define('SLICETHEME_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

require_once plugin_dir_path( __FILE__ ) .'st_helper.php';
require_once plugin_dir_path( __FILE__ ) .'posttype/st_type_portfolio.php';
require_once plugin_dir_path( __FILE__ ) .'posttype/st_type_service.php';
require_once plugin_dir_path( __FILE__ ) .'posttype/st_type_team.php';
require_once plugin_dir_path( __FILE__ ) .'posttype/st_type_testimonial.php';
require_once plugin_dir_path( __FILE__ ) .'posttype/st_type_client.php';
require_once plugin_dir_path( __FILE__ ) .'posttype/st_meta_page.php';
require_once plugin_dir_path( __FILE__ ) .'posttype/st_meta_post.php';
require_once plugin_dir_path( __FILE__ ) .'posttype/st_meta_global.php';

add_action( 'init', 'slicetheme_initialize_cmb_meta_boxes', 9999 );
function slicetheme_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) ) {
		require_once plugin_dir_path( __FILE__ ) .'includes/metaboxes/init.php';
	}
}
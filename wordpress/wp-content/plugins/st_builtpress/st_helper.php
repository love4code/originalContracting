<?php

if ( !class_exists('SliceTheme_Plugin_Init') ) {
	class SliceTheme_Plugin_Init {
		function __construct() {
		}
	}
}

if ( !function_exists('slicetheme_get_icons') ) {
	function slicetheme_get_icons()
	{
		$webicons = file_get_contents(plugin_dir_path( __FILE__ ).'includes/webicons.json');
		$webicons = json_decode($webicons, true);
		sort($webicons);
		
		$icons = array();
		foreach ($webicons as $icon) {
			$icons[$icon] = $icon;
		}	
		return $icons;
	}
}

if ( !function_exists('slicetheme_get_socials') ) {
	function slicetheme_get_socials()
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
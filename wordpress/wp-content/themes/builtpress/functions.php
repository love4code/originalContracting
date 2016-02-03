<?php

require_once get_template_directory() .'/library/st_functions.php';
require_once get_template_directory() .'/library/st_widgets.php';

if ( class_exists('Woocommerce') ) {
	require_once get_template_directory() .'/library/st_woocommerce.php';
}
if ( class_exists('WPBakeryVisualComposerAbstract') ) {
	require_once get_template_directory() .'/library/st_visualcomposer.php';
}
if ( class_exists('ReduxFrameworkPlugin') ) {
	require_once get_template_directory() .'/library/st_options.php';
}
if ( is_admin() ) {
	require_once get_template_directory() .'/library/vendor/tgm/tgm-plugins.php';
	if ( class_exists('SliceTheme_Plugin_Init') ) {
		require_once get_template_directory() .'/library/import/import.php';
	}
}

require_once get_template_directory() .'/library/widgets/posts.php';
require_once get_template_directory() .'/library/widgets/social.php';
require_once get_template_directory() .'/library/widgets/contact.php';
require_once get_template_directory() .'/library/widgets/services.php';
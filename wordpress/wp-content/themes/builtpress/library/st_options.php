<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "theme_st_options";

    // This line is only for altering the demo. Can be easily removed.
    //$opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'builtpress' ),
        'page_title'           => esc_html__( 'Theme Options', 'builtpress' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'get_theme_opt',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
		'forced_dev_mode_off'  => true,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'        => ' ',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );
	
	Redux::setArgs( $opt_name, $args );
	
	/*
     * ---> END ARGUMENTS
     */
	
	
    /*
     *
     * ---> START Helpers
     *
     */
    	
	$getSocial = builtpress_get_socials();
	$social_opts = array();
	$social_vals = array();
	foreach ( $getSocial as $k => $v ) {
		$social_opts[$k] = esc_attr( $v[1] );
		$social_vals[$k] = '#';
	}
	
	// -> START Basic Fields

    // -> START General
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'General', 'builtpress' ),
        'id'     => 'general-options',
        'desc'   => '',
        'icon'   => 'el el-cog',
        'fields' => array(
            array(
                'id'       => 'site_favicon',
                'type'     => 'media',
				'url'      => false,
				'default'  => '',
                'title'    => esc_html__( 'Custom Favicon', 'builtpress' ),
                'subtitle' => esc_html__( 'Upload your favicon file here.', 'builtpress' ),
            ),
            array(
                'id'       => 'site_logo',
                'type'     => 'media',
				'url'      => false,
				'default'  => '',
                'title'    => esc_html__( 'Custom Logo', 'builtpress' ),
                'subtitle' => esc_html__( 'Upload your logo file here.', 'builtpress' ),
            ),
            array(
                'id'       => 'site_logo_transparent',
                'type'     => 'media',
				'url'      => false,
				'default'  => '',
                'title'    => esc_html__( 'Custom Logo Transparent', 'builtpress' ),
                'subtitle' => esc_html__( 'Upload your logo file here.', 'builtpress' ),
            ),
            array(
                'id'       => 'site_layout',
                'type'     => 'button_set',
				'options'  => array(
								'wide' => 'Full Width', 
								'boxed' => 'Boxed'),
				'default'  => 'wide',
                'title'    => esc_html__( 'Layout Theme', 'builtpress' ),
                'subtitle' => esc_html__( 'Only available for header style "horizontal".', 'builtpress' ),
            ),
        )
    ) );

    // -> START Header
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Header', 'builtpress' ),
        'id'    => 'header-options',
        'icon'  => 'el el-file'
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Header Area', 'builtpress' ),
        'id'     => 'header-area',
		'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'header_style',
                'type'     => 'select',
				'options'  => array(
								'v1' => 'Default', 
								'v2' => 'Centered'),
				'default'  => 'v1',
                'title'    => esc_html__( 'Header Style', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'header_transparent',
                'type'     => 'switch',
				'required' => array( 'header_style', '=', 'v1' ),
				'default'  => false,
                'title'    => esc_html__( 'Header Transparent', 'builtpress' ),
                'subtitle' => esc_html__( 'Only available on header style "default".', 'builtpress' ),
            ),
            array(
                'id'       => 'header_sticky',
                'type'     => 'switch',
				'default'  => true,
                'title'    => esc_html__( 'Header Sticky', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'   => 'divider-'.uniqid(),
                'type' => 'divide',
            ),
            array(
                'id'       => 'header_info',
                'type'     => 'text',
				'options'  => array(
								'label_1' => 'Info #1 Label',
								'value_1' => 'Info #1 Value',
								'label_2' => 'Info #2 Label',
								'value_2' => 'Info #2 Value'),
				'default'  => array(
								'label_1' => '', 
								'value_1' => '',
								'label_2' => '',
								'value_2' => ''),
                'title'    => esc_html__( 'Header Info', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'header_button_link',
                'type'     => 'select',
				'data'     => 'pages',
				'default'  => '',
                'title'    => esc_html__( 'Header Button Link', 'builtpress' ),
            ),
            array(
                'id'       => 'header_button_value',
                'type'     => 'text',
				'default'  => '',
                'title'    => esc_html__( 'Header Button Value', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'header_search',
                'type'     => 'switch',
				'default'  => true,
                'title'    => esc_html__( 'Search Form', 'builtpress' ),
                'subtitle' => esc_html__( 'Enable / disable search form.', 'builtpress' ),
            ),
        )
    ) );

    // -> START Top Bar
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Top Bar Area', 'builtpress' ),
        'id'     => 'topbar-area',
		'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'topbar_enable',
                'type'     => 'switch',
				'default'  => true,
                'title'    => esc_html__( 'Top Bar', 'builtpress' ),
                'subtitle' => esc_html__( 'Enable / disable top bar area.', 'builtpress' ),
            ),
            array(
                'id'       => 'topbar_info',
                'type'     => 'text',
				'options'  => array(
								'label_1' => 'Info #1 Label',
								'value_1' => 'Info #1 Value',
								'label_2' => 'Info #2 Label',
								'value_2' => 'Info #2 Value'),
				'default'  => array(
								'label_1' => '', 
								'value_1' => '',
								'label_2' => '',
								'value_2' => ''),
                'title'    => esc_html__( 'Top Bar Info', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'topbar_social',
                'type'     => 'switch',
				'default'  => true,
                'title'    => esc_html__( 'Social Icons', 'builtpress' ),
                'subtitle' => esc_html__( 'Enable / disable social icon.', 'builtpress' ),
            ),
            array(
                'id'       => 'topbar_social_show',
                'type'     => 'checkbox',
				'required' => array( 'topbar_social', '=', true ),
				'options'  => $social_opts,
                'title'    => esc_html__( 'Social Icon?', 'builtpress' ),
                'subtitle' => esc_html__( 'Which icon should display? the social icon url will be take from Social Media setting tab.', 'builtpress' ),
            ),
        )
    ) );

    // -> START Title
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Page Title', 'builtpress' ),
        'id'     => 'title-options',
        'desc'   => '',
        'icon'   => 'el el-file-new',
        'fields' => array(
            array(
                'id'       => 'title_padding_top',
                'type'     => 'text',
				'default'  => '',
                'title'    => esc_html__( 'Padding Top', 'builtpress' ),
                'subtitle' => esc_html__( 'Set a padding for title area in (px).', 'builtpress' ),
            ),
            array(
                'id'       => 'title_padding_bottom',
                'type'     => 'text',
				'default'  => '',
                'title'    => esc_html__( 'Padding Bottom', 'builtpress' ),
                'subtitle' => esc_html__( 'Set a padding for title area in (px).', 'builtpress' ),
            ),
            array(
                'id'       => 'title_align',
                'type'     => 'select',
				'options'  => array(
								'left' => 'Left', 
								'center' => 'Center'),
				'default'  => 'left',
                'title'    => esc_html__( 'Title Align', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'title_breadcrumb',
                'type'     => 'switch',
				'default'  => true,
                'title'    => esc_html__( 'Breadcrumb', 'builtpress' ),
                'subtitle' => esc_html__( 'Enable / disable breadcrumb.', 'builtpress' ),
            ),
        )
    ) );

    // -> START Footer
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Footer', 'builtpress' ),
        'id'    => 'footer-options',
        'icon'  => 'el el-photo'
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Widget Area', 'builtpress' ),
        'id'     => 'widget-area',
		'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'footer_widget',
                'type'     => 'switch',
				'default'  => true,
                'title'    => esc_html__( 'Widget Enable', 'builtpress' ),
                'subtitle' => esc_html__( 'Enable / disable footer widget.', 'builtpress' ),
            ),
            array(
                'id'       => 'footer_widget_column',
                'type'     => 'select',
				'options'  => array(
								1 => '1 Columns', 
								2 => '2 Columns',
								3 => '3 Columns',
								4 => '4 Columns'),
				'default'  => 4,
                'title'    => esc_html__( 'Widget Column', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'footer_widget_class',
                'type'     => 'text',
				'options'  => array(
								'class_1' => '1st Column', 
								'class_2' => '2nd Column',
								'class_3' => '3rd Column',
								'class_4' => '4th Column'),
				'default'  => array(
								'class_1' => '', 
								'class_2' => '',
								'class_3' => '',
								'class_4' => ''),
                'title'    => esc_html__( 'Widget Custom Column Class', 'builtpress' ),
                'subtitle' => esc_html__( 'Optional class for footer column widget', 'builtpress' ),
            ),
        )
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Copyright Area', 'builtpress' ),
        'id'     => 'copyright-area',
		'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'footer_copyright',
                'type'     => 'switch',
				'default'  => true,
                'title'    => esc_html__( 'Copyright Enable', 'builtpress' ),
                'subtitle' => esc_html__( 'Enable / disable footer copyright.', 'builtpress' ),
            ),
            array(
                'id'       => 'footer_copyright_menu',
                'type'     => 'switch',
				'default'  => true,
                'title'    => esc_html__( 'Copyright Menu', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'footer_copyright_text',
                'type'     => 'textarea',
				'default'  => '',
                'title'    => esc_html__( 'Copyright Text', 'builtpress' ),
                'subtitle' => '',
            ),
        )
    ) );

    // -> START Styling
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Styling', 'builtpress' ),
        'id'    => 'styling-options',
        'icon'  => 'el el-tint'
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Layout', 'builtpress' ),
        'id'     => 'styling-layout',
		'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'style_skin_primary',
                'type'     => 'color',
				'compiler' => true,
                'default'  => '',
                'title'    => esc_html__( 'Color Scheme', 'builtpress' ),
                'subtitle' => esc_html__( 'Specify the color scheme.', 'builtpress' ),
            ),
            array(
                'id'       => 'style_bg_body',
                'type'     => 'background',
				'compiler' => true,
				'output'   => array( 'body.layout-boxed' ),
                'default'  => array(),
                'title'    => esc_html__( 'Body Background', 'builtpress' ),
                'subtitle' => esc_html__( 'Background with image, color, etc.', 'builtpress' ),
            ),
            array(
                'id'       => 'style_bg_page',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( 'background-color' => '#st-wrapper' ),
                'default'  => '',
                'title'    => esc_html__( 'Page Background Color', 'builtpress' ),
                'subtitle' => '',
            ),
        )
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Header Area', 'builtpress' ),
        'id'     => 'styling-header',
		'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'style_bg_header',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( 'background-color' => '#header.header-skin-default, .header-style-v1 .header-stick.affix' ),
                'default'  => '',
                'title'    => esc_html__( 'Background Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_header_border',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( 'border-color' => '#header.header-skin-default .header-top' ),
                'default'  => '',
                'title'    => esc_html__( 'Border Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_header_text',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '#header.header-skin-default #header-wrapper .header-left-info' ),
                'default'  => '',
                'title'    => esc_html__( 'Text Color', 'builtpress' ),
                'subtitle' => '',
            ),
        )
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Top Bar Area', 'builtpress' ),
        'id'     => 'styling-topbar',
		'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'style_bg_topbar',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( 'background-color' => '#header.header-skin-default #topbar-wrapper' ),
                'default'  => '',
                'title'    => esc_html__( 'Background Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_topbar_border',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( 'border-color' => '.header-skin-default #topbar-wrapper, .header-skin-default #topbar-wrapper .topbar-left, .header-skin-default #topbar-wrapper .topbar-right, .header-skin-default #topbar-wrapper li' ),
                'default'  => '',
                'title'    => esc_html__( 'Border Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_topbar_text',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '#header.header-skin-default #topbar-wrapper' ),
                'default'  => '',
                'title'    => esc_html__( 'Text Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_topbar_link',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '#header.header-skin-default #topbar-wrapper a' ),
                'default'  => '',
                'title'    => esc_html__( 'Link Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_topbar_link_hover',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '#header.header-skin-default #topbar-wrapper a:hover' ),
                'default'  => '',
                'title'    => esc_html__( 'Link Hover Color', 'builtpress' ),
                'subtitle' => '',
            ),
        )
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Title Area', 'builtpress' ),
        'id'     => 'styling-title',
		'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'style_bg_title',
                'type'     => 'background',
				'compiler' => true,
                'default'  => array(),
                'title'    => esc_html__( 'Background', 'builtpress' ),
                'subtitle' => esc_html__( 'Background with image, color, etc.', 'builtpress' ),
            ),
            array(
                'id'       => 'style_bg_title_parallax',
                'type'     => 'switch',
				'default'  => false,
                'title'    => esc_html__( 'Parallax Image', 'builtpress' ),
                'subtitle' => esc_html__( 'Enable / disable parallax image.', 'builtpress' ),
            ),
            array(
                'id'       => 'color_title',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '.page-title' ),
                'default'  => '',
                'title'    => esc_html__( 'Title Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_subtitle',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '.page-subtitle' ),
                'default'  => '',
                'title'    => esc_html__( 'Sub Title Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_breadcrumb',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '.breadcrumb li, .breadcrumb li a, .breadcrumb > .active' ),
                'default'  => '',
                'title'    => esc_html__( 'Breadcrumb Color', 'builtpress' ),
                'subtitle' => '',
            ),
        )
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Footer Area', 'builtpress' ),
        'id'     => 'styling-footer',
		'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'style_bg_footer',
                'type'     => 'background',
				'compiler' => true,
				'output'   => array( '#footer' ),
                'default'  => array(),
                'title'    => esc_html__( 'Background', 'builtpress' ),
                'subtitle' => esc_html__( 'Background with image, color, etc.', 'builtpress' ),
            ),
            array(
                'id'       => 'color_footer_heading',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '#footer-wrapper .widget-title' ),
                'default'  => '',
                'title'    => esc_html__( 'Title Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_footer_text',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '#footer-wrapper' ),
                'default'  => '',
                'title'    => esc_html__( 'Text Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_footer_link',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '#footer-wrapper a' ),
                'default'  => '',
                'title'    => esc_html__( 'Link Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_footer_link_hover',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '#footer-wrapper a:hover' ),
                'default'  => '',
                'title'    => esc_html__( 'Link Hover Color', 'builtpress' ),
                'subtitle' => '',
            ),
        )
    ) );
	
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Copyright Area', 'builtpress' ),
        'id'     => 'styling-copyright',
		'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'style_bg_copyright',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( 'background-color' => '#copyright-wrapper' ),
                'default'  => '',
                'title'    => esc_html__( 'Background Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_copyright_text',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '#copyright-wrapper, #copyright-wrapper a' ),
                'default'  => '',
                'title'    => esc_html__( 'Text Color', 'builtpress' ),
                'subtitle' => '',
            ),
            array(
                'id'       => 'color_copyright_link_hover',
                'type'     => 'color',
				'compiler' => true,
				'output'   => array( '#copyright-wrapper a:hover' ),
                'default'  => '',
                'title'    => esc_html__( 'Link Hover Color', 'builtpress' ),
                'subtitle' => '',
            ),
        )
    ) );

    // -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Typography', 'builtpress' ),
        'id'     => 'typography-options',
        'desc'   => '',
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'            => 'font_body',
                'type'          => 'typography',
                'compiler'      => true,
                'google'        => true,
                'font-backup'   => false,
				'font-weight'   => false,
                'font-style'    => false,
                'subsets'       => true,
                'font-size'     => true,
                'line-height'   => false,
                'word-spacing'  => false,
                'letter-spacing'=> false,
                'color'         => true,
                'preview'       => true,
                'all_styles'    => true,
                'output'        => array( 'body' ),
                'units'         => 'px',
                'default'       => array( 'font-family' => 'Open Sans' ),
                'title'         => esc_html__( 'Body', 'builtpress' ),
                'subtitle'      => esc_html__( 'Select custom font for your main body text.', 'builtpress' ),
            ),
            array(
                'id'            => 'font_menu',
                'type'          => 'typography',
                'compiler'      => true,
                'google'        => true,
                'font-backup'   => false,
				'font-weight'   => false,
                'font-style'    => true,
                'subsets'       => true,
                'font-size'     => false,
                'line-height'   => false,
                'word-spacing'  => false,
                'letter-spacing'=> false,
                'color'         => true,
                'preview'       => true,
                'all_styles'    => true,
                'output'        => array( '.header-skin-default ul.primary-menu li > a' ),
                'units'         => 'px',
                'default'       => array(),
                'title'         => esc_html__( 'Primary Menu', 'builtpress' ),
                'subtitle'      => esc_html__( 'Select custom font for primary menu.', 'builtpress' ),
            ),
            array(
                'id'            => 'font_heading',
                'type'          => 'typography',
                'compiler'      => true,
                'google'        => true,
                'font-backup'   => false,
				'font-weight'   => false,
                'font-style'    => false,
                'subsets'       => true,
                'font-size'     => false,
                'line-height'   => false,
                'word-spacing'  => false,
                'letter-spacing'=> false,
                'color'         => true,
                'preview'       => true,
                'all_styles'    => true,
                'output'        => array( 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6' ),
                'units'         => 'px',
                'default'       => array(),
                'title'         => esc_html__( 'Heading', 'builtpress' ),
                'subtitle'      => esc_html__( 'Select custom font for headings.', 'builtpress' ),
            ),
        )
    ) );

    // -> START Posts
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Posts', 'builtpress' ),
        'id'     => 'blog-options',
        'desc'   => '',
        'icon'   => 'el el-pencil',
        'fields' => array(
            array(
                'id'       => 'post_layout',
                'type'     => 'select',
				'options'  => array(
								'fw' => 'Full Width', 
								'lb' => 'Left Sidebar',
								'rb' => 'Right Sidebar'),
				'default'  => 'rb',
                'title'    => esc_html__( 'Post Layout', 'builtpress' ),
                'subtitle' => esc_html__( 'This layout is used while browsing post listings & single post.', 'builtpress' ),
            ),
            array(
                'id'       => 'blog-item-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Single Post', 'builtpress' ),
                'subtitle' => '',
                'indent'   => true,
            ),
            array(
                'id'       => 'post_page_title',
                'type'     => 'text',
				'default'  => 'Blog Page Title',
                'title'    => esc_html__( 'Blog Page Title', 'builtpress' ),
                'subtitle' => esc_html__( 'Enter your page title in single post.', 'builtpress' ),
            ),
            array(
                'id'       => 'post_tags',
                'type'     => 'switch',
				'default'  => true,
                'title'    => esc_html__( 'Post TagsCloud', 'builtpress' ),
                'subtitle' => esc_html__( 'Enable / disable tagscloud.', 'builtpress' ),
            ),
            array(
                'id'       => 'post_author',
                'type'     => 'switch',
				'default'  => true,
                'title'    => esc_html__( 'Author Info', 'builtpress' ),
                'subtitle' => esc_html__( 'Enable / disable author info.', 'builtpress' ),
            ),
            array(
                'id'     => 'blog-item-end',
                'type'   => 'section',
                'indent' => false,
            ),
        )
    ) );

    // -> START Pages
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Pages', 'builtpress' ),
        'id'     => 'service-options',
        'desc'   => '',
        'icon'   => 'el el-pencil',
        'fields' => array(
            array(
                'id'       => 'page_portfolio',
                'type'     => 'select',
				'data'     => 'pages',
				'default'  => '',
                'title'    => esc_html__( 'Portfolios Page', 'builtpress' ),
            ),
            array(
                'id'       => 'page_service',
                'type'     => 'select',
				'data'     => 'pages',
				'default'  => '',
                'title'    => esc_html__( 'Services Page', 'builtpress' ),
            ),
        )
    ) );

    // -> START WooCommerce
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'WooCommerce', 'builtpress' ),
        'id'     => 'woo-options',
        'desc'   => '',
        'icon'   => 'el el-shopping-cart',
        'fields' => array(
            array(
                'id'       => 'woo_layout',
                'type'     => 'select',
				'options'  => array(
								'fw' => 'Full Width', 
								'lb' => 'Left Sidebar',
								'rb' => 'Right Sidebar'),
				'default'  => 'rb',
                'title'    => esc_html__( 'WooCommerce Layout', 'builtpress' ),
                'subtitle' => esc_html__( 'This layout is used while browsing woocommerce pages.', 'builtpress' ),
            ),
            array(
                'id'       => 'woo_count',
                'type'     => 'spinner',
				'default'  => 9,
                'title'    => esc_html__( 'Display Per Page', 'builtpress' ),
                'subtitle' => '',
            ),
        )
    ) );

    // -> START Social Media
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Social Media', 'builtpress' ),
        'id'     => 'social-options',
        'desc'   => esc_html__( 'Enter social url here and then active them in footer or header options. Please add full URLs include "http://".', 'builtpress' ),
        'icon'   => 'el el-address-book',
        'fields' => array(
            array(
                'id'       => 'social_url',
                'type'     => 'text',
				'options'  => $social_opts,
				'default'  => $social_vals,
                'title'    => esc_html__( 'Social Media URL', 'builtpress' ),
                'subtitle' => '',
            ),
        )
    ) );

    // -> START Custom Code
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Custom Code', 'builtpress' ),
        'id'     => 'custom-code-options',
        'desc'   => '',
        'icon'   => 'el el-screenshot',
        'fields' => array(
            array(
                'id'       => 'custom_js',
                'type'     => 'textarea',
				'default'  => '',
                'title'    => esc_html__( 'JS Code', 'builtpress' ),
                'subtitle' => esc_html__( 'Paste your Google Analytics (or other) script code here. This will be added into the footer template of your theme.', 'builtpress' ),
            ),
            array(
                'id'       => 'custom_css',
                'type'     => 'textarea',
				'default'  => '',
                'title'    => esc_html__( 'CSS Code', 'builtpress' ),
                'subtitle' => esc_html__( 'Paste your custom CSS code here.', 'builtpress' ),
            ),
        )
    ) );
	
	global $pagenow;
	if ( $pagenow == 'themes.php' ) {
    // -> START Sidebar
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Sidebar', 'builtpress' ),
        'id'     => 'sidebar-options',
        'desc'   => '',
        'icon'   => 'el el-file-new',
        'fields' => array(
            array(
                'id'       => 'sidebar_widget',
                'type'     => 'multi_text',
                'title'    => esc_html__( 'Sidebar Widget', 'builtpress' ),
                'subtitle' => esc_html__( 'Custom page sidebar', 'builtpress' )
            ),
        )
    ) );
	
	// -> START Updated
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'One Click Update', 'builtpress' ),
        'id'     => 'update-options',
        'desc'   => esc_html__( 'Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click and forget about manual updates!<br> If you have any troubles while using auto update ( It is likely to be a permissions issue ) then you may want to manually update the theme as normal.', 'builtpress' ),
        'icon'   => 'el el-random',
        'fields' => array(
            array(
                'id'       => 'envato_username',
                'type'     => 'text',
				'default'  => '',
                'title'    => esc_html__( 'ThemeForest Username', 'builtpress' ),
                'desc'     => esc_html__( 'Enter here your ThemeForest (or Envato) username account (i.e. SliceTheme).', 'builtpress' ),
            ),
            array(
                'id'       => 'envato_api',
                'type'     => 'text',
				'default'  => '',
                'title'    => esc_html__( 'ThemeForest Secret API Key', 'builtpress' ),
                'desc'     => esc_html__( 'Enter here the secret api key you have created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', 'builtpress' ),
            ),
        )
    ) );
	}
    /*
     * <--- END SECTIONS
     */


	/*******************************************************************
	Redux Extended Function
	********************************************************************/
	if ( !function_exists('builtpress_redux_remove_link') ) {
		function builtpress_redux_remove_link() { // Be sure to rename this function to something more unique
			if ( class_exists('ReduxFrameworkPlugin') ) {
				remove_filter('plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
			}
			if ( class_exists('ReduxFrameworkPlugin') ) {
				remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices') );    
			}
		}
	}
	add_action('init', 'builtpress_redux_remove_link');

	if ( !function_exists('builtpress_redux_admin_enqueue') ) {
		function builtpress_redux_admin_enqueue()
		{
			global $pagenow;
			
			if ( $pagenow == 'themes.php' || $pagenow == 'customize.php' ) {
				wp_enqueue_style('admin-styles', get_template_directory_uri() .'/assets/css/admin-styles.css', array(), NULL);
			}
		}
	}
	add_action('admin_enqueue_scripts', 'builtpress_redux_admin_enqueue');
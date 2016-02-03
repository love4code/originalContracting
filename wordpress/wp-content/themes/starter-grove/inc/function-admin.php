<?php
/*
 * @package starter-grove
 *
 * ============================
 * ADMIN PAGE
 * add_menu_page( page-title, menu-title, capabilities / user level, slug for uri, function menu page calls to trigger and activate the generation of the page , icon url or name, menu item order)
 * ============================
 * */

function sgrove_admin_page(){
    //add admin menu page
    add_menu_page( 'sgrove Options', 'SGrove', 'manage_options', 'sgrove_options', 'sgrove_create_page','' , 110);

    // generate submenu page for amin menu option
    // add_submenu_page()parrrent slug, page titel, menu title, capability, menu slug / ID, callback function)

    add_submenu_page('sgrove_options','sgrove Options', 'Sidebar', 'manage_options','sgrove_options','sgrove_settings_page');

    add_submenu_page('sgrove_options','sgrove Theme Options', 'Theme Options', 'manage_options','sgrove_theme','sgrove_theme_support_page');
    add_submenu_page('sgrove_options','sgrove Contact Form', 'Contact Form', 'manage_options','sgrove_theme_contact','sgrove_contact_form_page');
    add_submenu_page('sgrove_options','sgrove Menu Support', 'Custom Menu', 'manage_options','sgrove_theme_menus','sgrove_custom_menu_page');
    add_submenu_page('sgrove_options','sgrove Post Thumbnail Support', 'Thumbnail Support', 'manage_options', 'sgrove_theme_post_thumbnails','sgrove_activate_post_thumbnails_page');
    add_submenu_page('sgrove_options','sgrove CSS Options', 'Custom CSS', 'manage_options','sgrove_options_css','sgrove_custom_css_page');

    // Activate Custom Settings
    add_action('admin_init', 'sgrove_custom_settings');
};
add_action('admin_menu', 'sgrove_admin_page');

function sgrove_custom_settings() {
// Register Setting
/*
 * ===========================
 * SIDEBAR OPTIONS
 * ===========================
 * */
    //Sidebar Options
    register_setting('sgrove-settings-group', 'profile_picture');
    register_setting('sgrove-settings-group', 'first_name');
    register_setting('sgrove-settings-group', 'last_name');
    register_setting('sgrove-settings-group', 'user_description');
    register_setting('sgrove-settings-group', 'github_handler');
    register_setting('sgrove-settings-group', 'linkedin_handler');
    register_setting('sgrove-settings-group', 'google_plus_handler');
    register_setting('sgrove-settings-group', 'facebook_handler');
// add Filter to Sanitize Input From Users
    register_setting('sgrove-settings-group', 'twitter_handler', 'sgrove_sanitize_twitter_handler');
// add_settings_section(id of the section , title , function to generate html, id of the page where you want to  print this section  )
    add_settings_section('sgrove-sidebar-options', 'Sidebar Options', 'sgrove_sidebar_options', 'sgrove_options');
// Settings Field
    add_settings_field('sidebar-profile-picture', ' Profile Picture', 'sgrove_sidebar_profile', 'sgrove_options', 'sgrove-sidebar-options');
    add_settings_field('sidebar-name', ' User Name', 'sgrove_sidebar_name', 'sgrove_options', 'sgrove-sidebar-options');
    add_settings_field('sidebar-description', ' User Description', 'sgrove_sidebar_description', 'sgrove_options', 'sgrove-sidebar-options');
    add_settings_field('sidebar-twitter', ' Twitter Handler', 'sgrove_twitter_handler', 'sgrove_options', 'sgrove-sidebar-options');
    add_settings_field('sidebar-git', ' Git Handler', 'sgrove_github_handler', 'sgrove_options', 'sgrove-sidebar-options');
    add_settings_field('sidebar-facebook', ' Facebook Handler', 'sgrove_facebook_handler', 'sgrove_options', 'sgrove-sidebar-options');
    add_settings_field('sidebar-linkedin', ' LinkedIn Handler', 'sgrove_linkedin_handler', 'sgrove_options', 'sgrove-sidebar-options');
    add_settings_field('sidebar-google', ' Google+ Handler', 'sgrove_google_plus_handler', 'sgrove_options', 'sgrove-sidebar-options');
 /*
* ===========================
* THEME SUPPORT OPTIONS
* ===========================
* */
    register_setting('sgrove-theme-support','post_formats');
    register_setting('sgrove-theme-support','custom_header');
    register_setting('sgrove-theme-support','custom_background');
    add_settings_section('sgrove-theme-options', 'Theme Options', 'sgrove_theme_options','sgrove_theme');

    add_settings_field('post-formats','Post Formats','sgrove_post_formats','sgrove_theme','sgrove-theme-options');
    add_settings_field('custom-header','Custom Header','sgrove_custom_header','sgrove_theme','sgrove-theme-options');
    add_settings_field('custom-background','Custom Background','sgrove_custom_background','sgrove_theme','sgrove-theme-options');
  /*
 * ===========================
 * CONTACT FORM OPTIONS
 * ===========================
 * */

    register_setting('sgrove-contact-options','activate_contact');

    add_settings_section('sgrove-contact-section','Contact Form','sgrove_contact_section','sgrove_theme_contact');

    add_settings_field('activate-form','Activate Contact Form','sgrove_activate_custom_contact_form','sgrove_theme_contact','sgrove-contact-section');
 /* ================================
 * Custom Nav Menus
 *
 * ================================
 * */
    register_setting('sgrove-custom-menus','activate_custom_menu');


    add_settings_section('sgrove-menu-section','Custom Menus','sgrove_custom_menu_callback','sgrove_theme_menus');

    add_settings_field('activate-menu','Activate Custom Menus','sgrove_activate_custom_menus','sgrove_theme_menus','sgrove-menu-section');
 /*
 * ================================
 * Theme Suppor Post-Thumbnails
 *
 * ================================
 * */
    register_setting('sgrove-post-thumbnails','activate_post_thumbnails');
    add_settings_section('sgrove-post-thumbnail-section', 'Activate Thumbnails', 'activate_post_thumbnails_callback', 'sgrove_post_thumbnails');
    add_settings_field('activate-post-thumbnails','Activate Post Thumbnails', 'sgrove_activate_post_thumbnails_callback', 'sgrove_post_thumbnails','sgrove-post-thumbnail-section');

}


// Social Handlers
/*
 * =============================
 *   SIDEBAR FUNCTIONS
 * =============================
 *
 * */
require get_template_directory() . '/inc/social_handlers.php';


function sgrove_sidebar_options() {
    echo 'Customize your sidebar information';
}
function sgrove_create_page(){
// generation of our admin page
    require_once( get_template_directory() . '/inc/templates/sgrove-admin.php');
}
function sgrove_settings_page() {
// generate settings sub_menu page
}
function sgrove_custom_css_page() {
// generate custom css sub_menu page
}
function sgrove_sidebar_description() {
    $description = esc_attr(get_option('user_description'));
    echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /><p>Write Something Smart.</p>';
}
function sgrove_sidebar_profile() {
    $profile = esc_attr(get_option('profile_picture'));
    if( empty($profile)) {
        echo '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button" /><input type="hidden" name="profile_picture" value="' . $profile . '" id="profile-picture" />';
    }else{
        echo '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button" /><input type="hidden" name="profile_picture" value="' . $profile . '" id="profile-picture" /> <input type="button" value="Remove" class="button button-secondary" id="remove-picture" />';
    }

    }
/*
 * =============================
 *   THEME SUPPORT FUNCTIONS
 * =============================
 *
 * */
//Template submenu Functions
function sgrove_theme_support_page(){
    require_once(get_template_directory() . '/inc/templates/sgrove-theme-support.php');
}
//Post Formats Callback
// $input var represents the value of what ever we save
function sgrove_theme_options() {
    echo 'Activate and Deactivate specific Theme Support Options';
}
function sgrove_post_formats() {
    $options = get_option('post_formats');
    $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
    $output = '';
    foreach($formats as $format){
        $checked = (@$options[$format] == 1 ? 'checked' : '' );
        $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' />'.$format.'</label><br>';
    }
    echo $output;
}
/*
 *======================
 *Custom Header
 *======================
 * */
function sgrove_custom_header() {
    $option = get_option('custom_header');
    $checked =( @$option == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.'/> Activate Custom Header</label>';
}
/*
 *=====================
 *Custom Background
 *=====================
 * */
function sgrove_custom_background() {
    $option = get_option('custom_background');
    $checked =( @$option == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate Custom Background</label>';
}
/*
 *======================
 * CUSTOM CONTACT FORM
 *======================
 * */
function sgrove_contact_form_page(){
    require_once(get_template_directory() . '/inc/templates/sgrove-contact-form.php');

}
function sgrove_contact_section() {
    echo 'Activate and Deactivate the built-in Contact Form';
}
function sgrove_activate_custom_contact_form() {
    $option = get_option('activate_custom_menu');
    $checked =( @$option == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="activate_custom_menu" name="activate_custom_menu" value="1" '.$checked.' /> </label>';

}
/*
 *===================
 * Nav Menus
 *===================
 * */
function sgrove_custom_menu_page(){
    require_once(get_template_directory() . '/inc/templates/sgrove-custom-menus.php');
}
function sgrove_custom_menu_callback(){
    echo 'Activate Custom Menus';
}
function sgrove_activate_custom_menus(){
    $option = get_option('activate_custom_menu');
    $checked =( @$option == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="activate_custom_menu" name="activate_custom_menu" value="1" '.$checked.' /> </label>';

}
/*
 * ================================
 * Post Thumbnails
 *
 * ================================
 * */
function sgrove_activate_post_thumbnails_page(){
    require_once(get_template_directory() . '/inc/templates/sgrove-post-thumbnails.php');
}
function activate_post_thumbnails_callback(){
    echo 'Activate Post Thumbnail Support';
}
function sgrove_activate_post_thumbnails_callback(){
    $option = get_option('activate_post_thumbnails');
    $checked =( @$option == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="activate_post_thumbnails" name="activate_post_thumbnails" value="1" '.$checked.' /> </label>';

}
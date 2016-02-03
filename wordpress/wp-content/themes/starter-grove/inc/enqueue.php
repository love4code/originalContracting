<?php
/*
 * @package starter-grove
 *
 * ============================
 * ADMIN ENQUEUE FUNCTIONS
 * ============================
 * *
 * */

/*
 * This enqueue is to add a preview of what our changes look like.
 *
 * Note:1) 1) Always Register your scripts
 *         2) Then enqueue your script.
 *
 *         3) Last you must add the action or your scripts wont load.
 *
 * Note:2) In order to require these scripts only effect the adminpages we are working on
 *         We must pass the $hook var to the admin_scripts function so we can access it from
 *         within our function.
 *
 *         To find out whats inside the $hook var ECHO it out.
 * */
function sgrove_load_admin_scripts( $hook ) {
    if('toplevel_page_sgrove_options' != $hook){
        return;
    }

    wp_register_style('sgrove_admin', get_template_directory_uri() . '/css/sgrove.admin.css', array(),'1.0.0', 'all');
    wp_enqueue_style('sgrove_admin');

    wp_enqueue_media();

    wp_register_script('sgrove-admin-script', get_template_directory_uri().'/js/sgrove.admin.js', array(),'1.0.0',true);
    wp_enqueue_script('sgrove-admin-script');
}
add_action('admin_enqueue_scripts','sgrove_load_admin_scripts');
function sgrove_enqueue_scripts(){
    wp_register_style('bootstrapCSS', get_template_directory_uri() . '/css/vendor/bootstrap.min.css', array(),'3.3.6', 'all');
    wp_enqueue_style('bootstrapCSS');
    wp_enqueue_script('jQuery');
    wp_register_script('bootstrapJS', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array('jquery'), '3.3.6',true);
    wp_enqueue_script('bootstrapJS');
}
add_action('init','sgrove_enqueue_scripts');
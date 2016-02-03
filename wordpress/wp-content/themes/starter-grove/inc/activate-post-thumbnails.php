<?php
/**
 * Created by PhpStorm.
 * User: markgrover
 * Date: 12/27/15
 * Time: 3:57 PM
 */
$sgrove_thumbnails = get_option('activate_post_thumbnails');
if( !empty( $sgrove_thumbnails ) ){
    add_theme_support( 'post-thumbnails');
}
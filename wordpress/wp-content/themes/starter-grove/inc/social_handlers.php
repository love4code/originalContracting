<?php
/**
 * Created by PhpStorm.
 * User: grover family
 * Date: 12/22/2015
 * Time: 12:12 PM
 */
function sgrove_github_handler() {
    $github = esc_attr( get_option('github_handler'));
    echo '<input type="text" name="github_handler" value="'.$github.'" placeholder="GitHub" />';
}
function sgrove_facebook_handler() {
    $facebook = esc_attr(get_option('facebook_handler'));
    echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook" />';
}
function sgrove_linkedin_handler() {
    $linkedin = esc_attr(get_option('linkedin_handler'));
    echo '<input type="text" name="linkedin_handler" value="'.$linkedin.'" placeholder="LinkedIn" />';
}
function sgrove_google_plus_handler() {
    $google = esc_attr(get_option('google_plus_handler'));
    echo '<input type="text" name="google_plus_handler" value="'.$google.'" placeholder="Google+"';
}
function sgrove_sidebar_name(){
    $firstName = esc_attr(get_option('first_name'));
    $lastName = esc_attr(get_option('last_name'));
    echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" /> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" /> ';
}
function sgrove_twitter_handler() {
    $twitter = esc_attr( get_option('twitter_handler'));
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter" />';
}

// Sanitization Settings

function sgrove_sanitize_twitter_handler($input) {
    $output = sanitize_text_field($input);
    $output = str_replace("@", '',$output);
    return $output;
}
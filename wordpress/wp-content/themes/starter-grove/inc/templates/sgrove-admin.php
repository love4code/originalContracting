<?php
/**
 * Created by PhpStorm.
 * User: grover family
 * Date: 12/21/2015
 * Time: 7:12 PM
 */
?>
<h1>SGrove Sidebar Options</h1>

<?php settings_errors(); ?>

<?php
    $picture = esc_attr(get_option('profile_picture'));
    $firstName = esc_attr(get_option('first_name'));
    $lastName = esc_attr(get_option('last_name'));
    $fullName = $firstName.' '.$lastName;
    $description = esc_attr(get_option('user_description'));
    $twitter = esc_attr(get_option('twitter_handle'));
    $facebook = esc_attr(get_option('facebook_handle'));
    $github = esc_attr(get_option('github_handle'));
    $linkedin = esc_attr(get_option('linkedin_handle'));
    $google_plus = esc_attr(get_option('google_plus_handle'));

?>
<div class="sgrove-sidebar-preview">
    <div class="sgrove_sidebar">
        <div class="image-container">
            <div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>);">

            </div>
        </div>
        <h1 class="sgrove-username"><?php print $fullName; ?></h1>
        <h2 class="sgrove-description"><?php print $description; ?></h2>
        <div class="icons-wrapper"></div>
    </div>
</div>
<form action="options.php" method="post" class="sgrove-general-form">
    <?php  settings_fields('sgrove-settings-group'); ?>

    <?php do_settings_sections('sgrove_options'); ?>
    <!-- add a wp submit button -->
    <?php submit_button('Submit','primary','btnSubmit'); ?>
</form>

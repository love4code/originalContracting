<?php
/**
 * Created by PhpStorm.
 * User: markgrover
 * Date: 12/27/15
 * Time: 3:26 PM
 */
?>
<h1>SGrove Custom Menus</h1>

<?php settings_errors(); ?>



<form action="options.php" method="post" class="sgrove-general-form">
    <?php  settings_fields('sgrove-custom-menus'); ?>

    <?php do_settings_sections('sgrove_theme_menus'); ?>
    <!-- add a wp submit button -->
    <?php submit_button(); ?>
</form>
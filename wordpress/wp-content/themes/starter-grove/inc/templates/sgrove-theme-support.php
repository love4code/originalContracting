<?php
/**
 * Created by PhpStorm.
 * User: grover family
 * Date: 12/21/2015
 * Time: 7:12 PM
 */
?>
<h1>SGrove Theme Support</h1>

<?php settings_errors(); ?>



<form action="options.php" method="post" class="sgrove-general-form">
    <?php  settings_fields('sgrove-theme-support'); ?>

    <?php do_settings_sections('sgrove_theme'); ?>
    <!-- add a wp submit button -->
    <?php submit_button(); ?>
</form>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sgrove</title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(array('sgrove','my-class')); ?> >
<?php
wp_nav_menu(array(
    'menu'              => 'primary',
    'theme_location'    => 'primary',
    'depth'             => 2,
    'container'         => 'div',
    'container_class'   => 'collapse navbar-collapse',
    'container_id'      => 'bs-example-navbar-collapse-1',
    'menu_class'        => 'nav navbar-nav',
    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
    'walker'            => new wp_bootstrap_navwalker())
);
?>

<?php
    echo 'This is the Header';

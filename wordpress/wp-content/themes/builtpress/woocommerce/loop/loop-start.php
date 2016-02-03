<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
 
$cols = ( builtpress_opt('woo_layout') == 'fw' ) ? 4 : 3;
echo '<ul class="products column-'. intval( $cols ) .'">';
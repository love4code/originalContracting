<?php

/*******************************************************************
Primary Color Skins
********************************************************************/
$style_skin_primary = builtpress_opt('style_skin_primary', '#ffb300');
if ( !empty($style_skin_primary) ) {
	echo "
body .vc_progress_bar .vc_single_bar .vc_bar,
body .vc_images_carousel .vc_carousel-indicators .vc_active,
.btn, 
button,
.button,
html input[type='button'], 
input[type='reset'], 
input[type='submit'],
input.button,
.load-more a,
a.button,
.wc-forward,
.address .edit,
.header-button,
.portfolio-link a:hover,
.woocommerce #respond input#submit, 
.woocommerce a.button, 
.woocommerce button.button, 
.woocommerce input.button,
.woocommerce #respond input#submit.alt, 
.woocommerce a.button.alt, 
.woocommerce button.button.alt, 
.woocommerce input.button.alt,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.st-button.style-1:hover,
.st-button.style-2:hover,
.wpb_color .st-button.style-1:hover,
.wpb_color .st-button.style-2:hover,
.st-pricingbox.style-1 .box-link a:hover,
.st-pricingbox.style-1.box-featured .box-link a,
.st-pricingbox.style-1.box-featured .box-link a:hover,
.st-social a::after,
.st-iconbox.style-3:hover,
.st-iconbox.style-1 .box-icon::after,
.widget.widget_tag_cloud a:hover, 
.widget.widget_product_tag_cloud a:hover,
.owl-theme .owl-controls .owl-page.active span{
	background-color:". esc_attr( $style_skin_primary ) .";
}

.st-button.style-1:hover,
.st-button.style-2:hover,
.wpb_color .st-button.style-1:hover,
.wpb_color .st-button.style-2:hover,
.st-pricingbox.style-1:hover, 
.st-pricingbox.style-1.box-featured,
.st-pricingbox.style-1 .box-link a:hover,
.st-pricingbox.style-1.box-featured .box-link a,
.st-pricingbox.style-1.box-featured .box-link a:hover,
.widget-title::before,
.format-standard .blog-container .post-thumb::before,
.format-standard .blog-container .post-thumb::after,
.st-blog .blog-container .post-thumb::before,
.st-blog .blog-container .post-thumb::after,
.portfolio-container.style-2 .portfolio-image::before,
.portfolio-container.style-2 .portfolio-image::after,
.service-container.style-2 .service-image::before,
.service-container.style-2 .service-image::after,
.load-filter li a::after,
.portfolio-link a:hover,
.st-metabox,
.sticky .blog-container,
.owl-theme .owl-controls .owl-page.active span{
	border-color:". esc_attr( $style_skin_primary ) .";
}

h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
.header-style-v1 .header-skin-default ul.primary-menu > li > a:hover,
.header-style-v1 .header-skin-default ul.primary-menu > li:hover > a,
.header-style-v1 .header-skin-default ul.primary-menu > li.current_page_item > a,
.header-style-v1 .header-skin-default ul.primary-menu > li.current-menu-parent > a,
.header-style-v1 .header-skin-default ul.primary-menu > li.current-menu-ancestor > a,
.header-skin-transparent ul.primary-menu > li > a:hover,
.header-skin-transparent ul.primary-menu > li:hover > a,
.header-skin-transparent ul.primary-menu > li.current_page_item > a,
.header-skin-transparent ul.primary-menu > li.current-menu-parent > a,
.header-skin-transparent ul.primary-menu > li.current-menu-ancestor > a,
#header-wrapper .header-left-info li .header-label,
.st-iconbox .box-icon,
.st-countdown .countdown-amount,
.service-link a, .more-link a,
.blog-container:hover .post-meta i, 
.blog-container:hover .post-meta strong,
.woocommerce .star-rating span::before,
.woocommerce p.stars a:hover,
.st-social a,
.service-container.style-1:hover .service-content h4,
.blog-container .post-title a:hover{
	color:". esc_attr( $style_skin_primary ) .";
}\n";
}
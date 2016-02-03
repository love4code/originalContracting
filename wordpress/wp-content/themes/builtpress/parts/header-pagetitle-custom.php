<section id="title-wrapper">

	<div class="container">
	<div class="row">
		
		<div class="col-md-12">
		
			<div class="title-holder">
			<div class="title-holder-cell text-<?php echo esc_attr( builtpress_opt_page('title_align', 'left') ); ?>">
			
			<?php
			$post_id = ( class_exists('Woocommerce') && is_woocommerce() ) ? get_option('woocommerce_shop_page_id') : get_the_ID();
			$title_custom = get_post_meta($post_id, '_st_general_title_custom', TRUE);
			$sub_title = get_post_meta($post_id, '_st_general_title_sub', TRUE);
			
			if ( class_exists('Woocommerce') && is_woocommerce() )	{
				$page_title = !empty($title_custom) ? $title_custom : woocommerce_page_title(false);
			}
			else {
				$page_title = !empty($title_custom) ? $title_custom : get_the_title();
			}
			
			echo '<h1 class="page-title"><span>'. esc_attr( $page_title ) .'</span></h1>';
			if ( !empty($sub_title) ) echo '<span class="page-subtitle">'. esc_attr( $sub_title ) .'</span>';
				
			if ( builtpress_opt_page('title_breadcrumb') ) {
				if ( class_exists('Woocommerce') && is_woocommerce() ) {
					woocommerce_breadcrumb();
				}
				else {
					builtpress_breadcrumb();
				}
			}			
            ?>
			
			</div>
			</div>
				
		</div>
	
	</div>
	</div>
	
	<?php
	$bg_overlay = get_post_meta($post_id, '_st_general_style_bg_overlay', TRUE);	
	if ( !empty($bg_overlay) ) {
		echo '<div class="title-overlay" style="background-color: '. esc_attr( $bg_overlay ) .';"></div>';
	}	
	?>

</section>
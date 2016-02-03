<!-- header -->
<header id="header" class="header-skin-default" role="banner">
    	
	<?php
	if ( builtpress_opt('topbar_enable') ) {
		get_template_part( 'parts/header', 'topbar' );
	}
	?>
	
	<div id="header-wrapper">
	
		<div class="container">
		<div class="row">
			
			<div class="col-md-12">
			
				<div class="header-container">
				
					<div class="header-logo">
						<?php builtpress_theme_logo(); ?>
					</div>
					<a id="toggle-mobile-menu" class="toggle-menu"><span></span></a>
				
					<div class="header-left-info">
						<ul class="list-inline">
						<?php
						$header_info = builtpress_opt('header_info');
						for ($i = 1; $i <= 2; $i++) {
							if ( !empty($header_info['label_'.$i]) && !empty($header_info['value_'.$i]) ) {
								printf(
									'<li><span class="header-label">%s</span><span class="header-hightlight">%s</span></li>',
									wp_kses_post( $header_info['label_'.$i] ),
									wp_kses_post( $header_info['value_'.$i] )
									);
							}
						}
						?>
						</ul>
					</div>
				
					<div class="header-right-info">
						<?php
						if ( builtpress_opt('header_button_link') && builtpress_opt('header_button_value') ) {
							echo '<a class="header-button" href="'. get_permalink( intval( builtpress_opt('header_button_link') ) ) .'">'. esc_attr( builtpress_opt('header_button_value') ) .'</a>';
						}
						?>
					</div>
				
				</div>
				
			</div>
		
		</div>
		</div>
	
	</div>
	
	<div id="nav-wrapper" class="header-stick">
		
		<div class="container">
		<div class="row">
			
			<div class="col-md-12">
				
				<div class="nav-container">
					
					<nav id="primary-nav" role="navigation">
						<?php builtpress_theme_menu('header'); ?>
					</nav>
				
					<div class="header-inner">
						<?php
						if ( builtpress_opt('header_search', true) ) {
							echo '<div class="header-search">';
							builtpress_theme_search();
							echo '</div>';
						}
						?>
					</div>
					
				</div>
				
			</div>
		
		</div>
		</div>
	
	</div>

</header>
<!-- end header -->
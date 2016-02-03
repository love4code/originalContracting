<div id="topbar-wrapper">
	
	<div class="container">
	<div class="row">
	
		<div class="col-md-8 col-sm-8 col-xs-12">
		
			<div class="topbar-left">
				<ul class="list-inline">
				<?php
				$topbar_info = builtpress_opt('topbar_info');
				for ($i = 1; $i <= 2; $i++) {
					if ( $topbar_info['label_'.$i] && $topbar_info['value_'.$i] ) {
						printf(
							'<li><span class="topbar-label">%s</span><span class="topbar-hightlight">%s</span></li>',
							wp_kses_post( $topbar_info['label_'.$i] ),
							wp_kses_post( $topbar_info['value_'.$i] )
							);
					}
				}
				?>
				</ul>
			</div>
			
		</div>
		
		<div class="col-md-4 col-sm-4 hidden-xs">
			
			<div class="topbar-right text-right">
				<?php
				if ( builtpress_opt('topbar_social') ) {
					builtpress_theme_socials( builtpress_opt('topbar_social_show') );
				}
				?>
			</div>
			
		</div>
	
	</div>
	</div>
	
</div>
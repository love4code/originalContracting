	<!-- footer -->
	<footer id="footer" role="contentinfo">
		
		<?php if ( builtpress_opt('footer_widget') ) { ?>
		<div id="footer-wrapper">
		
			<div class="container">
			<div class="row">
				
				<?php
				$footer_column = intval( builtpress_opt('footer_widget_column') );
				$footer_columns = array(1 => 'col-md-12', 2 => 'col-md-6 col-sm-6 col-xs-12', 3 => 'col-md-4 col-sm-6 col-xs-12', 4 => 'col-md-3 col-sm-6 col-xs-12');
				for ($i = 1; $i <= $footer_column; $i++)
				{
					$widget_class = builtpress_opts('footer_widget_class', false, 'class_'.$i, $footer_columns[$footer_column]);
					
					echo '<div class="'. esc_attr( $widget_class ) .'">';
					echo '<div class="footer-container">';
						if ( is_active_sidebar( 'footer_column_'.$i ) ) { 
							dynamic_sidebar( 'footer_column_'.$i );
						}
					echo '</div>';
					echo '</div>';
				}
				?>
				
			</div>
			</div>
		
		</div>
		<?php } ?>
		
		<?php if ( builtpress_opt('footer_copyright', true) ) { ?>
		<div id="copyright-wrapper">
				
			<div class="container">
			<div class="row">
			
				<?php $copyright_column = builtpress_opt('footer_copyright_menu') ? 'col-md-6 col-sm-12 col-xs-12' : 'col-md-12 text-center'; ?>
				<div class="<?php echo esc_attr( $copyright_column ); ?>">
					<?php
					$copyright_text = builtpress_opt('footer_copyright_text', sprintf('&copy; Copyright 2015. <a href="%s">WordPress Theme</a> by SliceTheme', 'http://www.slicetheme.com/'));
					echo '<div>'. wp_kses_post( $copyright_text ) .'</div>';
					?>					
				</div>
				
				<?php if ( builtpress_opt('footer_copyright_menu') ) { ?>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<nav id="secondary-nav" class="text-right" role="navigation">
						<?php builtpress_theme_menu('footer'); ?>
					</nav>
				</div>
				<?php } ?>
							
			</div>
			</div>
			
		</div>
		<?php } ?>
		
	</footer>
	<!-- end footer -->
	
</div>
<!-- end .wrap -->

<div class="scrollTop"><a href="#"><i class="fa fa-chevron-up"></i></a></div>

<?php wp_footer(); ?>
</body>
</html>
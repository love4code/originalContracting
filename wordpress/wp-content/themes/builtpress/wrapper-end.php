	<?php
	$page_layout = 'fw';
	if ( is_page() || is_singular( array('st_portfolio', 'st_service', 'st_team') ) ) {
		$page_layout = get_post_meta(get_the_ID(), '_st_page_layout', TRUE);
	}
	elseif ( is_home() || is_archive() || is_search() || is_singular('post') ) {
		$page_layout = builtpress_opt('post_layout', 'rb');
	}
	if ( class_exists('Woocommerce') && is_woocommerce() )
	{
		$page_layout = builtpress_opt('woo_layout', 'rb');
	}
	
	switch ($page_layout):
		case 'rb':
			?>
			</main>
			<aside id="sidebar-wrapper" class="col-md-3" role="complementary">
				<?php get_sidebar(); ?>
			</aside>
			</div>
			</div>
			<?php
		break;
		case 'lb':
			?>
			</main>
			<aside id="sidebar-wrapper" class="col-md-3 col-md-pull-9" role="complementary">
				<?php get_sidebar(); ?>
			</aside>
			</div>
			</div>
			<?php
		break;
		case 'fw':
		default:
			if ( !builtpress_theme_isvc() ) {
			?>
			</main>
			</div>
			</div>
			<?php
			}
		break;
	endswitch;
	?>	

</section>
<!-- end main-container -->
<section id="title-wrapper">
	
	<div class="container">
	<div class="row">
		
		<div class="col-md-12">
		
			<div class="title-holder">
			<div class="title-holder-cell text-<?php echo esc_attr( builtpress_opt('title_align') ); ?>">
			
			<?php
			if ( is_archive() ) {
				the_archive_title('<h1 class="page-title"><span>', '</span></h1>');
			}
			elseif ( is_search() ) {
				echo '<h1 class="page-title"><span>'. sprintf( esc_html__('Search Results for: %s', 'builtpress'), esc_html( get_search_query() ) ) .'</span></h1>';
			}
			elseif ( is_home() || is_singular('post') ) {
				echo '<h1 class="page-title"><span>'. esc_attr( builtpress_opt('post_page_title') ) .'</span></h1>';
			}
			elseif ( is_404() ) {
				echo '<h1 class="page-title"><span>'. esc_html__('Page Not Found', 'builtpress') .'</span></h1>';
			}
				
			if ( builtpress_opt('title_breadcrumb') ) {
				builtpress_breadcrumb();
			}
            ?>
			
			</div>
			</div>
				
		</div>
	
	</div>
	</div>

</section>
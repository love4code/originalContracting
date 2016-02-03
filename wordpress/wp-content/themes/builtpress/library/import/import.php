<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class BuiltPress_Import {

	public $error	= '';
	
	function __construct()
	{
		add_action( 'admin_menu', array( &$this, 'init' ) );
	}
	
	function init()
	{
		add_theme_page('Theme Import Demo', 'Theme Import Demo', 'manage_options', 'st_import', array( $this, 'slice_import' ));
	}
	
	function import_content( $folder = '', $file = 'content.xml.gz' )
	{
		$import = new WP_Import();
		$xml = get_template_directory() .'/library/import/files/'. $folder .'/'. $file;
		
		$import->fetch_attachments = ( $_POST && key_exists('attachments', $_POST) && $_POST['attachments'] ) ? true : false;
		
		ob_start();
		$import->import( $xml );	
		ob_end_clean();
	}	
	
	function import_menus( $folder = '', $file = 'menus.txt' )
	{
		$file_path 	= get_template_directory() .'/library/import/files/'. $folder .'/'. $file;
		$file_data 	= $this->get_file_contents( $file_path );
		$data 		= json_decode($file_data, true);
		$menus 		= wp_get_nav_menus();
			
		foreach( $data as $key => $val ){
			foreach( $menus as $menu ){
				if( $menu->slug == $val ){
					$data[$key] = absint( $menu->term_id );
				}
			}
		}
		
		set_theme_mod( 'nav_menu_locations', array_map('absint', $data ) );
	}
		
	function import_widgets( $folder = '', $file = 'widgets.txt' )
	{
		$file_path 	= get_template_directory() .'/library/import/files/'. $folder .'/'. $file;
		$file_data 	= $this->get_file_contents( $file_path );
		$data 		= json_decode($file_data, true);
		
		foreach ((array) $data['widgets'] as $widget_id => $widget_data) {
			update_option( 'widget_' . $widget_id, $widget_data );
		}
		
		$slice_sidebars = get_option("sidebars_widgets");
		unset($slice_sidebars['array_version']);
		
		if ( is_array($data['sidebars']) ) {
			$slice_sidebars = array_merge( (array) $slice_sidebars, (array) $data['sidebars'] );
			unset($slice_sidebars['wp_inactive_widgets']);
			$slice_sidebars = array_merge(array('wp_inactive_widgets' => array()), $slice_sidebars);
			$slice_sidebars['array_version'] = 2;
			wp_set_sidebars_widgets($slice_sidebars);
		}
	}
	
	function import_options( $folder = '', $file = 'options.txt' )
	{
		$file_path 	= get_template_directory() .'/library/import/files/'. $folder .'/'. $file;
		$file_data 	= $this->get_file_contents( $file_path );
		$data 		= json_decode($file_data, true);

		if( is_array( $data ) ){
			update_option('theme_st_options', $data);
		}
	}
	
	function import_revslider( $folder = '' )
	{
		if ( ! class_exists( 'RevSliderAdmin' ) ) {
			require_once RS_PLUGIN_PATH .'/admin/revslider-admin.class.php';
		}
		
		$rev_files = glob(get_template_directory() .'/library/import/files/'. $folder .'/revslider/*.zip');
		
		if (!empty($rev_files)) {
			foreach ($rev_files as $rev_file) {
				$_FILES['import_file']['error'] = UPLOAD_ERR_OK;
				$_FILES['import_file']['tmp_name']= $rev_file;

				$slider = new RevSlider();
				$slider->importSliderFromPost( true, 'none' );
			}
		}
	}
	
	function get_file_contents( $path )
	{
        if ( function_exists('realpath') )
            $filepath = realpath($path);
        if ( !$filepath || !@is_file($filepath) )
            return '';
		
		global $wp_filesystem;
		if (empty($wp_filesystem)) {
			require_once ABSPATH .'/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		
		return $wp_filesystem->get_contents($filepath);
    }
	
	function slice_import()
	{
		global $wpdb;
		
		if( key_exists( 'st_import_nonce',$_POST ) ){
			if ( wp_verify_nonce( $_POST['st_import_nonce'], basename(__FILE__) ) ){
				
// 				print_r($_POST);
	
				// Importer classes
				if( ! defined( 'WP_LOAD_IMPORTERS' ) ) define( 'WP_LOAD_IMPORTERS', true );
				
				if( ! class_exists( 'WP_Importer' ) ){
					require_once ABSPATH .'wp-admin/includes/class-wp-importer.php';
				}
				
				if( ! class_exists( 'WP_Import' ) ){
					require_once SLICETHEME_PLUGIN_PATH .'/includes/importer/wordpress-importer.php';
				}
				
				if( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ){
					
					$import_folder = $_POST['import_folder'];
					
					switch( $_POST['import_type'] ) {
							
						case 'all':
							$this->import_content( $import_folder );
							$this->import_menus( $import_folder );
							$this->import_widgets( $import_folder );
							$this->import_options( $import_folder );
							if ( in_array('revslider/revslider.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
								$this->import_revslider( $import_folder );
							}
							
							// set home & blog page
							$home = get_page_by_title( 'Home' );
							$blog = get_page_by_title( 'Blog' );
							if( $home->ID && $blog->ID ) {
								update_option('show_on_front', 'page');
								update_option('page_on_front', $home->ID); // Front Page
								update_option('page_for_posts', $blog->ID); // Blog Page
							}
							break;
						
						case 'content':
							$this->import_content( $import_folder );
							break;
							
						case 'menu':
							$this->import_menus( $import_folder );
							break;
							
						case 'widgets':
							$this->import_widgets( $import_folder );
							break;
							
						case 'options':
							$this->import_options( $import_folder );
							break;
							
						case 'revslider':
							if ( in_array('revslider/revslider.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
								$this->import_revslider( $import_folder );
							}
							break;
							
						default:
							$this->error = esc_html__('Please select data to import.', 'builtpress');	
							break;
					}
					
					// message box
					if( $this->error ){
						echo '<div class="error settings-error">';
							echo '<p><strong>'. $this->error .'</strong></p>';
						echo '</div>';
					} else {
						echo '<div class="updated settings-error">';
							echo '<p><strong>'. esc_html__('All done. Have fun!', 'builtpress') .'</strong></p>';
						echo '</div>';
					}

				}
	
			}
		}

		?>
		<div class="wrap">		
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>			
			<p><strong>Notice:</strong></p>
			<p>
				Before starting the import, you need to install all plugins that you want to use.<br />
				If you are planning to use the shop, please also remember about WooCommerce plugin.
			</p>	
			<form action="" method="post">				
				<input type="hidden" name="st_import_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />				
				<table class="form-table" style="width:800px;">				
					<tr>
						<th scope="row">
							<label>Import</label>
							<p class="description">Choose demo content</p>
						</th>
						<td>
							<p class="description">Demo Site</p>
							<select name="import_folder" class="import" style="width:100%">
								<option value="demo">Original</option>
							</select>
						</td>
						<td>
							<p class="description">Import Type</p>
							<select name="import_type" class="import" style="width:100%">
								<option value="">-- Select --</option>
								<option value="all">All</option>
								<option value="content">Content</option>
								<option value="menus">Menus</option>
								<option value="widgets">Widgets</option>
								<option value="options">Options</option>
								<option value="revslider">Revolution Slider</option>
							</select>
						</td>
					</tr>
					<tr class="row-attachments hide">
						<th scope="row">Attachments</th>
						<td colspan="2">
							<fieldset>
								<label for="attachments"><input type="checkbox" value="1" id="attachments" name="attachments">Import attachments</label>
								<p class="description">Download all attachments from the demo may take a while. Please be patient.</p>
							</fieldset>
						</td>
					</tr>				
				</table>	
				<input type="submit" name="submit" class="button button-primary" value="Import Data" />					
			</form>	
		</div>	
		<?php	
	}
	
}

$ST_Import = new BuiltPress_Import();

if ( file_exists(get_template_directory() .'/library/import/export.php') ) {
	require_once get_template_directory() .'/library/import/export.php';
}
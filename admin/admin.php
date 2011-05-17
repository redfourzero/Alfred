<?php
/**
 * Alfred Admin Class
 *
 * @package PITS
 * @subpackage Functions
 * @since Alfred 0.1
 */
	
if ( ! class_exists( 'alfred_admin' ) ) :
/**
 *
 *
 */
class alfred_admin extends alfred {	
	/**
	 * Get things going.
	 *
	 * @since Alfred 0.1
	 */
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * Compontent Global Variables
	 * 
	 * @since Alfred 0.1
	 */
	function _setup_globals() {
		// Nothing here yet.
	}
	
	/**
	 * Include the other admin related files.
	 *
	 * @since Alfred 0.1
	 */
	function _setup_files() {
		// Load the main files.
		foreach ( array( 'general', 'settings', 'metaboxes', 'tabs/jf-metabox-tabs' ) as $file ) {
			require_once( $file . '.php' );
		}
	}
	
	/**
	 * All of the action calls. 
	 *
	 * @since Graffu 0.1
	 */
	function _setup_actions() {
		/** General ****************************************************/
		
		// Add menu item to settings menu
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );

		// Add the settings
		add_action( 'admin_init', array( $this, 'register_admin_settings' ) );
		
		/** Tasks ****************************************************/

		// Meta Boxes
		add_action( 'add_meta_boxes', array( $this, 'metabox_add' ) );
		
		/** Misc. ****************************************************/
		
		// Save Meta Boxes
		add_action( 'save_post', array( $this, 'metabox_save' ) );		
		
		// Add some general styling to the admin area
		add_action( 'admin_head',  array( $this, 'admin_head' ) );
	}
	
	/**
	 * Create an action for adding meta boxes specifically for Alfred.
	 *
	 * @since Alfred 0.1
	 */
	function metabox_add() {
		do_action( 'alfred_add_metabox' );
	}
	
	/**
	 * Add the navigational menu elements
	 *
	 * @since Alfred 0.1
	 *
	 * @uses add_management_page() To add the Recount page in Tools section
	 * @uses add_options_page() To add the Forums settings page in Settings
	 *                           section
	 */
	function admin_menus() {
		add_options_page ( __( 'Alfred', 'alfred' ), __( 'Alfred', 'alfred' ), 'manage_options', 'alfred', 'alfred_admin_settings' );
	}

	/**
	 * Register the settings
	 *
	 * @since Alfred 0.1
	 *
	 * @uses add_settings_section() To add our own settings section
	 * @uses add_settings_field() To add various settings fields
	 * @uses register_setting() To register various settings
	 */
	function register_admin_settings() {
		/** Main Section **********************************************/

		// Add the main section
		add_settings_section( 'alfred_main', __( 'Main Options', 'alfred' ), 'alfred_admin_setting_callback_main_section', 'alfred' );
		
		// Title Handle setting
		add_settings_field( 'alfred_title',  __( 'Option', 'alfred' ), 'alfred_admin_setting_callback_', 'alfred', 'alfred_main' );
	 	register_setting( 'alfred', 'alfred_', 'esc_attr' );
	}
	
			
	/**
	 * Save all of the meta data.
	 *
	 * @since Alfred 0.1
	 */
	function metabox_save() {
		global $post;

		if( ! isset( $_POST[ "alfred" ] ) )
			return false;
		
		if( $post->post_type == 'revision' )	
			return false;
			
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return false;
			
		$meta = apply_filters( 'alfred_post_meta', $_POST[ "alfred" ] );

		foreach( $meta as $key => $meta_box ) {
			$curdata = $meta_box;
			$olddata = get_post_meta( $post->ID, $key, true );

			if( $olddata == "" && $curdata != "" )
				add_post_meta( $post->ID, $key, $curdata );
			elseif( $curdata != $olddata )
				update_post_meta( $post->ID, $key, $curdata, $olddata );
			elseif( $curdata == "" )
				delete_post_meta( $post->ID, $key );
		}
	}
	
	/**
	 * Add some general styling to the admin area
	 *
	 * @since Alfred 0.1
	 *
	 * @uses sanitize_html_class() To sanitize the classes
	 */
	function admin_head() {
		global $alfred, $post;

		// Icons for top level admin menus
		$menu_icon_url = get_stylesheet_directory_uri() . '/images/icons/menu.png';

		// Top level menu classes
		$client_class = sanitize_html_class( $alfred->client_post_type ); 
		$project_class = sanitize_html_class( $alfred->project_post_type ); 
		$task_class = sanitize_html_class( $alfred->task_post_type ); 
		$log_class = sanitize_html_class( $alfred->log_post_type ); ?>

		<style type="text/css" media="screen">
		/*<![CDATA[*/

			/* =Alfred Menus
			-------------------------------------------------------------- */

			#menu-posts-<?php echo $client_class; ?> .wp-menu-image {
				background: url(<?php echo $menu_icon_url; ?>) no-repeat 0px -32px;
			}
			#menu-posts-<?php echo $client_class; ?>:hover .wp-menu-image,
			#menu-posts-<?php echo $client_class; ?>.wp-has-current-submenu .wp-menu-image {
				background: url(<?php echo $menu_icon_url; ?>) no-repeat 0px 0px;
			}
			
			#menu-posts-<?php echo $project_class; ?> .wp-menu-image {
				background: url(<?php echo $menu_icon_url; ?>) no-repeat -32px -32px;
			}
			#menu-posts-<?php echo $project_class; ?>:hover .wp-menu-image,
			#menu-posts-<?php echo $project_class; ?>.wp-has-current-submenu .wp-menu-image {
				background: url(<?php echo $menu_icon_url; ?>) no-repeat -32px 0;
			}
			
			#menu-posts-<?php echo $task_class; ?> .wp-menu-image {
				background: url(<?php echo $menu_icon_url; ?>) no-repeat -64px -32px;
			}
			#menu-posts-<?php echo $task_class; ?>:hover .wp-menu-image,
			#menu-posts-<?php echo $task_class; ?>.wp-has-current-submenu .wp-menu-image {
				background: url(<?php echo $menu_icon_url; ?>) no-repeat -64px 0;
			}
			
			#menu-posts-<?php echo $log_class; ?> .wp-menu-image {
				background: url(<?php echo $menu_icon_url; ?>) no-repeat -96px -32px;
			}
			#menu-posts-<?php echo $log_class; ?>:hover .wp-menu-image,
			#menu-posts-<?php echo $log_class; ?>.wp-has-current-submenu .wp-menu-image {
				background: url(<?php echo $menu_icon_url; ?>) no-repeat -96px 0;
			}

		/*]]>*/
		</style>
<?php
	}
}
endif; // End class exists

$alfred_admin = new alfred_admin;
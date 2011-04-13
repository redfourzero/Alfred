<?php
/**
 * Alfed. Everyone's favorite butler.
 *
 * This is a child theme for TwentyTen. It transforms the normal blogging
 * functionality of WordPress into a (reasonably) complete project manager.
 *
 * For more information on child themes, visit the WordPress Codex.
 * 		<http://codex.wordpress.org/Child_Themes>
 *
 * @package Alfred
 * @since Alfred 0.1
 */

// Current version of Alfred.
define( 'ALFRED_VERSION', '0.1' );

if ( ! class_exists( 'alfred' ) ) :
/**
 * Oh Alfred, you're so helpful.
 *
 * @since Alfred 0.1
 */
class alfred {	
	function __construct() {
		// Make sure P2P is activated.
		if ( ! function_exists( '_p2p_init' ) ) {
			add_action( 'admin_notices', array( 'alfred_needs_p2p' ) );
			
			return false;
		}
		
		$this->_setup_globals();
		$this->_setup_files();
		$this->_setup_actions();
	}
	
	function _setup_globals() {
		
	}
	
	function _setup_files() {
		// Load the files
		foreach ( array( 'classes', 'p2p', 'options' ) as $file )
			require_once( STYLESHEETPATH . '/includes/' . $file . '.php' );

		// Load the function and template files
		foreach ( array( 'general', 'client', 'project', 'task' ) as $file ) {
			require_once( STYLESHEETPATH . '/includes/' . $file . '-functions.php' );
			require_once( STYLESHEETPATH . '/includes/' . $file . '-template.php'  );
		}

		// Quick admin check and load if needed
		if ( is_admin() )
			require_once( STYLESHEETPATH . '/admin/admin.php' );
	}
	
	function _setup_actions() {
		// Textdomain
		add_action( 'alfred_init', array( $this, 'textdomain' ) );
		
		// Custom Post Types
		add_action( 'alfred_init', array( $this, 'post_types' ) );
		
		// Custom Taxonomies
		add_action( 'alfred_init', array( $this, 'tax' ) );
		
		// Rewrite Tags
		add_action( 'alfred_init', array( $this, 'rewrite_tags' ) );
		
		// Rewrite Rules
		add_action( 'alfred_init', array( $this, 'rewrite_rules' ) );
	}
	
	/**
	 * Load the translation file for current language.
	 *
	 * @since Alfred 0.1
	 *
	 * @uses apply_filters() Calls 'alfred_locale' with the
	 *                        {@link get_locale()} value
	 * @uses load_textdomain() To load the textdomain
	 * @return bool True on success, false on failure
	 */
	function textdomain() {
		$locale = apply_filters( 'alfred_locale', get_locale() );
		$mofile = sprintf( 'alfred-%s.mo', $locale );
		$mofile_global = WP_LANG_DIR . '/' . $mofile;

		if ( file_exists( $mofile_global ) )
			return load_textdomain( 'alfred', $mofile_global );

		return false;
	}
	
	function post_types() {
		do_action( 'alfred_register_post_types' );
	}
	
	function tax() {
		do_action( 'alfred_register_taxonomies' );
	}
	
	function rewrite_tags() {
		do_action( 'alfred_add_rewrite_tags' );
	}
	
	function rewrite_rules() {
		do_action( 'alfred_generate_rewrite_rules' );
	}
	
	function component( $args ) {
		return new Alfred_Component( $args );
	}
	
	/**
	 * Alfred requires the Posts 2 Posts plugin in order
	 * to handle his business. He can do a lot, but not everything.
	 *
	 * @since Alfred 0.1
	 */
	function alfred_needs_p2p() {
		printf( '<div class="updated"><p>Alfred needs some help. Please install and activate the <a href="%s">Posts 2 Posts plugin</a> to continue.</p></div>', 'http://wordpress.org/extend/plugins/posts-to-posts/' );
	}
}
endif;

$alfred = new alfred;

function alfred_init() {
	do_action( 'alfred_init' );
}
add_action( 'init', 'alfred_init' );
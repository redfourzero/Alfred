<?php
/**
 * Alfred. Everyone's favorite butler.
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

if ( ! class_exists( 'Alfred' ) ) :
/**
 * Oh Alfred, you're so helpful.
 *
 * @since Alfred 0.1
 */
class Alfred {
	/**
	 * @var array Basic supported features.
	 */
	var $features;
	
	/**
	 * @var string Client post type id
	 */
	var $client_post_type;

	/**
	 * @var string Project post type id
	 */
	var $project_post_type;

	/**
	 * @var string Task post type id
	 */
	var $task_post_type;
	
	/**
	 * @var string Invoice post type id
	 */
	var $invoice_post_type;
	
	/**
	 * @var string Time post type id
	 */
	var $log_post_type;
  
	function __construct() {
		// Make sure P2P is activated.
		if ( ! function_exists( 'p2p_register_connection_type' ) ) {
			add_action( 'admin_notices', array( $this, 'alfred_needs_p2p' ) );
			
			return false;
		}
		
		$this->_setup_globals();
		$this->_setup_files();
		$this->_setup_actions();
	}
	
	function _setup_globals() {
		/** Identifiers *******************************************************/

		$this->features = apply_filters( 'alfred_features', array( 'client', 'project', 'task', 'invoice', 'log' ) );
		
		// Post type identifiers
		$this->client_post_type = apply_filters( 'alfred_client_post_type', 'client' );
		$this->project_post_type = apply_filters( 'alfred_project_post_type', 'project' );
		$this->task_post_type = apply_filters( 'alfred_task_post_type', 'task' );
		$this->invoice_post_type = apply_filters( 'alfred_invoice_post_type', 'invoice' );
		$this->log_post_type = apply_filters( 'alfred_log_post_type', 'log' );
	}
	
	function _setup_files() {
		foreach ( array( 'p2p', 'classes', 'options' ) as $file )
		// Load the files
			require_once( STYLESHEETPATH . '/includes/' . $file . '.php' );

		// Load the function and template files
		foreach ( array( 'general', 'user' ) as $file ) {
			require_once( STYLESHEETPATH . '/includes/' . $file . '-functions.php' );
			require_once( STYLESHEETPATH . '/includes/' . $file . '-template.php'  );
		}

		// Quick admin check and load if needed
		if ( is_admin() )
			require_once( STYLESHEETPATH . '/admin/admin.php' );
	}
	
	function _setup_actions() {
		// Set which features Alfred will use.
		add_action( 'alfred_init', array( $this, 'features' ), 1 );
		
		// Load the files for the support features.
		add_action( 'alfred_init', array( $this, 'load_features'), 5 );
		
		// Custom Post Types
		add_action( 'alfred_init', array( $this, 'post_types' ), 10 );
		
		// Custom Taxonomies
		add_action( 'alfred_init', array( $this, 'tax' ), 15 );
		
		// Rewrite Tags
		add_action( 'alfred_init', array( $this, 'rewrite_tags' ), 20 );
		
		// Rewrite Rules
		add_action( 'alfred_init', array( $this, 'rewrite_rules' ), 25 );
		
		// Textdomain
		add_action( 'alfred_init', array( $this, 'textdomain' ), 30 );
	}
	
	/**
	 * Add theme support for the default features for Alfred.
	 * These can be removed in a child theme by firing a function
	 * after this is called, and before {@link load_features()}is called.
	 *
	 * @since Alfred 0.1
	 */
	function features() {
		foreach ( $this->features as $feature )
			add_theme_support( $feature );
	}
	
	/**
	 * Load the features that the theme supports.
	 *
	 * These features can either be removed by filtering the features array via 'alfred_features'
	 * Or by removing theme support through firing an action before {@link load_features}
	 * is called.
	 *
	 * This should probably be simplified some.
	 *
	 * @since Alfred 0.1
	 */
	function load_features() {
		foreach ( $this->features as $feature ) {
			require_if_theme_supports( $feature, STYLESHEETPATH . '/includes/modules/' . $feature . '-functions.php' );
			require_if_theme_supports( $feature, STYLESHEETPATH . '/includes/modules/' . $feature . '-template.php' );
		}
	}
	
	/**
	 * Create a prioritized action for registering post types in Alfred.
	 *
	 * @since Alfred 0.1
	 */
	function post_types() {
		do_action( 'alfred_register_post_types' );
	}
	
	/**
	 * Create a prioritized action for registering taxonomies in Alfred.
	 *
	 * @since Alfred 0.1
	 */
	function tax() {
		do_action( 'alfred_register_taxonomies' );
	}
	
	/**
	 * Create a prioritized action for addign rewrite tags in Alfred.
	 *
	 * @since Alfred 0.1
	 */
	function rewrite_tags() {
		do_action( 'alfred_add_rewrite_tags' );
	}
	
	/**
	 * Create a prioritized action for adding rewrite rules in Alfred.
	 *
	 * @since Alfred 0.1
	 */
	function rewrite_rules() {
		do_action( 'alfred_generate_rewrite_rules' );
	}
	
	/**
	 * Load the translation file for current language.
	 *
	 * @since Alfred 0.1
	 */
	function textdomain() {
		$locale = apply_filters( 'alfred_locale', get_locale() );
		$mofile = sprintf( 'alfred-%s.mo', $locale );
		$mofile_global = WP_LANG_DIR . '/' . $mofile;

		if ( file_exists( $mofile_global ) )
			return load_textdomain( 'alfred', $mofile_global );

		return false;
	}
	
	/**
	 * Alfred requires the Posts 2 Posts plugin in order
	 * to handle his business. He can do a lot, but not everything.
	 *
	 * @since Alfred 0.1
	 */
	function alfred_needs_p2p() {
		printf( '<div class="updated"><p>Alfred needs some help. Please install and activate the <a href="%s">Posts 2 Posts plugin</a> to continue.</p></div>', admin_url( 'plugin-install.php?tab=search&type=term&s=Posts+2+Posts&plugin-search-input=Search+Plugins' ) );
	}
}
endif;

$alfred = new Alfred;

/**
 * Create our own initiatlization action directly after
 * the first init is fired in WordPress.
 *
 * @since Alfred 0.1
 */
function alfred_init() {
	do_action( 'alfred_init' );
}
add_action( 'init', 'alfred_init', 1 );
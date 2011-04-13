<?php/** * Alfred Loader. * * This class creates the core functionality for the theme. * Adds custom post types, taxonomies, etc. * * @since Alfred 0.1 */if ( ! class_exists( 'alfred' ) ) :/** * Oh Alfred, you're so helpful. * * @since Alfred 0.1 * */class alfred {	/**	 * @var string Client post type id	 */	var $client_post_type;	/**	 * @var string Project post type id	 */	var $project_post_type;	/**	 * @var string Task post type id	 */	var $task_post_type;		function __construct() {		$this->_setup_globals();		$this->_setup_files();		$this->_setup_actions();	}		function _setup_globals() {		/** Identifiers *******************************************************/		// Post type identifiers		$this->client_post_type = apply_filters( 'alfred_client_post_type', 'client' );		$this->project_post_type = apply_filters( 'alfred_project_post_type', 'project' );		$this->task_post_type = apply_filters( 'alfred_task_post_type', 'task' );			// Taxonomy identifiers	}		function _setup_files() {		// Load the files		foreach ( array( 'p2p', 'options' ) as $file )			require_once( STYLESHEETPATH . '/includes/' . $file . '.php' );		// Load the function and template files		foreach ( array( 'general', 'client', 'project', 'task' ) as $file ) {			require_once( STYLESHEETPATH . '/includes/' . $file . '-functions.php' );			require_once( STYLESHEETPATH . '/includes/' . $file . '-template.php'  );		}		// Quick admin check and load if needed		if ( is_admin() )			require_once( STYLESHEETPATH . '/admin/admin.php' );	}		function _setup_actions() {		// Textdomain		add_action( 'init', array( $this, 'textdomain' ) );				// Custom Post Types		add_action( 'init', array( $this, 'cpt' ) );				// Custom Taxonomies		add_action( 'init', array( $this, 'tax' ) );	}		/**	 * Load the translation file for current language.	 *	 * @since Alfred 0.1	 *	 * @uses apply_filters() Calls 'alfred_locale' with the	 *                        {@link get_locale()} value	 * @uses load_textdomain() To load the textdomain	 * @return bool True on success, false on failure	 */	function textdomain() {		$locale = apply_filters( 'alfred_locale', get_locale() );		$mofile = sprintf( 'alfred-%s.mo', $locale );		$mofile_global = WP_LANG_DIR . '/' . $mofile;		if ( file_exists( $mofile_global ) )			return load_textdomain( 'alfred', $mofile_global );		return false;	}		function cpt() {		$client_labels = array(				);				$client_supports = array(				);				$client_rewrite = array(				);				$client = register_post_type( $this->client_post_type, array(					) );	}		function tax() {		}}endif;$alfred = new alfred;
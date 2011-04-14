<?php

if ( !class_exists( 'Alfred_Component' ) ) :
/**
 * Alfred Component Class
 *
 * The Alfred component class is responsible for simplifying the creation
 * of components that share similar behaviors and routines. It is used
 * internally by Alfred clients, projects, and tasks, but can be
 * extended to create other really neat things.
 *
 * @package Alfred
 * @subpackage Classes
 *
 * @since Alfred 0.1
 */
class Alfred_Component {

	/**
	 * @var string Unique name (for internal identification)
	 * @internal
	 */
	var $name;
	
	var $type;
	
	var $atts;

	/**
	 * Alfred Component loader
	 *
	 * @since Alfred 0.1
	 *
	 * @param mixed $args Required. Supports these args:
	 *  - name: Unique name (for internal identification)
	 *  - id: Unique ID (normally for custom post type)
	 *  - slug: Unique slug (used in query string and permalinks)
	 *  - query: The loop for this component (WP_Query)
	 *  - current_id: The current ID of the queried object
	 * @uses Alfred_Component::_setup_globals() Setup the globals needed
	 * @uses Alfred_Component::_includes() Include the required files
	 * @uses Alfred_Component::_setup_actions() Setup the hooks and actions
	 */
	function __construct( $args = '' ) {
		if ( empty( $args ) )
			return;

		$this->_setup_globals( $args );
		$this->_includes();
		$this->_setup_actions();
	}

	/**
	 * Component global variables
	 *
	 * @since Alfred 0.1
	 * @access private
	 *
	 * @uses apply_filters() Calls 'alfred_{@link Alfred_Component::name}_id'
	 * @uses apply_filters() Calls 'alfred_{@link Alfred_Component::name}_slug'
	 */
	function _setup_globals( $args = '' ) {
		$this->name = $args[ 'name' ];
		$this->type = $args[ 'type' ];
		$this->atts = $args[ 'atts' ];
	}

	/**
	 * Include required files
	 *
	 * @since Alfred 0.1
	 * @access private
	 *
	 * @uses do_action() Calls 'alfred_{@link Alfred_Component::name}_includes'
	 */
	function _includes() {
		do_action( 'alfred_' . $this->name . '_includes' );
	}

	/**
	 * Setup the actions
	 *
	 * @since Alfred 0.1
	 * @access private
	 *
	 * @uses add_action() To add various actions
	 * @uses do_action() Calls
	 *                    'alfred_{@link Alfred_Component::name}_setup_actions'
	 */
	function _setup_actions() {
		// Register post types
		if ( $this->type == 'post_type' )
			add_action( 'alfred_register_post_types', array( $this, 'register_post_types' ), 10, 2 );

		// Register taxonomies
		add_action( 'alfred_register_taxonomies', array( $this, 'register_taxonomies' ), 10, 2 );

		// Add the rewrite tags
		add_action( 'alfred_add_rewrite_tags', array( $this, 'add_rewrite_tags' ), 10, 2 );

		// Generate rewrite rules
		add_action( 'alfred_generate_rewrite_rules', array( $this, 'generate_rewrite_rules' ), 10, 2 );

		// Additional actions can be attached here
		do_action( 'alfred_' . $this->name . '_setup_actions' );
	}

	/**
	 * Setup the component post types
	 *
	 * @since Alfred 0.1
	 *
	 * @uses do_action() Calls 'alfred_{@link Alfred_Component::name}_register_post_types'
	 */
	function register_post_types() {
		new Alfred_Post_Type( $this->atts );
	}

	/**
	 * Register component specific taxonomies
	 *
	 * @since Alfred 0.1
	 *
	 * @uses do_action() Calls 'alfred_{@link Alfred_Component::name}_register_taxonomies'
	 */
	function register_taxonomies() {
		do_action( 'alfred_' . $this->name . '_register_taxonomies' );
	}

	/**
	 * Add any additional rewrite tags
	 *
	 * @since Alfred 0.1
	 *
	 * @uses do_action() Calls 'alfred_{@link Alfred_Component::name}_add_rewrite_tags'
	 */
	function add_rewrite_tags() {
		do_action( 'alfred_' . $this->name . '_add_rewrite_tags' );
	}

	/**
	 * Generate any additional rewrite rules
	 *
	 * @since Alfred 0.1
	 *
	 * @uses do_action() Calls 'alfred_{@link Alfred_Component::name}_generate_rewrite_rules'
	 */
	function generate_rewrite_rules ( $wp_rewrite ) {
		do_action( 'alfred_' . $this->name . '_generate_rewrite_rules' );
	}
}
endif; // Alfred_Component

if ( ! class_exists( 'Alfred_Post_Type' ) ) :
/**
 * The post type class for creating Post Types for components.
 *
 * @package Alfred
 * @since Alfred 0.1
 */
class Alfred_Post_Type extends Alfred_Component {
	/**
	 * Define a few variables. These are passed
	 * to this constructor through a child class.
	 *
	 * @since Alfred 0.1
	 */
	function __constructor( $name, $args = array() ) {
		$this->name = $name;
		$this->args = $args;
	}
	
	/** 
	 * Add all the actions that are associated with this 
	 * component. If your component does not need all of the actions,
	 * create a method of the same name in the child class and 
	 * only include the ones you need.
	 *
	 * @since Alfred 0.1
	 */
	function actions() {	
		// Register the post_type.
		add_action( 'alfred_init', array( $this, 'register_post_type' ) );
	}
	
	/**
	 * Register the post type initially.
	 *
	 * @since Alfred 0.1
	 */
	public function register_post_type() {
		$defaults = array(
			'labels' => null,
			'supports' => array(
			
			),
			'rewrite' => null,
			'taxonomies' => array(
			
			),
			'menu_position' => 5,
			'menu_icon' => '',
			'public' => true,
			'show_ui' => true,
			'can_export' => true,
			'capability_type' => 'post',
			'query_var' => true
		);
		
		$args = wp_parse_args( $this->args, $defaults );
		
		// Create the post type.
		register_post_type( $this->name, $args );
		
		// Lets hook into it in other places.
		do_action( 'alfred_' . $this->name . '_register_post_type' );
	}
}
endif;
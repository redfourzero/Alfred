<?php
/**
 * Create the Projects Custom Post Type.
 *
 * This function is fired when the `alfred_register_post_types` hook
 * is called. To remove this post type, remove `alfred_clients_post_type`
 * from that action.
 *
 * @since Alfred 0.1
 */
function alfred_project_post_type() {
	global $alfred;
	
	register_post_type(
		$alfred->project_post_type,
		array(
			'labels' => array(
				'name' => __( 'Projects', 'alfred' ),
				'singular_name' => __( 'Project', 'alfred' ),
				'add_new' => _x( 'Add New', 'alfred' ),
				'add_new_item' => __( 'Add New Project', 'alfred' ),
				'edit_item' => __( 'Edit Project', 'alfred' ),
				'new_item' => __( 'New Project', 'alfred' ),
				'view_item' => __( 'View Project', 'alfred' ),
				'search_items' => __( 'Search Projects', 'alfred' ),
				'not_found' =>  __( 'No projects found.', 'alfred' ),
				'not_found_in_trash' => __( 'No projects found in the trash.', 'alfred' )
			),
			'supports' => array(
			
			),
			'rewrite' => array(
				'slug' => 'project',
				'with_front' => false
			),
			'taxonomies' => array(
			
			),
			'menu_position' => 5,
			'menu_icon' => '',
			'public' => true,
			'show_ui' => true,
			'can_export' => true,
			'capability_type' => 'post',
			'query_var' => true
		) 
	);
}
add_action( 'alfred_register_post_types', 'alfred_project_post_type' );

/**
 * Create the Project Status Taxonomy.
 *
 * @since Alfred 0.1
 */
if ( ! class_exists( 'Alfred_Project_Status' ) ) :
/**
 * Create the status taxonomy.
 * 
 * @since Alfred 0.1
 */
class Alfred_Project_Status extends Alfred_Taxonomy {
	/**
	 * Just create the name, slug, and labels. The rest is 
	 * done automagically.
	 *
	 * @since Alfred 0.1
	 */
	function __construct() {
		global $alfred;
		
		parent::__construct(
			'project',
			'project_status',
			'status',
			array(
				'name' => __( 'Status', 'quality' ),
				'singular_name' => __( 'Status', 'quality' ),
				'search_items' => __( 'Search Stati', 'quality' ),
				'popular_items' => __( 'Popular Stati', 'quality' ),
				'all_items' => __( 'All Stati', 'quality' ),
				'update_item' => __( 'Update Status', 'quality' ),
				'add_new_item' => __( 'Add New Status', 'quality' ),
				'new_item_name' => __( 'New Status Name', 'quality' ),
				'edit_item' => __( 'Edit Status', 'quality' )
			)
		);
		
		$this->actions();
	}
}
endif;

$project_status = new Alfred_Project_Status;
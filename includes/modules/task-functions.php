<?php
/**
 * Task-related functions. 
 *
 * @since Alfred 0.1
 */
 
/**
 * Create the Task Custom Post Type.
 *
 * This function is fired when the `alfred_register_post_types` hook
 * is called. To remove this post type, remove `alfred_clients_post_type`
 * from that action.
 *
 * @since Alfred 0.1
 */
function alfred_task_post_type() {
	global $alfred;
	
	register_post_type(
		$alfred->task_post_type,
		array(
			'labels' => array(
				'name' => __( 'Tasks', 'alfred' ),
				'singular_name' => __( 'Task', 'alfred' ),
				'add_new' => __( 'Add New', 'alfred' ),
				'add_new_item' => __( 'Add New Task', 'alfred' ),
				'edit_item' => __( 'Edit Task', 'alfred' ),
				'new_item' => __( 'New Task', 'alfred' ),
				'view_item' => __( 'View Task', 'alfred' ),
				'search_items' => __( 'Search Tasks', 'alfred' ),
				'not_found' =>  __( 'No tasks found.', 'alfred' ),
				'not_found_in_trash' => __( 'No tasks found in the trash.', 'alfred' )
			),
			'supports' => array(
				'title',
				'editor',
				'assign'
			),
			'rewrite' => array(
				'slug' => 'task',
				'with_front' => false
			),
			'taxonomies' => array(
				
			),
			'menu_position' => 7,
			'menu_icon' => '',
			'public' => true,
			'show_ui' => true,
			'can_export' => true,
			'capability_type' => 'post',
			'query_var' => true
		) 
	);
}
add_action( 'alfred_register_post_types', 'alfred_task_post_type' );

if ( ! class_exists( 'Alfred_Task_Status' ) ) :
/**
 * Create the status taxonomy.
 * 
 * @since Alfred 0.1
 */
class Alfred_Task_Status extends Alfred_Taxonomy {
	/**
	 * Just create the name, slug, and labels. The rest is 
	 * done automagically.
	 *
	 * @since Alfred 0.1
	 */
	function __construct() {
		global $alfred;
		
		parent::__construct(
			'task',
			'task_status',
			'status',
			array(
				'name' => __( 'States', 'quality' ),
				'singular_name' => __( 'Status', 'quality' ),
				'search_items' => __( 'Search States', 'quality' ),
				'popular_items' => __( 'Popular States', 'quality' ),
				'all_items' => __( 'All States', 'quality' ),
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

$task_status = new Alfred_Task_Status;

if ( ! class_exists( 'Alfred_Task_Tags' ) ) :
/**
 * Create the tags taxonomy.
 * 
 * @since Alfred 0.1
 */
class Alfred_Task_Tags extends Alfred_Taxonomy {
	/**
	 * Just create the name, slug, and labels. The rest is 
	 * done automagically.
	 *
	 * @since Alfred 0.1
	 */
	function __construct() {
		global $alfred;
		
		parent::__construct(
			'task',
			'task_tags',
			'tag',
			array(
				'name' => __( 'Tags', 'quality' ),
				'singular_name' => __( 'tag', 'quality' ),
				'search_items' => __( 'Search Tags', 'quality' ),
				'popular_items' => __( 'Popular Tags', 'quality' ),
				'all_items' => __( 'All Tags', 'quality' ),
				'update_item' => __( 'Update Tags', 'quality' ),
				'add_new_item' => __( 'Add New Tags', 'quality' ),
				'new_item_name' => __( 'New Tag Name', 'quality' ),
				'edit_item' => __( 'Edit Tag', 'quality' )
			)
		);
		
		$this->actions();
	}
	
	function actions() {
		// Register the taxonomy.
		add_action( 'alfred_register_taxonomies', array( $this, 'register_taxonomy' ) );
	}
}
endif;

$task_tags = new Alfred_Task_Tags;
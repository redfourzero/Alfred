<?php
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
			
			),
			'rewrite' => array(
				'slug' => 'task',
				'with_front' => false
			),
			'taxonomies' => array(
			
			),
			'menu_position' => 5,
			//'menu_icon' => '',
			'public' => true,
			'show_ui' => true,
			'can_export' => true,
			'capability_type' => 'post',
			'query_var' => true
		) 
	);
}
add_action( 'alfred_register_post_types', 'alfred_task_post_type' );
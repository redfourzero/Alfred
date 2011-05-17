<?php
/**
 * Log-related functions. 
 *
 * @since Alfred 0.1
 */
 
/**
 * Create the Log Custom Post Type.
 *
 * This function is fired when the `alfred_register_post_types` hook
 * is called. To remove this post type, remove `alfred_invoice_post_type`
 * from that action.
 *
 * @since Alfred 0.1
 */
function alfred_log_post_type() {
	global $alfred;
	
	register_post_type(
		$alfred->log_post_type,
		array(
			'labels' => array(
				'name' => __( 'Time Tracker', 'alfred' ),
				'singular_name' => __( 'Log', 'alfred' ),
				'add_new' => __( 'Add New', 'alfred' ),
				'add_new_item' => __( 'Add New Log', 'alfred' ),
				'edit_item' => __( 'Edit Log', 'alfred' ),
				'new_item' => __( 'New Log', 'alfred' ),
				'view_item' => __( 'View Log', 'alfred' ),
				'search_items' => __( 'Search Logs', 'alfred' ),
				'not_found' =>  __( 'No logs found.', 'alfred' ),
				'not_found_in_trash' => __( 'No logs found in the trash.', 'alfred' )
			),
			'supports' => array(
				'title',
				'editor',
				'assign'
			),
			'rewrite' => array(
				'slug' => 'log',
				'with_front' => false
			),
			'taxonomies' => array(
			
			),
			'menu_position' => 6,
			'menu_icon' => '',
			'public' => true,
			'show_ui' => true,
			'can_export' => true,
			'capability_type' => 'post',
			'query_var' => true
		) 
	);
}
add_action( 'alfred_register_post_types', 'alfred_log_post_type' );
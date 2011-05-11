<?php
/**
 * Invoice-related functions. 
 *
 * @since Alfred 0.1
 */
 
/**
 * Create the Invoice Custom Post Type.
 *
 * This function is fired when the `alfred_register_post_types` hook
 * is called. To remove this post type, remove `alfred_invoice_post_type`
 * from that action.
 *
 * @since Alfred 0.1
 */
function alfred_invoice_post_type() {
	global $alfred;
	
	register_post_type(
		$alfred->invoice_post_type,
		array(
			'labels' => array(
				'name' => __( 'Invoices', 'alfred' ),
				'singular_name' => __( 'Invoice', 'alfred' ),
				'add_new' => __( 'Add New', 'alfred' ),
				'add_new_item' => __( 'Add New Invoice', 'alfred' ),
				'edit_item' => __( 'Edit Invoice', 'alfred' ),
				'new_item' => __( 'New Invoice', 'alfred' ),
				'view_item' => __( 'View Invoice', 'alfred' ),
				'search_items' => __( 'Search Invoices', 'alfred' ),
				'not_found' =>  __( 'No invoices found.', 'alfred' ),
				'not_found_in_trash' => __( 'No invoices found in the trash.', 'alfred' )
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
			'menu_position' => 6,
			'menu_icon' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => 'edit.php?post_type=client',
			'can_export' => true,
			'capability_type' => 'post',
			'query_var' => true
		) 
	);
}
add_action( 'alfred_register_post_types', 'alfred_invoice_post_type' );
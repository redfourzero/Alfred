<?php
function alfred_clients() {
	global $alfred, $component;
	
	$component = $alfred->component( array(
		'name' => 'client'
	) );
	
	add_action( 'alfred_' . $component->name . '_register_post_types', 'alfred_clients_post_type' );
}
add_action( 'alfred_init', 'alfred_clients' );

function alfred_clients_post_type() {
	global $component;
	
	register_post_type( $component->name, array(
		'labels' => array(
			'name' => __( 'Clients', 'alfred' ),
			'singular_name' => __( 'Client', 'alfred' ),
			'add_new' => _x( 'Add New', 'alfred' ),
			'add_new_item' => __( 'Add New Client', 'alfred' ),
			'edit_item' => __( 'Edit Client', 'alfred' ),
			'new_item' => __( 'New Client', 'alfred' ),
			'view_item' => __( 'View Client', 'alfred' ),
			'search_items' => __( 'Search Clients', 'alfred' ),
			'not_found' =>  __( 'No clients found.', 'alfred' ),
			'not_found_in_trash' => __( 'No clients found in the trash.', 'alfred' )
		),
		'supports' => array(
		
		),
		'rewrite' => array(
			'slug' => 'client',
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
	) );
}
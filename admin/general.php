<?php
/**
 * General Admin-Side cleanup. 
 *
 * @since Alfred 0.1
 */
 
/**
 * Add a separator to the WordPress admin menus
 *
 * @since Alfred 0.1
 */
function alfred_admin_separator () {
	global $menu;

	$menu[] = array( '', 'read', 'separator-alfred', '', 'wp-menu-separator' );
}
add_action( 'admin_menu', 'alfred_admin_separator' );

/**
 * Move our custom separator above our custom post types
 *
 * @since Alfred 0.1
 *
 * @param array $menu_order
 */
function alfred_admin_menu_order( $menu_order ) {
	// Initialize our custom order array
	$alfred_menu_order = array();

	// Get the index of our custom separator
	$alfred_separator = array_search( 'separator-alfred', $menu_order );

	// Loop through menu order and do some rearranging
	foreach ( $menu_order as $index => $item ) {

		// Current item is our forum CPT, so set our separator here
		if ( ( 'upload.php' == $item ) ) {
			$alfred_menu_order[] = 'separator-alfred';
			unset( $menu_order[$alfred_separator] );
		}

		// Skip our separator
		if ( 'separator-alfred' != $item )
			$alfred_menu_order[] = $item;
	}

	// Return our custom order
	return $alfred_menu_order;
}
add_action( 'menu_order', 'alfred_admin_menu_order' );
add_action( 'custom_menu_order', '__return_true' );

/**
 * Remove unneeded menus from the Admin Menu.
 *
 * @since Alfred 0.1
 */
function alfred_unset_menus() {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'link-manager.php' );
}
add_action( 'admin_menu', 'alfred_unset_menus' );

/**
 * Instead of "Enter Title Here", it the title field
 * placeholder shold be more relevant to the current post type.
 *
 * @since Alfred 0.1
 */
function alfred_enter_title_here( $title ) {
	global $post;
	
	if ( $post->post_type == 'client' ) {
		$title = __( 'Client Name', 'alfred' );
	} elseif ( $post->post_type == 'project' ) {
		$title = __( 'Project Title', 'alfred' );
	} elseif( $post->post_type == 'task' ) {
		$title = __( 'Task Title', 'alfred ');
	}
	
	return $title;
}
add_filter( 'enter_title_here', 'alfred_enter_title_here' );
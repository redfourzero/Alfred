<?php
/**
 *
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
 * Unset "Posts" from the menu.
 *
 * @since Alfred 0.1
 */
function alfred_unset_post() {
	global $menu;

	if( isset( $menu[5] ) )
		unset( $menu[5] );
		
	return $menu;
}
add_action( 'admin_menu', 'alfred_unset_post' );
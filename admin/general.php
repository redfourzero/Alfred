<?php
/**
 *
 *
 * @since PITS 0.1
 */
 
/**
 * Add a separator to the WordPress admin menus
 *
 * @since PITS 0.1
 */
function pits_admin_separator () {
	global $menu;

	$menu[] = array( '', 'read', 'separator-pits', '', 'wp-menu-separator' );
}
add_action( 'admin_menu', 'pits_admin_separator' );

/**
 * Move our custom separator above our custom post types
 *
 * @since PITS 0.1
 *
 * @param array $menu_order
 */
function pits_admin_menu_order( $menu_order ) {
	// Initialize our custom order array
	$pits_menu_order = array();

	// Get the index of our custom separator
	$pits_separator = array_search( 'separator-pits', $menu_order );

	// Loop through menu order and do some rearranging
	foreach ( $menu_order as $index => $item ) {

		// Current item is our forum CPT, so set our separator here
		if ( ( 'upload.php' == $item ) ) {
			$pits_menu_order[] = 'separator-pits';
			unset( $menu_order[$pits_separator] );
		}

		// Skip our separator
		if ( 'separator-pits' != $item )
			$pits_menu_order[] = $item;
	}

	// Return our custom order
	return $pits_menu_order;
}
add_action( 'menu_order', 'pits_admin_menu_order' );
add_action( 'custom_menu_order', '__return_true' );
<?php
/**
 * Alfed. Everyone's favorite butler.
 *
 * This is a child theme for TwentyTen. It transforms the normal blogging
 * functionality of WordPress into a (reasonably) complete project manager.
 *
 * For more information on child themes, visit the WordPress Codex.
 * 		<http://codex.wordpress.org/Child_Themes>
 *
 * @package Alfred
 * @since Alfred 0.1
 */

// Current version of Alfred.
define( 'ALFRED_VERSION', '0.1' );
 
/**
 * Initilize the child theme. Load all of the other files.
 *
 * @since Alfred 0.1
 */ 
function alfred_init() {
	// Make sure P2P is activated.
	if ( ! function_exists( '_p2p_init' ) ) {
		add_action( 'admin_notices', 'alfred_needs_p2p' );
	}
	
	require_once( STYLESHEETPATH . '/includes/loader.php' );
}
add_action( 'init', 'alfred_init' );

/**
 * Alfred requires the Posts 2 Posts plugin in order
 * to handle his business. He can do a lot, but not everything.
 *
 * @since Alfred 0.1
 */
function alfred_needs_p2p() {
	printf( '<div class="updated"><p>Alfred needs some help. Please install and activate the <a href="%s">Posts 2 Posts plugin</a> to continue.</p></div>', 'http://wordpress.org/extend/plugins/posts-to-posts/' );
}
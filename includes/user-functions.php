<?php
/**
 * User-related functions.
 *
 * These are separate from Clients. However, some extra
 * tweaking is needed to make the default WordPress user system
 * work to our liking.
 *
 * @since Alfred 0.1
 */

/**
 * Change the author slug in the URI to "user" instead of "author"
 *
 * @since Alfred 0.1
 */
function alfred_rewrite_authors() {
	global $wp_rewrite;
	
	$wp_rewrite->author_base = apply_filters( 'alfred_author_slug', 'user' );
}
add_action( 'alfred_generate_rewrite_rules', 'alfred_rewrite_authors' );
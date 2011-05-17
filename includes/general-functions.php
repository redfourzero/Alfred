<?php
/**
 * General functions. 
 *
 * @since Alfred 0.1
 */
 
/**
 * Enqueue Extra Scripts
 *
 * @since Alfred 0.1
 */
function alfred_enqueue_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-stopwatch', get_stylesheet_directory_uri() . '/js/jquery.stopwatch.js' );
	wp_enqueue_script( 'jquery-alfred', get_stylesheet_directory_uri() . '/js/jquery.alfred.js' );
}
add_action( 'wp_print_scripts', 'alfred_enqueue_scripts' );

/**
 * Enqueue Extra Styles
 *
 * @since Alfred 0.1
 */
function alfred_enqueue_styles() {
	if ( is_admin() )
		wp_enqueue_style( 'alfred-admin', get_stylesheet_directory_uri() . '/admin/css/admin.css' );
}
add_action( 'admin_print_styles', 'alfred_enqueue_styles' );

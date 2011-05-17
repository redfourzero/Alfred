<?php
/**
 * General functions. 
 *
 * @since Alfred 0.1
 */
 
function alfred_enqueue_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-stopwatch', get_stylesheet_directory_uri() . '/js/jquery.stopwatch.js' );
	wp_enqueue_script( 'jquery-alfred', get_stylesheet_directory_uri() . '/js/jquery.alfred.js' );
}
add_action( 'alfred_init', 'alfred_enqueue_scripts' );
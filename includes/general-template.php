<?php

function alfred_get_relation( $post_type = '', $args = array() ) {
	global $alfred, $post, $wp_query;
	
	$defaults = array(
		'connected' => $post->ID,
		'separator' => ', '
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$connected = get_posts( array(
	  'post_type' => $post_type,
	  'connected' => $connected
	) );
	
	$display = array();
	
	foreach( $connected as $item ) {
		$display[] = sprintf(
			'<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>', 
			get_permalink( $item->ID ), 
			esc_attr__( 'Permalink to %s', 'alfred' ), get_the_title( $item->ID ), 
			get_the_title( $item->ID ) 
		);
	}
	
	return implode( $separator, $display );
}

if ( !function_exists( 'alfred_taxonomy' ) ) :
/**
 * Get the status of a ticket.
 *
 * @since Alfred 0.1
 * @uses get_the_terms
 */
function alfred_taxonomy( $taxonomy, $format = 'term_id', $post_id = null ) {
	global $post;
	
	if( empty( $post_id ) )
		$post_id = $post->ID;

	$terms = get_the_terms( $post_id, $taxonomy );

	if( empty( $terms ) )
		return false;
	
	foreach( $terms as $term )	
		return $term->$format;
}
endif;
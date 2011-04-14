<?php

function alfred_get_relation( $post_type = '', $args = array() ) {
	global $alfred, $post;
	
	$defaults = array(
		'connected' => $post->ID,
		'separator' => ', '
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$connected = new WP_Query( array(
	  'post_type' => $post_type,
	  'connected' => $connected
	) );
	
	$display = array();
	
	while( $connected->have_posts() ) : $connected->the_post();
		$display[] = sprintf(
			'<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>', 
			get_permalink( get_the_ID() ), 
			esc_attr__( 'Permalink to %s', 'alfred' ), the_title_attribute( 'echo=0' ), 
			get_the_title() 
		);
	endwhile;
	
	return implode( $separator, $display );
}

if ( !function_exists( 'alfred__taxonomy' ) ) :
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
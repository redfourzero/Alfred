<?php

function alfred_rewrite_authors() {
	global $wp_rewrite;
	
	$wp_rewrite->author_base = "user";
}
add_action( 'alfred_generate_rewrite_rules', 'alfred_rewrite_authors' );

function alfred_client_info( $post_id = '' ) {
	global $alfred, $post;
	
	if ( ! isset ( $post_id ) )
		$post = get_post( $post );
		
	if ( ! $post )
		return false;
	
	if ( $post->post_type != $alfred->client_post_type )
		return false;
		
	$client_info = get_post_meta( $post->ID, 'client', true );
	
	if ( $client_info )
		return $client_info;
		
	return false;
}

function alfred_client_contact_info( $post_id = '' ) {
	global $post;
	
	if ( ! isset ( $post_id ) )
		$post = get_post( $post );
	
	$contact_info = alfred_client_info( $post_id );
	
	return $contact_info[ 'contact' ];
}
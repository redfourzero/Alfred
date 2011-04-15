<?php

function alfred_client_meta( $key, $section = 'contact', $post_id = '' ) {
	global $alfred, $post;
	
	if ( ! isset ( $post_id ) ) {
		$post = get_post( $post );
		$post_id = $post->ID;
	}
	
	echo alfred_get_client_meta( $key, $section, $post_id );
}

	function alfred_get_client_meta( $key, $section = 'contact', $post_id = '' ) {
		global $alfred, $post;
		
		if ( ! isset ( $post_id ) )
			$post = get_post( $post );
		
		$info = alfred_client_info( $post->ID );
		
		return $info[ $section ][ $key ];
	}
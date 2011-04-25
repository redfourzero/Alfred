<?php

/**
 * Who is assigned to this task?
 *
 * @since Alfred 0.1
 * @uses alfred_get_responsibility()
 */
function alfred_responsibility( $args = array() ) {
	echo alfred_get_responsibility( $args );
}

	/**
	 * Who is assigned to this task?
	 *
	 * @since Alfred 0.1
	 */
	function alfred_get_responsibility( $args = array() ) {
		global $post;
		
		$defaults = array(
			'display' => 'display_name',
			'before' => __( 'Responsible: ', 'alfred' ),
			'after' => ''
		);
		
		$args = wp_parse_args( $args, $defaults );
		extract( $args );
		
		$user = get_user_by( 'id', get_post_meta( $post->ID, 'responsibility', true ) );

		if ( ! empty ( $user ) )
			return $before . sprintf( '<a href="%s">%s</a>', get_author_posts_url( $user->ID ), $user->$display ) . $after;
			
		return;
	}
<?php
/**
 *
 * @since Alfred 0.1
 */

/** Tasks ****************************************************/

/**
 * Create the meta box for assigning task responsibility.
 *
 * @since Alfred 0.1
 */
function alfred_metabox_task_assign() {
	global $alfred;
	
	add_meta_box( 'assign', __( 'Responsibility', 'alfred' ), '_alfred_metabox_task_assign', $alfred->task_post_type, 'side', 'low' );
}
add_action( 'add_meta_boxes', 'alfred_metabox_task_assign' );

	/**
	 * Callback for assigning responsibility. Creates a select box that
	 * displays all users.
	 *
	 * @todo Multiple assigments?
	 *
	 * @since Alfred 0.1
	 * @uses get_post_meta
	 * @users wp_dropdown_users
	 */
	function _alfred_metabox_task_assign( $post ) {
		global $post;
		
		$responsible = get_post_meta( $post->ID, 'responsibility', true );
?>
		<label class="screen-reader-text" for="alfred[responsibility]"><?php _e( 'Responsibility', 'alfred' ); ?></label>
		
		<?php
			wp_dropdown_users( array(
				'show_option_none' => __( '&mdash;Assign&mdash;', 'alfred' ),
				'selected' => $responsible,
				'name' => 'alfred[responsibility]',
				'id' => 'responsibility'
			) );
		?>
<?php	
	}
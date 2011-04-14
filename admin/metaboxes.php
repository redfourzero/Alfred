<?php
/**
 *
 * @since Alfred 0.1
 */

/** Clients ****************************************************/

/**
 * Create the meta box for client contact information.
 *
 * @since Alfred 0.1
 */
function alfred_metabox_client_contact() {
	global $alfred;
	
	add_meta_box( 'contact', __( 'Contact Information', 'alfred' ), '_alfred_metabox_client_contact', $alfred->client_post_type, 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'alfred_metabox_client_contact' );

	/**
	 * Callback for client contact information.
	 *
	 * @since Alfred 0.1
	 * @uses get_post_meta
	 */
	function _alfred_metabox_client_contact( $post ) {
		global $post;
?>
			<div class="metabox-tabs-div">
				<ul class="metabox-tabs" id="metabox-tabs">
					<li class="active tab1"><a class="active" href="javascript:void(null);"><?php _e( 'Contact Information', 'alfred' ); ?></a></li>
					<li class="tab2"><a href="javascript:void(null);"><?php _e( 'Details', 'alfred' ); ?></a></li>
				</ul>
				<div class="tab1">
					<h4 class="heading">Tab 1</h4>
					<table class="form-table">
						<tr>
							<th scope="row"><label for="jf_input1">Input 1</label></th>
							<td><input type="text" id= "jf_input1" name="jf_input1"/></td>
						</tr>
						<tr>
							<th scope="row"><label for="jf_input2">Input 2</label></th>
							<td><input type="text" id= "jf_input2" name="jf_input2"/></td>
						</tr>
					</table>
				</div>
				<div class="tab2">
					<h4 class="heading">Tab 2</h4>
					<table class="form-table">
						<tr>
							<th scope="row"><label for="jf_input3">Input 3</label></th>
							<td><input type="text" id= "jf_input3" name="jf_input3"/></td>
						</tr>
						<tr>
							<th scope="row"><label for="jf_input4">Input 4</label></th>
							<td><input type="text" id= "jf_input4" name="jf_input4"/></td>
						</tr>
					</table>
				</div>
			</div>
<?php	
	}
 
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
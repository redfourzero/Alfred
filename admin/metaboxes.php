<?php
/**
 * Create the Metaboxes.
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
	
	add_meta_box( 'contact', __( 'Client Information', 'alfred' ), '_alfred_metabox_client_contact', $alfred->client_post_type, 'normal', 'high' );
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
		
		$contact = alfred_client_info( 'contact' );
		$details = alfred_client_info( 'details' );
?>
			<div class="metabox-tabs-div">
				<ul class="metabox-tabs" id="metabox-tabs">
					<li class="active tab1"><a class="active" href="javascript:void(null);"><?php _e( 'Contact Information', 'alfred' ); ?></a></li>
					<li class="tab2"><a href="javascript:void(null);"><?php _e( 'Details', 'alfred' ); ?></a></li>
				</ul>
				<div class="tab1">
					<h4 class="heading"><?php _e( 'Contact Information', 'alfred' ); ?></h4>
					<table class="form-table">
						<?php do_action( 'alfred_meta_contact_fields_before' ); ?>
						<tr>
							<th scope="row">
								<label for="alfred[client][contact][first_name]"><?php _e( 'Contact Name', 'alfred' ); ?></label>
							</th>
							<td>
								<input type="text" id="alfred[client][contact][first_name]" name="alfred[client][contact][first_name]" style="width:100%" value="<?php echo esc_attr( $contact[ 'first_name' ] ); ?>" />
								<p class="description"><?php _e( 'First Name', 'alfred' ); ?></p>
							</td>
							<td>
								<input type="text" id="alfred[client][contact][last_name]" name="alfred[client][contact][last_name]" style="width:100%" value="<?php echo esc_attr( $contact[ 'last_name' ] ); ?>" />
								<p class="description"><?php _e( 'Last Name', 'alfred' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="alfred[client][contact][email]"><?php _e( 'Email Address', 'alfred' ); ?></label>
							</th>
							<td colspan="2">
								<input type="text" id="alfred[client][contact][email]" name="alfred[client][contact][email]" class="code" style="width:100%" value="<?php echo esc_attr( $contact[ 'email' ] ); ?>" />
								<p class="description"><?php _e( 'Separate multiple by commas.', 'alfred' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="alfred[client][contact][home_phone]"><?php _e( 'Phone Number', 'alfred' ); ?></label></th>
							<td>
								<input type="text" id="alfred[client][contact][home_phone]" name="alfred[client][contact][home_phone]" style="width:100%" value="<?php echo esc_attr( $contact[ 'home_phone' ] ); ?>" />
								<p class="description"><?php _e( 'Home Phone', 'alfred' ); ?></p>
							</td>
							<td>
								<input type="text" id="alfred[client][contact][mobile_phone]" name="alfred[client][contact][mobile_phone]" style="width:100%" value="<?php echo esc_attr( $contact[ 'mobile_phone' ] ); ?>" />
								<p class="description"><?php _e( 'Mobile', 'alfred' ); ?></p>
							</td>
						</tr>
						<?php do_action( 'alfred_meta_contact_fields_after' ); ?>
					</table>
				</div>
				<div class="tab2">
					<h4 class="heading"><?php _e( 'Details', 'alfred' ); ?></h4>
					<table class="form-table">
						<?php do_action( 'alfred_meta_detail_fields_before' ); ?>
						<tr>
							<th scope="row"><label for="alfred[client][details][street]"><?php _e( 'Address', 'alfred' ); ?></label></th>
							<td>
								<input type="text" id="alfred[client][details][country]" name="alfred[client][details][country]" style="width:100%" value="<?php echo esc_attr( $details[ 'country' ] ); ?>" />
								<p class="description"><?php _e( 'Country', 'alfred' ); ?></p>
							<td>
								<input type="text" id="alfred[client][details][street]" name="alfred[client][details][street]" style="width:100%" value="<?php echo esc_attr( $details[ 'street' ] ); ?>" />
								<p class="description"><?php _e( 'Street 1', 'alfred' ); ?></p>
							</td>
							<td>
								<input type="text" id="alfred[client][details][street2]" name="alfred[client][details][street2]" style="width:100%" value="<?php echo esc_attr( $details[ 'street2' ] ); ?>" />
								<p class="description"><?php _e( 'Street 2', 'alfred' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"></th>
							<td>
								<input type="text" id="alfred[client][details][city]" name="alfred[client][details][city]" style="width:100%" value="<?php echo esc_attr( $details[ 'city' ] ); ?>" />
								<p class="description"><?php _e( 'City', 'alfred' ); ?></p>
							</td>
							<td>
								<input type="text" id="alfred[client][details][state]" name="alfred[client][details][state]" style="width:100%" value="<?php echo esc_attr( $details[ 'state' ] ); ?>" />
								<p class="description"><?php _e( 'State/Province', 'alfred' ); ?></p>
							</td>
							<td>
								<input type="text" id="alfred[client][details][postal]" name="alfred[client][details][postal]" style="width:100%" value="<?php echo esc_attr( $details[ 'postal' ] ); ?>" />
								<p class="description"><?php _e( 'Postal/Zip Code', 'alfred' ); ?></p>
							</td>
						</tr>
						<?php do_action( 'alfred_meta_detail_fields_after' ); ?>
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
				'show_option_none' => __( '&mdash;', 'alfred' ),
				'selected' => $responsible,
				'name' => 'alfred[responsibility]',
				'id' => 'responsibility'
			) );
		?>
<?php	
	}
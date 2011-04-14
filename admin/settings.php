<?php
/** Start Main Section ****************************************************/

/**
 * Main settings section description for the settings page
 *
 * @since Alfred 0.1
 */
function alfred_admin_setting_callback_main_section() {
?>

			<p><?php _e( 'General options to control certain aspects of the site.', 'alfred' ); ?></p>

<?php
}

/**
 * Production setting field
 *
 * @since Alfred 0.1
 *
 * @uses form_option() To output the option value
 */
function alfred_admin_setting_callback_() {
?>
			<input name="alfred_" type="text" id="alfred_title" value="<?php form_option( 'alfred_' ); ?>" class="regular-text" />
			<label for="alfred_"><?php _e( '', 'alfred' ); ?></label>
<?php
}

/** Settings Page *************************************************************/

/**
 * The main settings page
 *
 * @since Alfred 0.1
 *
 * @uses screen_icon() To display the screen icon
 * @uses settings_fields() To output the hidden fields for the form
 * @uses do_settings_sections() To output the settings sections
 * @uses submit_button() to create a submit button.
 */
function alfred_admin_settings() {
?>

	<div class="wrap">

		<?php screen_icon(); ?>

		<h2><?php _e( 'Alfred Settings', 'alfred' ) ?></h2>

		<form action="options.php" method="post">

			<?php 
				settings_fields( 'alfred' ); 
				do_settings_sections( 'alfred' ); 
				
				submit_button( __( 'Save Changes', 'alfred' ) ); 
			?>
			
		</form>
	</div>

<?php
}
?>
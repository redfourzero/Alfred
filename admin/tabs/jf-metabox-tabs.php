<?php
/*
Plugin Name: Metabox Tabs Sample Plugin
*/

class JF_Metabox_Tabs {
	public function __construct() {
		add_action( 'admin_print_styles-post-new.php', array( $this, 'enqueue'      ) );
		add_action( 'admin_print_styles-post.php',     array( $this, 'enqueue'      ) );
	}

	public function enqueue() {
		$color = get_user_meta( get_current_user_id(), 'admin_color', true );

		wp_enqueue_style(  'jf-metabox-tabs', get_stylesheet_directory_uri() . '/admin/tabs/metabox-tabs.css' );
		wp_enqueue_style(  "jf-$color",  get_stylesheet_directory_uri() . "/admin/tabs/metabox-$color.css" );
		wp_enqueue_script( 'jf-metabox-tabs', get_stylesheet_directory_uri() . '/admin/tabs/metabox-tabs.js' );
	}
}
new JF_Metabox_Tabs;
?>
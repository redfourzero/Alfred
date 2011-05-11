<?php

if ( ! class_exists( 'Alfred_Taxonomy' ) ) :
/**
 * A parent class that can be used to create new taxonomies
 * for the theme. This cuts down the amount of work needed
 * for adding custom taxes.
 *
 * @package Alfred
 * @since Alfred 0.1
 */
class Alfred_Taxonomy {
	/**
	 * Define a few variables. These are passed
	 * to this constructor through a child class.
	 *
	 * @since Alfred 0.1
	 */
	function __construct( $post_type = '', $taxonomy = '', $taxonomy_slug = '', $taxonomy_labels = array() ) {		
		$this->post_type = $post_type;
		$this->taxonomy = $taxonomy;
		$this->taxonomy_slug = $taxonomy_slug;
		$this->taxonomy_labels = $taxonomy_labels;
	}
	
	/** 
	 * Add all the actions that are associated with this 
	 * taxonomy. If your taxonomy does not need all of the actions,
	 * create a method of the same name in the child class and 
	 * only include the ones you need.
	 *
	 * @since Alfred 0.1
	 */
	function actions() {	
		// Register the taxonomy.
		add_action( 'alfred_register_taxonomies', array( $this, 'register_taxonomy' ) );
						
		// Add the new meta box for the backend.
		add_action( 'alfred_add_metabox', array( $this, 'meta_box' ) );
		
		// When a post is saved in the admin panel, save the taxonomy.
		add_action( 'save_post', array( $this, 'save_taxonomy' ) );
	}
	
	/**
	 * Register the taxonomy initially. Use the
	 * name, slug, and label created in the child(?) function.
	 *
	 * @since Alfred 0.1
	 */
	public function register_taxonomy() {		
		register_taxonomy( 
			$this->taxonomy, 
			array( $this->post_type ), 
			array(
				'labels' => apply_filters( 
					"alfred_{$this->taxonomy}_labels", 
					$this->taxonomy_labels 
				),
				'show_tagcloud' => false,
				'show_ui' => true,
				'rewrite' => apply_filters( 
					"alfred_{$this->taxonomy}_rewrite", 
					array(
						'slug' => $this->taxonomy_slug
					) 
				),
				'update_count_callback' => apply_filters( 
					"alfred_{$this->taxonomy}_callback", 
					'_update_post_term_count' 
				)
			) 
		);
	}
			
	/**
	 * Remove the default meta box created when registering a public taxonomy.
	 * Instead we create our own which uses a select box, as opposed to a text field.
	 *
	 * To override this method, simply redeclare it in the child class. 
	 *
	 * @since Alfred 0.1
	 * @uses add_meta_box
	 */	 
	function meta_box() {
		$taxonomy = get_taxonomy( $this->taxonomy );
		
		remove_meta_box( "tagsdiv-{$this->taxonomy}", $this->post_type, "side" );
		
		if ( ! get_terms( array( $this->taxonomy ), array( 'hide_empty' => 0 ) ) )
			return false;
		
		add_meta_box( $this->taxonomy, $taxonomy->labels->singular_name, array( $this, '_meta_box' ), $this->post_type, 'side', 'low' );
	}
	
		/**
		 * Create the new meta box for the taxonomy. Uses a select box
		 * as opposed to a text field.
		 *
		 * To override this method, simply redeclare it in the child class. 
		 * 
		 * @since Alfred 0.1
		 * @uses wp_dropdown_categories.
		 */
		function _meta_box() {
			global $post, $alfred;
			
			echo'<div class="input-text-wrap" style="margin:5px 0 0">';

			wp_dropdown_categories( array(
				'taxonomy' => $this->taxonomy,
				'hide_empty' => 0,
				'name' => "alfred[{$this->taxonomy}]",
				'selected' => ( alfred_taxonomy( $this->taxonomy ) ? alfred_taxonomy( $this->taxonomy ) : '' )
			) );
				
			echo'</div>';
		}
	
	/**
	 * Save the taxonomy when a ticket is created/updated
	 * using the backend WP admin. This is different than when
	 * a ticket is created in the frontend, or updated in the front end.
	 *
	 * To override this method, simply redeclare it in the child class. 
	 *
	 * @since Alfred 0.1
	 * @uses wp_set_object_terms
	 */
	function save_taxonomy( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
			
		$taxonomy = isset( $_POST[ 'alfred' ][ $this->taxonomy ] ) ? $_POST[ 'alfred' ][ $this->taxonomy ] : 0;

		$taxonomy = wp_set_object_terms( $post_id, intval( $taxonomy ), $this->taxonomy, false );
		
		return $taxonomy;
	}
}
endif;

$alfred_taxonomy = new Alfred_Taxonomy;
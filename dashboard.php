<?php
/**
 * The dashboard.
 *
 * @package Alfred
 * @since Alfred 0.1
 */

global $alfred; ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<h1 class="entry-title"><?php the_title(); ?></h1>
					
					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
					
				</div><!-- #post-xx -->
				
<?php endwhile; ?>

<?php
	// Clients
	query_posts( array(
		'post_type' => array( $alfred->client_post_type ),
		'posts_per_page' => -1
	) );
?>
	
				<h2 class="section-title"><?php _e( 'Clients', 'alfred' ); ?></h2>
				
				<?php get_template_part( 'templates/loop', 'clients' ); ?>
				
<?php
	// Projects
	query_posts( array(
		'post_type' => array( $alfred->project_post_type ),
		'posts_per_page' => -1
	) );
?>
	
				<h2 class="section-title"><?php _e( 'Projects', 'alfred' ); ?></h2>
				
				<?php get_template_part( 'templates/loop', 'projects' ); ?>
				
<?php
	// Tasks
	query_posts( array(
		'post_type' => array( $alfred->task_post_type ),
		'posts_per_page' => -1
	) );
?>
	
				<h2 class="section-title"><?php _e( 'Tasks', 'alfred' ); ?></h2>
				
				<?php get_template_part( 'templates/loop', 'tasks' ); ?>
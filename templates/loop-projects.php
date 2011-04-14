<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h3 class="project-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'alfred' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'alfred' ) ); ?>

					<div class="entry-utility">
						<?php printf( '<strong>Task(s):</strong> %s', alfred_get_relation( 'task' ) ); ?> <br />
						<?php printf( '<strong>Status:</strong> %s', alfred_taxonomy( 'project_status', 'name' ) ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->
					
<?php endwhile; ?>
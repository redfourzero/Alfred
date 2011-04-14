<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h3 class="client-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'alfred' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'alfred' ) ); ?>

					<div class="entry-utility">
						<?php printf( 'Project(s): %s', '' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->
					
<?php endwhile; ?>
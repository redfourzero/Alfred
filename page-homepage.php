<?php
/**
 * Template Name: Alfred - Homepage
 *
 * A "Dashboard" to display as much relevant information as
 * possible for the current user.
 *
 * @since Alfred 0.1
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
			
				<?php get_template_part( 'dashboard', ( is_user_logged_in() ? 'logged-in' : '' ) ); ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

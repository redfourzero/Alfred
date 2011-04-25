<?php

function alfred_rewrite_authors() {
	global $wp_rewrite;
	
	$wp_rewrite->author_base = "user";
}
add_action( 'alfred_generate_rewrite_rules', 'alfred_rewrite_authors' );
<?php
/**
 * Link Projects to Clients.
 *
 * Uses the Posts to Posts plugin.
 *
 * @since Alfred 0.1
 */
function alfred_projects_2_clients() {
    if ( !function_exists( 'p2p_register_connection_type' ) )
        return;

    p2p_register_connection_type( array( 
        'from' => 'project',
        'to' => 'client',
		'title' => array(
			'from' => __( 'Client', 'alfred' )
		),
		'prevent_duplicates' => false,
    ) );
}
add_action( 'init', 'alfred_projects_2_clients', 100 );

/**
 * Link Tasks to Projects
 *
 * Uses the Posts to Posts plugin.
 *
 * @since Alfred 0.1
 */
function alfred_tasks_2_projects() {
    if ( !function_exists( 'p2p_register_connection_type' ) )
        return;

    p2p_register_connection_type( array( 
        'from' => 'task',
        'to' => 'project',
		'title' => array(
			'from' => __( 'Project', 'alfred' )
		),
		'prevent_duplicates' => false,
    ) );
}
add_action( 'init', 'alfred_tasks_2_projects', 100 );
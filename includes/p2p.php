<?php
/**
 * Link Projects to Clients.
 *
 * Uses the Posts to Posts plugin.
 *
 * @since Alfred 0.1
 */
function alfred_projects_2_clients() {
	global $alfred;
	
    if ( !function_exists( 'p2p_register_connection_type' ) )
        return;

    p2p_register_connection_type( array( 
        'from' => $alfred->project_post_type,
        'to' => $alfred->client_post_type,
		'title' => array(
			'from' => __( 'Client', 'alfred' )
		),
		'prevent_duplicates' => false,
    ) );
}
add_action( 'alfred_init', 'alfred_projects_2_clients', 100 );

/**
 * Link Tasks to Projects
 *
 * Uses the Posts to Posts plugin.
 *
 * @since Alfred 0.1
 */
function alfred_tasks_2_projects() {
	global $alfred;
	
    if ( !function_exists( 'p2p_register_connection_type' ) )
        return;

    p2p_register_connection_type( array( 
        'from' => $alfred->task_post_type,
        'to' => $alfred->project_post_type,
		'title' => array(
			'from' => __( 'Project', 'alfred' )
		),
		'prevent_duplicates' => false,
    ) );
}
add_action( 'alfred_init', 'alfred_tasks_2_projects', 100 );

/**
 * Link Time Logs to Clients
 *
 * Uses the Posts to Posts plugin.
 *
 * @since Alfred 0.1
 */
function alfred_logs_2_clients() {
	global $alfred;
	
    if ( !function_exists( 'p2p_register_connection_type' ) )
        return;

    p2p_register_connection_type( array( 
        'from' => $alfred->log_post_type,
        'to' => $alfred->client_post_type,
		'title' => array(
			'from' => __( 'Client', 'alfred' )
		),
		'prevent_duplicates' => true,
    ) );
}
add_action( 'alfred_init', 'alfred_logs_2_clients', 100 );

/**
 * Link Time Logs to Projects
 *
 * Uses the Posts to Posts plugin.
 *
 * @since Alfred 0.1
 */
function alfred_logs_2_projects() {
	global $alfred;
	
    if ( !function_exists( 'p2p_register_connection_type' ) )
        return;

    p2p_register_connection_type( array( 
        'from' => $alfred->log_post_type,
        'to' => $alfred->project_post_type,
		'title' => array(
			'from' => __( 'Project', 'alfred' )
		),
		'prevent_duplicates' => true,
    ) );
}
add_action( 'alfred_init', 'alfred_logs_2_projects', 100 );

/**
 * Link Time Logs to Tasks
 *
 * Uses the Posts to Posts plugin.
 *
 * @since Alfred 0.1
 */
function alfred_logs_2_tasks() {
	global $alfred;
	
    if ( !function_exists( 'p2p_register_connection_type' ) )
        return;

    p2p_register_connection_type( array( 
        'from' => $alfred->log_post_type,
        'to' => $alfred->task_post_type,
		'title' => array(
			'from' => __( 'Tasks', 'alfred' )
		),
		'prevent_duplicates' => false,
    ) );
}
add_action( 'alfred_init', 'alfred_logs_2_tasks', 100 );
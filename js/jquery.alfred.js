jQuery(document).ready(function($) {
	// Start the Stopwatch.
	$( '#stopwatch-clock' ).stopwatch()
	alfred_stopwatch();
		
	/**
	 * Resume the Stopwatch from it's previous location.
	 */
	function alfred_stopwatch() {
		var stopwatch_end = $( '#_log_duration' ).val();
		if ( stopwatch_end != "" ) {
			stopwatch_end = $( '#_log_duration' ).val().split( ':' );
			
			$( '#stopwatch-clock .display .sec' ).html( stopwatch_end[2] );
			$( '#stopwatch-clock .display .min' ).html( stopwatch_end[1] );
			$( '#stopwatch-clock .display .hr' ).html( stopwatch_end[0] );
		}
		
		$( '#stopwatch-clock .start' ).click(function() {
			alfred_update_stopwatch( 'start' );
		});
		
		$( '#stopwatch-clock .stop' ).click(function() {
			alfred_update_stopwatch( 'end' );
		});
		
		$( '#stopwatch-clock .reset' ).click(function() {
			alfred_update_stopwatch( 'reset' );
		});
	}	
		
	/**
	 * Update the stopwatch when a button is clicked.
	 */
	function alfred_update_stopwatch( update ) {
		data = {
			action	 : 'alfred_stopwatch_update',
			seconds  : $( '#stopwatch-clock .display .sec' ).html(),
			minutes  : $( '#stopwatch-clock .display .min' ).html(),
			hours    : $( '#stopwatch-clock .display .hr' ).html(),
			id		 : $( '#post_ID' ).val(),
			update   : update
		};

		$.post( ajaxurl, data, function( result ) {
			$( '#stopwatch-clock .status' ).show().html( result.message );
			
			if ( update == 'start' ) {
				$( '#stopwatch-clock .status' ).delay( 3000 ).fadeOut();
			}
		}, 'json' );
	}
});
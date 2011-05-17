jQuery(document).ready(function($) {
	$( '#stopwatch-clock' ).stopwatch();
	
	var stopwatch_end = $( '#_log_duration' ).val();
	if ( stopwatch_end != "" ) {
		stopwatch_end = $( '#_log_duration' ).val().split( ':' );
		
		$( '#stopwatch-clock .display .sec' ).html( stopwatch_end[2] );
		$( '#stopwatch-clock .display .min' ).html( stopwatch_end[1] );
		$( '#stopwatch-clock .display .hr' ).html( stopwatch_end[0] );
	}
	
	$( '#stopwatch-clock .start' ).click(function() {
		var data = {
			action	 : 'alfred_stopwatch_update',
			seconds  : $( '#stopwatch-clock .display .sec' ).html(),
			minutes  : $( '#stopwatch-clock .display .min' ).html(),
			hours    : $( '#stopwatch-clock .display .hr' ).html(),
			id		 : $( '#post_ID' ).val(),
			update   : 'start'
		};

		$.post( ajaxurl, data, function( result ) {
			$( '#stopwatch-clock .status' ).html( result.message );
			$( '#stopwatch-clock .status' ).delay( 3000 ).fadeOut();
		}, 'json' );
	});
	
	$( '#stopwatch-clock .stop' ).click(function() {
		var data = {
			action	 : 'alfred_stopwatch_update',
			seconds  : $( '#stopwatch-clock .display .sec' ).html(),
			minutes  : $( '#stopwatch-clock .display .min' ).html(),
			hours    : $( '#stopwatch-clock .display .hr' ).html(),
			id		 : $( '#post_ID' ).val(),
			update   : 'end'
		};

		$.post( ajaxurl, data, function( result ) {
			$( '#stopwatch-clock .status' ).show().html( result.message );
		}, 'json' );
	});
	
	$( '#stopwatch-clock .reset' ).click(function() {
		alert( 'Stopwatch has been reset.' );
	});
});
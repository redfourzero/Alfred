jQuery(document).ready(function($) {
	$( '#stopwatch-clock' ).stopwatch();
	
	$( '#stopwatch-clock .start' ).click(function() {
		var data = {
			action	 : 'alfred_stopwatch_start',
			seconds  : $( '#stopwatch-clock .display .sec' ).html(),
			minutes  : $( '#stopwatch-clock .display .min' ).html(),
			hours    : $( '#stopwatch-clock .display .hr' ).html()
		};

		$.post( ajaxurl, data, function( result ) {
			$( '#stopwatch-clock .status' ).html( result.message );
			$( '#stopwatch-clock .status' ).delay( 3000 ).fadeOut();
		}, 'json' );
	});
	
	$( '#stopwatch-clock .stop' ).click(function() {
		alert( 'Stopwatch has been stopped.' );
	});
	
	$( '#stopwatch-clock .reset' ).click(function() {
		alert( 'Stopwatch has been reset.' );
	});
});
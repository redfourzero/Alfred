jQuery(document).ready(function($) {
	$( '#stopwatch-clock' ).stopwatch();
	
	$( '#stopwatch-clock .start' ).click(function() {
		alert( 'Stopwatch has been started.' );
	});
	
	$( '#stopwatch-clock .stop' ).click(function() {
		alert( 'Stopwatch has been stopped.' );
	});
	
	$( '#stopwatch-clock .reset' ).click(function() {
		alert( 'Stopwatch has been reset.' );
	});
});
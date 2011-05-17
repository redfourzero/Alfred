(function($) {
	jQuery.fn.stopwatch = function() {
		var clock = $(this);
		var timer = 0;
		
		clock.addClass('stopwatch');
		
		// This is bit messy, but IE is a crybaby and must be coddled. 
		clock.html('<div class="display"><span class="hr">00</span>:<span class="min">00</span>:<span class="sec">00</span></div>');
		clock.append('<input type="button" class="button start" value="Start" />');
		clock.append('<input type="button" class="button stop" value="Stop" />');
		clock.append('<input type="button" class="button reset" value="Reset" />');
		
		// We have to do some searching, so we'll do it here, so we only have to do it once.
		var h = clock.find('.hr');
		var m = clock.find('.min');
		var s = clock.find('.sec');
		var start = clock.find('.start');
		var stop = clock.find('.stop');
		var reset = clock.find('.reset')
		
		stop.hide();

		start.bind('click', function() {
			timer = setInterval(do_time, 1000);
			stop.show();
			start.hide();
		});
		
		stop.bind('click', function() {
			clearInterval(timer);
			timer = 0;
			start.show();
			stop.hide();
		});
		
		reset.bind('click', function() {
			clearInterval(timer);
			timer = 0;
			h.html("00");
			m.html("00");
			s.html("00");
			stop.hide();
			start.show();
		});
		
		function do_time() {
			// parseInt() doesn't work here...
			hour = parseFloat(h.text());
			minute = parseFloat(m.text());
			second = parseFloat(s.text());
			
			second++;
			
			if(second > 59) {
				second = 0;
				minute = minute + 1;
			}
			if(minute > 59) {
				minute = 0;
				hour = hour + 1;
			}
			
			h.html("0".substring(hour >= 10) + hour);
			m.html("0".substring(minute >= 10) + minute);
			s.html("0".substring(second >= 10) + second);
		}
	}
})(jQuery);
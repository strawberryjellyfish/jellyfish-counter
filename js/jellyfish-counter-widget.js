// initialize counter instances
jQuery(document).ready(function() {
	jQuery('.jellyfish-counter-widget').each(function() {
		var myOdometer = new Odometer(this);
		myOdometer.init();
	});
});
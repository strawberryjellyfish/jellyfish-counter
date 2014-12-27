// initialize counter instances
var jellyfishCounter = [];
jQuery(document).ready(function() {
	jQuery('.jellyfish-counter').each(function() {
		jQuery(this).data('jellyfishCounter', new JellyfishOdometer(this));
		jQuery(this).data('jellyfishCounter').init();
	});
});
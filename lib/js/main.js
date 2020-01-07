(function($) {


	var binding = {
		read: ['#billing_first_name', '#billing_last_name'],
		write: ['input[value="[billing_first_name]"]', 'input[value="[billing_last_name]"]']
	}
	
	/* Hide titles */
	
	setTimeout(function() {

		var hide_anchor = $('[data-tickera-attendee-hide="true"]');
		hide_anchor.each(function(e) {

			var prev_el = $(this).prev();

			if(prev_el[0].tagName == 'H5') {
				prev_el.hide();
			}

		});

	}, 1000);

	/* Set the hidden field values. */

	setInterval(function() {

		for (var i = 0; i < binding.read.length; i++) {
			var read = binding.read[i];
			var write = binding.write[i];
			if($(read).val().length > 0) {
				$(write).val($(read).val());
			}
			
		}

	}, 200);

	


})(jQuery);
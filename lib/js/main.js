(function($) {


	var binding = {
		read: ['#billing_first_name', '#billing_last_name'],
		write: ['input[value="[billing_first_name]"]', 'input[value="[billing_last_name]"]']
	}
	
	/* Hide titles */
	
	setTimeout(function() {

		var hide_anchor = $('[data-tickera-attendee-hide="true"]');

		if(typeof hide_anchor.length == 'undefined') {
			return;
		}

		hide_anchor.each(function(e) {

			var prev_el = $(this).prev();
			var heading_el = $(this).prev().prev();

			if(prev_el[0].tagName == 'H5') {
				prev_el.hide();
			}

			if(heading_el[0].tagName == 'H2') {
				heading_el.hide();
			}

		});

	}, 1000);

	/* Set the hidden field values. */

	var rwloop = setInterval(function() {

		for (var i = 0; i < binding.read.length; i++) {
			var read = binding.read[i];
			var write = binding.write[i];

			if(typeof $(read).val() == 'undefined') {
				clearInterval(rwloop);
				return;
			} 

			if($(read).val().length > 0) {
				$(write).val($(read).val());
			}
			
		}

	}, 200);

	


})(jQuery);
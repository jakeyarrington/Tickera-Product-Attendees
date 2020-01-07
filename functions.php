<?php
	
	function tpa_hide_product_attendees($product_id) {
		return get_post_meta($product_id, 'hide_tickera_attendee_fields', true );
	}

?>
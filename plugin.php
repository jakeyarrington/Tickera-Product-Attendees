<?php

	/**
	 * Tickera Product Attendees
	 *
	 * @package     Tickera Product Attendees
	 * @author      Tickera Product Attendees
	 * @copyright   2020 Tickera Product Attendees
	 * @license
	 *
	 * @wordpress-plugin
	 * Plugin Name: Tickera Product Attendees
	 * Plugin URI:  https://yarrington.co.uk
	 * Description: Toggle Attendee fields for WooCommerce
	 * Version:     1.0.0
	 * Author:      Yarrington Ltd
	 * Author URI:  https://yarrington.co.uk
	 * Text Domain: tickera-product-attendees
	 * License:
	 * License URI:
	 */


	// ACF
	require 'acf/fields.php';

	// Functions
	require 'functions.php';

	// add_filter('tc_cart_contents', 'tpa_cart_contents', 20);
	add_filter('tc_checkout_owner_info_ticket_title', 'tpa_ticket_title', 20, 4);
	add_action('tc_cart_before_attendee_info_wrap', 'tpa_tickera_set_attendee', 1, 1);
	add_action( 'wp_enqueue_scripts', 'tpa_enqueue_script' );


	function tpa_enqueue_script() {
	    wp_enqueue_script('tpa-main-script', plugin_dir_url(__FILE__) . '/lib/js/main.js', array( 'jquery' ), '1.0', true);
	}

	function tpa_tickera_set_attendee($ticket) {

		$product_id = $ticket->details->ID;

		if(tpa_hide_product_attendees($product_id)) {

			$rand = uniqid();
			echo "<div data-tickera-attendee-hide=\"true\" id=\"uq-{$rand}\"></div><style>#uq-{$rand} ~ div.owner-info-wrap {position: fixed; width: 1px; height: 1px; top: -999999px; left: -999999px}</style>";
			add_filter('tc_input_first_name_field', function() { return '[billing_first_name]'; });
			add_filter('tc_input_last_name_field', function() { return '[billing_last_name]'; });
		}
	}

	function tpa_ticket_title($title, $product_id, $cart_contents, $d) {

		if(tpa_hide_product_attendees($product_id)) {
			return '';
		}

		return $title;
	}

	function tpa_cart_contents($content) {
		
		foreach($content as $index => $item) {

			$hide_fields = tpa_hide_product_attendees($index);

			if($hide_fields) {
				$content[$index] = 0;
			}
		}

		return $content;

	}
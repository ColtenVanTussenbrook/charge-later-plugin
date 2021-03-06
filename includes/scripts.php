<?php

function kite_load_stripe_scripts() {

	global $stripe_options;

	// check to see if we are in test mode
	if(isset($stripe_options['test_mode']) && $stripe_options['test_mode']) {
		$publishable = $stripe_options['test_publishable_key'];
	} else {
		$publishable = $stripe_options['live_publishable_key'];
	}

	wp_enqueue_script('jquery');
	wp_enqueue_script('stripe', 'https://js.stripe.com/v1/');
	wp_enqueue_script('stripe-processing', STRIPE_BASE_URL . 'includes/js/stripe-processing.js');
	wp_localize_script('stripe-processing', 'stripe_vars', array(
			'publishable_key' => $publishable,
		)
	);
// 	wp_enqueue_script('check-input-ajax', STRIPE_BASE_URL . 'includes/js/check-input-ajax.js');
// 	wp_localize_script('check-input-ajax', 'ajaxcall', array(
// 			'ajax_url' => admin_url('admin-ajax.php')
// 		));
}
add_action('wp_enqueue_scripts', 'kite_load_stripe_scripts');

?>
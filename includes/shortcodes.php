<?php
function kite_stripe_payment_form() {
	if(isset($_GET['user-logged-in']) && $_GET['user-logged-in'] == 'yes') {
		echo '<p class="success">Payment has been captured, thank you.</p>';
	}
	elseif(isset($_GET['user-logged-in']) && $_GET['user-logged-in'] == 'no') {
		echo '<p class="success">Payment error, please contact administrator.</p>';
	}
	else {
	?>
		<form action="" method="POST" id="stripe-payment-form">
			<div class="form-row">
				<label><?php _e('First Name', 'kite_stripe'); ?></label><br>
				<input type="text" size="20" autocomplete="off" class="first-name" name="first-name"/>
			</div>
			<div class="form-row">
				<label><?php _e('Last Name', 'kite_stripe'); ?></label><br>
				<input type="text" size="20" autocomplete="off" class="last-name" name="last-name"/>
			</div>
			<div class="form-row">
				<label><?php _e('Email', 'kite_stripe'); ?></label><br>
				<input type="text" size="20" autocomplete="off" class="user-email" name="user-email"/>
			</div>
			<div class="form-row">
				<label><?php _e('Card Number', 'kite_stripe'); ?></label><br>
				<input type="text" size="20" autocomplete="off" class="card-number"/>
			</div>
			<div class="form-row">
				<label><?php _e('CVC', 'kite_stripe'); ?></label><br>
				<input type="text" size="4" autocomplete="off" class="card-cvc"/>
			</div>
			<div class="form-row">
				<label><?php _e('Expiration (MM/YYYY)', 'kite_stripe'); ?></label><br>
				<input type="text" size="2" class="card-expiry-month"/>
				<span> / </span>
				<input type="text" size="4" class="card-expiry-year"/>
			</div>
			<input type="hidden" name="action" value="stripe"/>
			<input type="hidden" name="redirect" value="<?php echo get_permalink(); ?>"/>
			<input type="hidden" name="stripe_nonce" value="<?php echo wp_create_nonce('stripe-nonce'); ?>"/>
			<button type="submit" id="stripe-submit"><?php _e('Go To Schedule Appointment', 'kite_stripe'); ?></button>
		</form>
		<?php
	}
}

	add_shortcode('charge_form', 'kite_stripe_payment_form');

?>

<?php

add_action( 'admin_post_charge_customer_data', 'charge_customer_data');
add_action( 'admin_post_nopriv_charge_customer_data', 'charge_customer_data');

function charge_customer_data() {
  if (isset($_POST['charge_submit'])){
   global $stripe_options;
   $success_url = get_site_url() . "/wp-admin/admin.php?page=charge-successful";
   $unsuccessful_url = get_site_url() . "/wp-admin/admin.php?page=charge-unsuccessful";
   $customer_id_input = $_POST['charge_customer_input'];

   // get Stripe library from Composer
   require_once( plugin_dir_path(__FILE__) . 'vendor/autoload.php');

   // check if we are using test mode
   if(isset($stripe_options['test_mode']) && $stripe_options['test_mode']) {
     $secret_key = $stripe_options['test_secret_key'];
   } else {
     $secret_key = $stripe_options['live_secret_key'];
   }

   //get amount to charge
   $charge_amount = $stripe_options['amount_to_charge'];
   $charge_amount *= 100;

   try {
     \Stripe\Stripe::setApiKey($secret_key);

     $charge = \Stripe\Charge::create([
       'amount' => $charge_amount,
       'currency' => 'usd',
       'customer' => $customer_id_input,
     ]);

     wp_redirect($success_url);
     exit();
}

   catch (Exception $e) {
     // redirect on failed payment
     wp_redirect($unsuccessful_url);
     exit();
   }
 }
}

function payment_succesful_notice() {
  ?>
    <div class="updated notice">
        <p><?php _e( 'Payment was succesful', 'my_plugin_textdomain' ); ?></p>
    </div>
<?php
}

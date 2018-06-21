<?php
function add_charge_successful_message () {
  add_submenu_page( NULL, 'Charge Successful', 'Charge Successful', 'manage_options', 'charge-successful', 'charge_successful_message');
}
add_action( 'admin_menu', 'add_charge_successful_message');

function add_charge_unsuccessful_message () {
  add_submenu_page( NULL, 'Charge Failed', 'Charge Failed', 'manage_options', 'charge-unsuccessful', 'charge_unsuccessful_message');
}
add_action( 'admin_menu', 'add_charge_unsuccessful_message');


function charge_successful_message () {
  ?>
  <div class="charge-successful-message" style="margin-top: 50px;">
    <h2>Charge Successful</h2>
    <p>Your charge was successful! Check your <a href="https://stripe.com" target="_blank">Stripe</a> dashboard for payment details or return to the <a href="/wp-admin/admin.php?page=user-list-table.php">Client List</a> to make another charge.</p>
  </div>
  <?php
}

function charge_unsuccessful_message () {
  ?>
  <div class="charge-successful-message" style="margin-top: 50px;">
    <h2>Charge Failed</h2>
    <p>Your charge was not processed. Please try again or contact the plugin author, <a href="https://kitemedia.com" target="_blank">Kite Media.</a></p>
  </div>
  <?php
}
?>
<?php
/*
Plugin Name: Kite Media Charge Later Plugin
Plugin URI:  kitemedia.com/plugins
Description: Captures a user's cc info using Stripe, then allows the business owner to make a charge later on
Version:     1.0
Author:      Colten Van Tussenbrook
Author URI:  coltenv.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/

if(!defined('STRIPE_BASE_URL')) {
	define('STRIPE_BASE_URL', plugin_dir_url(__FILE__));
}
if(!defined('STRIPE_BASE_DIR')) {
	define('STRIPE_BASE_DIR', dirname(__FILE__));
}

$stripe_options = get_option('stripe_settings');

if(is_admin()) {
	include(STRIPE_BASE_DIR . '/admin/admin-settings.php');
	include(STRIPE_BASE_DIR . '/admin/user-list-table.php');
	include(STRIPE_BASE_DIR . '/admin/charge-successful.php');
}
	else {
		include(STRIPE_BASE_DIR . '/includes/scripts.php');
		include(STRIPE_BASE_DIR . '/includes/shortcodes.php');
		include(STRIPE_BASE_DIR . '/includes/capture-payment.php');
	}

	include(STRIPE_BASE_DIR . '/includes/functions.php');

//create mysql database table on activation

function mysql_chargelater_table(){
  global $wpdb;
  $charge_later_table = $wpdb->prefix . 'chargelater';

  //check if table exists, if it doesn't create the new table
  if($wpdb->get_var("SHOW TABLES LIKE '$charge_later_table'") != $charge_later_table) {
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $charge_later_table (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        first_name VARCHAR(30) NOT NULL,
        last_name VARCHAR(30) NOT NULL,
        email  VARCHAR(70) NOT NULL,
        customer_id  VARCHAR(70) NOT NULL,
				password VARCHAR(70) NOT NULL
      ) $charset_collate;";

      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    }
}
register_activation_hook( __FILE__, 'mysql_chargelater_table' );
?>

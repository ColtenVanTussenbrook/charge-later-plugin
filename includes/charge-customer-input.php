<?php

function display_charge_customer_input() {
  global $stripe_options;
  $charge_amount_btn = "Charge $" . $stripe_options['amount_to_charge'];

    ?>
    <h3 class="title"><?php _e('Charge Customer', 'kite_stripe'); ?></h3>
      <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <input type="hidden" name="action" value="charge_customer_data"/>
          <table class="form-table">
            <tbody>
              <tr valign="top">
                <th scope="row" valign="top">
                  <?php _e('Charge Customer', 'kite_stripe'); ?>
                </th>
                <td>
                  <input id="charge_customer_input" name="charge_customer_input" type="text" class="regular-text" value="Customer Id"/>
                  <label class="description" for="charge_customer_input"><?php _e('Paste the customer id of the person you\'d like to charge.', 'kite_stripe'); ?></label>
                </td>
              </tr>
            </tbody>
          </table>
          <p class="submit_charge">
            <input type="submit" class="button-primary" name="charge_submit" value="<?php _e($charge_amount_btn, 'kite_domain') ?>" />
          </p>
      </form>
    <?php
}
?>
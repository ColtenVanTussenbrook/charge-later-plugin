<?php

if (is_admin()) {
  new Kite_WP_List_Table();
}

class Kite_WP_List_Table {
  public function __construct() {
    add_action ('admin_menu', array($this, 'add_menu_list_table_page'));
  }

  public function add_menu_list_table_page () {
    add_submenu_page( 'stripe-settings', 'List of Clients', 'List of Clients', 'manage_options', 'user-list-table.php', array($this, 'list_table_page'));
  }

  /**
  *Display the list table page
  *
  * @return Void
  */

  public function list_table_page() {
    $kiteListTable = new Kite_List_Table();
    $kiteListTable ->prepare_items();

    ?>
      <div class="wrap">
        <div id="icon-users" class="icon32"></div>
        <h2>Clients Page</h2>
        <?php $kiteListTable ->display(); ?>
      </div>
      <?php

    require_once(STRIPE_BASE_DIR . '/includes/charge-customer-input.php' );
    display_charge_customer_input();
  }
}

  if (! class_exists( 'WP_List_Table')) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
  }

class Kite_List_Table extends WP_List_Table {

 /**
 * Prepare the items for the table to process
 *
 * @return Void
 */

  public function prepare_items() {
      global $stripe_options;

      $columns = $this->get_columns();
      $hidden = $this->get_hidden_columns();
      $sortable = $this->get_sortable_columns();

      $data = $this->get_table_data();
      usort( $data, array( &$this, 'sort_data' ) );

      $perPage = 25;
      $currentPage = $this->get_pagenum();
      $totalItems = count($data);

      $this->set_pagination_args( array(
          'total_items' => $totalItems,
          'per_page'    => $perPage
      ) );
      $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

      $this->_column_headers = array($columns, $hidden, $sortable);
      $this->items = $data;
  }

  /**
    * Override the parent columns method. Defines the columns to use in your listing table
    *
    * @return Array
    */

   public function get_columns()
   {
       $columns = array(
           'id'          => 'ID',
           'first_name'  => 'First Name',
           'last_name'   => 'Last Name',
           'email'       => 'Email',
           'customer_id' => 'Customer Id'
       );
       return $columns;
   }
   /**
    * Define which columns are hidden
    *
    * @return Array
    */
   public function get_hidden_columns()
   {
       $hide_columns = array(
         'customer_id' => 'Customer Id'
       );
       return $hide_columns;
   }
   /**
    * Define the sortable columns
    *
    * @return Array
    */
   public function get_sortable_columns()
   {
       return array(
         'first_name' => array('first_name', false),
         'last_name'  => array('last_name', false),
         'email'      => array('email', false)
     );
   }

   /**
   * Pull data from chargelater database table
   *
   * @return Array
   */

   private function get_table_data() {
     global $wpdb;

     $table_name = $wpdb->prefix . 'chargelater';
     $data_results = $wpdb->get_results( "SELECT * FROM $table_name");
     $updated_data = array();

     foreach ($data_results as $row) {
       $updated_data[] = array(
         'id'          => $row->id,
         'first_name'  => $row->first_name,
         'last_name'   => $row->last_name,
         'email'       => $row->email,
         'customer_id' => $row->customer_id
       );
     }

     return $updated_data;
   }

   /*
   * defines which data so show
   *
   * @param Array $item  Data
   * @param String $column_name - Current column name
   *
   * @return Mixed
   */

   public function column_default($item, $column_name) {
     switch ( $column_name ) {
       case 'id':
       case 'first_name':
       case 'last_name':
       case 'email':
       case 'customer_id':
        return $item[ $column_name ];

      default:
        return print_r($item, true);
     }
   }

   /**
   * Allows you to sort the data by the variables set in the $_GET
   *
   * @return Mixed
   */

   private function sort_data($a, $b) {
     //set defaults
     $orderby = 'last_name';
     $order = 'asc';

     if (!empty($_GET['orderby'])){
       $orderby = $_GET['orderby'];
     }

     if (!empty($_GET['order'])) {
       $order = $_GET['order'];
     }

     $result = strcmp( $a[$orderby], $b[$orderby] );

     if($order === 'asc') {
       return $result;
     }

     return -$result;
   }
}
?>
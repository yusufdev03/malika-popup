<?php

// WP_List_Table is not loaded automatically so we need to load it in our application
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
/**
 * Create a new table class that will extend the WP_List_Table
 */
class Example_List_Table extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $data = $this->table_data();
        usort( $data, array( &$this, 'sort_data' ) );
        $perPage = 10;
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
            'kode'        => 'Kode',
            'status'      => 'Status',
            'expire'      => 'Expired',
            'email'       => 'Email',
            'delete'      => 'Delete'
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
        return array();
    }
    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('id' => array('id', false));
    }
    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
        $data = array();
		
		$id_post = get_page_by_title( 'register-email',OBJECT,'malika_user_coupon');
		$data_reg = get_post_meta($id_post->ID);
		
		foreach($data_reg as $key => $email){
			$code = explode('mcp_',$key);
			
			$coupon = wc_get_coupon_id_by_code($code[1]);
			$coupon = new WC_Coupon($coupon);
			$expired = "";
			$status = "sudah dihapus";
			
			if($coupon->get_id()){
				$expired = date_format($coupon->get_date_expires(),"d-m-Y");
				
				$status = $coupon->get_usage_count() > 0 ? "sudah digunakan" : "belum digunakan";
				$status = strtotime(date("Y-m-d")) > strtotime($expired) ? "kadaluwarsa" : $status;
				
				if($status=="kadaluwarsa"){
					wp_delete_post($coupon->get_id());
					$status = "sudah dihapus";
				}
			}
			
			$data[] = array(
                    'id'          => $coupon->get_id(),
                    'kode'        => $code[1],
                    'status'      => $status,
                    'expire'      => $expired,
                    'email'       => $email[0],
                    'delete'      => '<a href="#" onclick="mcp_callBack(this,'.$coupon->get_id().')">hapus</a>'
                    );
		}
		
		return $data;
    }
    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'kode':
            case 'status':
            case 'expire':
            case 'email':
            case 'delete':
                return $item[ $column_name ];
            default:
                return print_r( $item, true ) ;
        }
    }
    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'id';
        $order = 'asc';
        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }
        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }
        $result = strcmp( $a[$orderby], $b[$orderby] );
        if($order === 'asc')
        {
            return $result;
        }
        return -$result;
    }
}
?>
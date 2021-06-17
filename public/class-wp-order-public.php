<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/agusnurwanto
 * @since      1.0.0
 *
 * @package    Wp_Order
 * @subpackage Wp_Order/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Order
 * @subpackage Wp_Order/public
 * @author     Agus Nurwanto <agusnurwantomuslim@gmail.com>
 */
class Wp_Order_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Order_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Order_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-dataTables', plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-order-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Order_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Order_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-dataTables', plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-order-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'custom_script', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}

	function dasboard_order() {
		// untuk disable render shortcode di halaman edit page/post
		if(!empty($_GET) && !empty($_GET['post'])){
			return '';
		}
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/wp-order-public-display.php';
	}

	function get_order(){
		global $wpdb;
		$ret = array(
			"draw" => $_POST['draw'],
		  	"recordsTotal" => 0,
		  	"recordsFiltered" => 0,
		  	"data" => array()
		);
		$order_by = '';
		if(!empty($_POST['order'][0]['column'])){
			if($_POST['order'][0]['column'] == 2){
				$order_by = 'order by created_date '.$_POST['order'][0]['dir'];
			}else if($_POST['order'][0]['column'] == 3){
				$order_by = 'order by customer '.$_POST['order'][0]['dir'];
			}
		}
		$search = array();
		if(!empty($_POST['search']['value'])){
			$val_search = '%'.$_POST['search']['value'].'%';
			$search[] = $wpdb->prepare('invoice_number like \'%s\' or customer like \'%s\'', $val_search, $val_search);
		}
		if(!empty($_POST['filter']) && $_POST['filter']!='All'){
			$search[] = $wpdb->prepare('payment_status = \'%s\'', $_POST['filter']);
		}
		$search = implode(' and ', $search);
		if(!empty($search)){
			$search = 'where '.$search;
		}

		$data = $wpdb->get_results('select * from data_order '.$search.' '.$order_by, ARRAY_A);
		$ret['sql'] = $wpdb->last_query;
		foreach ($data as $k => $v) {
			$v['no'] = $k+1;
			$ret['data'][] = $v;
		}
		die(json_encode($ret));
	}

	function create_order(){
		global $wpdb;
		$ret = array(
			'status' => 'success',
			'msg' => 'Success create order!'
		);
		if(!empty($_POST)){
			$invoice_number = '';
			if(!empty($_POST['invoice_number'])){
				$invoice_number = $_POST['invoice_number'];
			}else{
				$ret['status'] = 'error';
				$ret['msg'] = 'Invoice Number is required!';
			}
			if($ret['status'] != 'error'){
				$created_date = '';
				if(!empty($_POST['created_date'])){
					$created_date = $_POST['created_date'];
					$created_date = date('Y-m-d H:i:s', strtotime($created_date));
				}else{
					$ret['status'] = 'error';
					$ret['msg'] = 'Created Date is required!';
				}
			}
			if($ret['status'] != 'error'){
				$customer = '';
				if(!empty($_POST['customer'])){
					$customer = $_POST['customer'];
				}else{
					$ret['status'] = 'error';
					$ret['msg'] = 'Customer is required!';
				}
			}
			if($ret['status'] != 'error'){
				$total_amount = '';
				if(!empty($_POST['total_amount'])){
					$total_amount = $_POST['total_amount'];
				}else{
					$ret['status'] = 'error';
					$ret['msg'] = 'Total Amount is required!';
				}
			}
			if($ret['status'] != 'error'){
				$payment_status = '';
				if(!empty($_POST['payment_status'])){
					$payment_status = $_POST['payment_status'];
				}else{
					$ret['status'] = 'error';
					$ret['msg'] = 'Payment Status is required!';
				}
			}
			if($ret['status'] != 'error'){
				$fulfillment_status = '';
				if(!empty($_POST['fulfillment_status'])){
					$fulfillment_status = $_POST['fulfillment_status'];
				}else{
					$ret['status'] = 'error';
					$ret['msg'] = 'Fulfillment Status is required!';
				}
			}
			if($ret['status'] != 'error'){
				$wpdb->query($wpdb->prepare('
					INSERT INTO data_order 
						(invoice_number, created_date, customer, payment_status, fulfillment_status, total_amount) 
					VALUES 
						(%s, %s, %s, %s, %s, %d)', 
					$invoice_number, $created_date, $customer, $payment_status, $fulfillment_status, $total_amount
				));
			}
		}else{
			$ret['status'] = 'error';
			$ret['msg'] = 'Type request tidak dikenali!';
		}
		die(json_encode($ret));
	}

}

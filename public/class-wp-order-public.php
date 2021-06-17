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
		$data = $wpdb->get_results('select * from data_order', ARRAY_A);
		foreach ($data as $k => $v) {
			$v['no'] = $k+1;
			$ret['data'][] = $v;
		}
		die(json_encode($ret));
	}

}

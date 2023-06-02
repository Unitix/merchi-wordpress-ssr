<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://graspcorn.com
 * @since      1.0.0
 *
 * @package    Merchi_Integration
 * @subpackage Merchi_Integration/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Merchi_Integration
 * @subpackage Merchi_Integration/public
 * @author     Graspcorn <contact@graspcorn.com>
 */
class Merchi_Integration_Public {

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
		 * defined in Merchi_Integration_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Merchi_Integration_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/merchi-integration-public.css', array(), $this->version, 'all' );

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
		 * defined in Merchi_Integration_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Merchi_Integration_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/merchi-integration-public.js', array( 'jquery' ), $this->version, false );

	}

	
	/**
	 * public api call in head section.
	 *
	 * @since    1.0.0
	 */

	 public function get_api_data_by_id() { 
	 
		 $sync_keys = array(
				'redirect_after_success_url' => 'redirectAfterSuccessUrl',
				'redirect_after_quote_success_url' => 'redirectAfterQuoteSuccessUrl',
				'redirect_with_value' => 'redirectWithValue',
				'hide_info' => 'hideInfo',
				'hide_preview' => 'hidePreview',
				'hide_price' => 'hidePrice',
				'hide_title' => 'hideTitle',
				'hide_calculated_price' => 'hideCalculatedPrice',
				'include_bootstrap' => 'includeBootstrap',
				'not_include_default_css' => 'notIncludeDefaultCss',
				'invoice_redirect' => 'invoiceRedirect',
				'load_theme' => 'loadTheme',
				'mount_point_id' => 'mountPointId',
				'single_column' => 'singleColumn',
				'quote_requested_redirect' => 'quoteRequestedRedirect',
				'google_api_public_key' => 'googleApiPublicKey',
				'allow_add_to_cart' => 'allowAddToCart',
				'hide_drafting' => 'hideDrafting',
			);
		
		$atts = array(
			'id' => get_post_meta(get_the_ID(), 'merchi_id', true),
			'redirect_after_success_url' => get_post_meta(get_the_ID(), 'redirectAfterSuccessUrl', true),
			'redirect_after_quote_success_url' => get_post_meta(get_the_ID(), 'redirectAfterQuoteSuccessUrl', true),
			'redirect_with_value' => get_post_meta(get_the_ID(), 'redirectWithValue', true),
			'hide_info' => get_post_meta(get_the_ID(), 'hideInfo', true),
			'hide_preview' => get_post_meta(get_the_ID(), 'hidePreview', true),
			'hide_price' =>  get_post_meta(get_the_ID(), 'hidePrice', true),
			'hide_title' => get_post_meta(get_the_ID(), 'hideTitle', true),
			'hide_calculated_price' => get_post_meta(get_the_ID(), 'hideCalculatedPrice', true),
			'include_bootstrap' => get_post_meta(get_the_ID(), 'includeBootstrap', true),
			'not_include_default_css' => get_post_meta(get_the_ID(), 'notIncludeDefaultCss', true),
			'invoice_redirect' => get_post_meta(get_the_ID(), 'invoiceRedirect', true),
			'load_theme' => get_post_meta(get_the_ID(), 'loadTheme', true),
			'mount_point_id' => get_post_meta(get_the_ID(), 'mountPointId', true),
			'single_column' => get_post_meta(get_the_ID(), 'singleColumn', true),
			'quote_requested_redirect' => get_post_meta(get_the_ID(), 'quoteRequestedRedirect', true),
			'google_api_public_key' => get_post_meta(get_the_ID(), 'googleApiPublicKey', true),
			'allow_add_to_cart' => get_post_meta(get_the_ID(), 'allowAddToCart', true),
			'hide_drafting' => get_post_meta(get_the_ID(), 'hideDrafting', true),
		);
		
		$endpoint ='https://api.merchi.co/v6/components/ProductEmbed/server_side_render/?apiKey=EAfBSrJah305GCk0__gn_Lp5X3kgHoaB8pLIbnqpTnbmgzXR4TBNuTLM4hKkKzVOpXR10B_zvLqt-I822-8QQQ&product='.$atts['id'].'&as_bundle=true';
		foreach( $atts as $key => $atr ){
			if( "id" == $key ) continue;
			if( "" == $atr || !$atr ) continue;
			$endpoint .='&'.$sync_keys[$key]."=".$atr;
		}
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $endpoint,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"content-type: application/json",
			"postman-token: 7aeeff95-e3de-9ccb-c2eb-297778203fff"
		),
		));
	
		$response = curl_exec($curl);
		$err = curl_error($curl);
	
		curl_close($curl);
	
		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		//echo $response;
		$post_id = get_the_ID(); 
		//var_dump($post_id);
		$my_html_code = $response;
		update_post_meta( $post_id, 'my_html_field', $my_html_code ); 
		}
	}


	/**
	 * public showing product before add to  cart button.
	 *
	 * @since    1.0.0
	 */

	// public function woocommerce_before_add_to_cart(){
	// 	$product_item = get_post_meta(get_the_ID(), 'my_html_field', true);
	// 	echo $product_item ;
	// }

	/**
	 * for remove action  from woo single product.
	 *
	 * @since    1.0.0
	 */

	public function remove_woocommerce_before_main_content() {
		$merchi_id = get_post_meta( get_the_ID(), 'merchi_id', true );
		if( !$merchi_id ){
			return;
		}
		$option_value = get_option('mpp_location');
		if ($option_value == 0) {
			remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
		}
	  
	}


	/**
	 * for showing single product with woo.
	 *
	 * @since    1.0.0
	 */


	public  function woocommerce_before_add_to_cart(){
		$merchi_id = get_post_meta( get_the_ID(), 'merchi_id', true );
		if( !$merchi_id ){
			return;
		}
		$option_value = get_option('mpp_location');
		if ( $option_value == 0) {
		$p_id =  get_the_ID();
		$product_item = get_post_meta($p_id, 'my_html_field', true);
		echo $product_item ;
		}
	}

	/**
	* for showing single product withought woo.
	*
	* @since    1.0.0
	*/

    public function update_template($content){
		$merchi_id = get_post_meta( get_the_ID(), 'merchi_id', true );
		if( !$merchi_id ){
			return $content;
		}
		$option_value = get_option('mpp_location');
		if ( $option_value == 1 && get_post_type(get_the_ID()) == 'merchi-product' ) {
			$p_id =  get_the_ID();
			$product_item = get_post_meta($p_id, 'my_html_field', true);
			if($product_item){
				$content = $product_item."<br/>".$content;
			}

		}
			return $content;
	}

	/**
	* for remove title from single product screen withought woo screen.
	*
	* @since    1.0.0
	*/


	function remove_title( $title ) {
		if ( is_single() ) { // Remove title on single post pages
			$title = '';
		}
		return $title;
	}
	
	
	public function merchi_product_shortcode($atrs) { 
		$curl = curl_init();
		if(empty($atrs['id'])){
			return 'Please provide a Merchi product id';
		}
		$sync_keys = array(
			'redirect_after_success_url' => 'redirectAfterSuccessUrl',
			'redirect_after_quote_success_url' => 'redirectAfterQuoteSuccessUrl',
			'redirect_with_value' => 'redirectWithValue',
			'hide_info' => 'hideInfo',
			'hide_preview' => 'hidePreview',
			'hide_price' => 'hidePrice',
			'hide_title' => 'hideTitle',
			'hide_calculated_price' => 'hideCalculatedPrice',
			'include_bootstrap' => 'includeBootstrap',
			'not_include_default_css' => 'notIncludeDefaultCss',
			'invoice_redirect' => 'invoiceRedirect',
			'load_theme' => 'loadTheme',
			'mount_point_id' => 'mountPointId',
			'single_column' => 'singleColumn',
			'quote_requested_redirect' => 'quoteRequestedRedirect',
			'google_api_public_key' => 'googleApiPublicKey',
			'allow_add_to_cart' => 'allowAddToCart',
			'hide_drafting' => 'hideDrafting',
		);
		$atts = shortcode_atts(array(
			'id' => '',
			'redirect_after_success_url' => '',
			'redirect_after_quote_success_url' => '',
			'redirect_with_value' => true,
			'hide_info' => false,
			'hide_preview' => false,
			'hide_price' =>  false,
			'hide_title' => false,
			'hide_calculated_price' => false,
			'include_bootstrap' => false,
			'not_include_default_css' => false,
			'invoice_redirect' => false,
			'load_theme' => false,
			'mount_point_id' => '',
			'single_column' => false,
			'quote_requested_redirect' => false,
			'google_api_public_key' => '',
			'allow_add_to_cart' => true,
			'hide_drafting' => true,
		), $atrs);
		$endpoint ='https://api.merchi.co/v6/components/ProductEmbed/server_side_render/?apiKey=EAfBSrJah305GCk0__gn_Lp5X3kgHoaB8pLIbnqpTnbmgzXR4TBNuTLM4hKkKzVOpXR10B_zvLqt-I822-8QQQ&product='.$atts['id'].'&as_bundle=true';
		foreach( $atts as $key => $atr ){
			if( "id" == $key ) continue;
			if( "" == $atr || !$atr ) continue;
			$endpoint .='&'.$sync_keys[$key]."=".$atr;
		}
		//$endpoint = esc_url($endpoint);
		//echo $endpoint;
		curl_setopt_array($curl, array(
			CURLOPT_URL => $endpoint,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'cache-control: no-cache',
				'content-type: application/json',
				'postman-token: 7aeeff95-e3de-9ccb-c2eb-297778203fff'
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			return 'cURL Error: ' . $err;
		} else {
			return $response;
		}
	}

}

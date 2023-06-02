<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://graspcorn.com
 * @since      1.0.0
 *
 * @package    Merchi_Integration
 * @subpackage Merchi_Integration/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Merchi_Integration
 * @subpackage Merchi_Integration/admin
 * @author     Graspcorn <contact@graspcorn.com>
 */
class Merchi_Integration_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('admin_menu','my_plugin_add_settings_page');
        add_action('admin_init','settings');

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/merchi-integration-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/merchi-integration-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Admin setting menu for product meta box.
	 *
	 * @since    1.0.0
	 */

	public function my_custom_meta_box(){
		$option_value = get_option('mpp_location');
		if ( $option_value == 0) {
		add_meta_box( 'metaId', 'Custom Meta Box', 'my_metaBox_HTML', 'product', 'side', 'high');
	 }
	}

	/**
	 * Admin setting menu for custom product meta box.
	 *
	 * @since    1.0.0
	 */

	public function my_custom_meta_box_withought_woo(){
		$option_value = get_option('mpp_location');
		if ( $option_value == 1) {
		add_meta_box('metaId', 'Custom Meta Box', 'my_metaBox_HTML', 'merchi-product', 'side', 'high');
	}
	}

	/**
	 * Admin setting menu for upadate_post_meta  ID.
	 *
	 * @since    1.0.0
	 */

	public function save_meta_box_value($post_id, $post){
		if(isset($_POST['merchi_id'])) {
		update_post_meta($post_id, 'merchi_id', $_POST['merchi_id']);
		update_post_meta($post_id, 'redirectAfterSuccessUrl', $_POST['redirectAfterSuccessUrl']);
		update_post_meta($post_id, 'redirectAfterQuoteSuccessUrl', $_POST['redirectAfterQuoteSuccessUrl']);
		update_post_meta($post_id, 'redirectWithValue', $_POST['redirectWithValue']);
		update_post_meta($post_id, 'hideInfo', $_POST['hideInfo']);
		update_post_meta($post_id, 'hidePreview', $_POST['hidePreview']);
		update_post_meta($post_id, 'hidePrice', $_POST['hidePrice']);
		update_post_meta($post_id, 'hideTitle', $_POST['hideTitle']);
		update_post_meta($post_id, 'hideCalculatedPrice', $_POST['hideCalculatedPrice']);
		update_post_meta($post_id, 'includeBootstrap', $_POST['includeBootstrap']);
		update_post_meta($post_id, 'notIncludeDefaultCss', $_POST['notIncludeDefaultCss']);
		update_post_meta($post_id, 'invoiceRedirect', $_POST['invoiceRedirect']);
		update_post_meta($post_id, 'loadTheme', $_POST['loadTheme']);
		update_post_meta($post_id, 'mountPointId', $_POST['mountPointId']);
		update_post_meta($post_id, 'singleColumn', $_POST['singleColumn']);
		update_post_meta($post_id, 'quoteRequestedRedirect', $_POST['quoteRequestedRedirect']);
		update_post_meta($post_id, 'googleApiPublicKey', $_POST['googleApiPublicKey']);
		update_post_meta($post_id, 'allowAddToCart', $_POST['allowAddToCart']);
		update_post_meta($post_id, 'hideDrafting', $_POST['hideDrafting']);
	  }
	}
	
	/**
	 * Admin setting menu for get product on cart screen.
	 *
	 * @since    1.0.0
	 */


	/**
	 * Admin  menu for custom post type.
	 *
	 * @since    1.0.0
	 */


	public function my_post_type_product() {
		$post_type = 'merchi-product';
		// var_dump($post_type);
		if(!post_type_exists($post_type)){
		$labels = array(
			'name'                  => _x( 'merchi-product', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Merchi Products', 'text_domain' ),
			'name_admin_bar'        => __( 'Product', 'text_domain' ),
			'archives'              => __( 'Product Archives', 'text_domain' ),
			'attributes'            => __( 'Product Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Product:', 'text_domain' ),
			'all_items'             => __( 'All Products', 'text_domain' ),
			'add_new_item'          => __( 'Add New Product', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Product', 'text_domain' ),
			'edit_item'             => __( 'Edit Product', 'text_domain' ),
			'update_item'           => __( 'Update Product', 'text_domain' ),
			'view_item'             => __( 'View Product', 'text_domain' ),
			'view_items'            => __( 'View Products', 'text_domain' ),
			'search_items'          => __( 'Search Product', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into Product', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Product', 'text_domain' ),
			'items_list'            => __( 'Products list', 'text_domain' ),
			'items_list_navigation' => __( 'Products list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter Products list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Product', 'text_domain' ),
			'description'           => __( 'Custom post type for products', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-cart',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'rewrite'               => array( 'slug' => 'merchi-product'),
		);
		register_post_type($post_type, $args);
	       }else{
		    add_settings_error( 'my_plugin_settings', 'woocommerce_not_active', 'alredy exist', 'error' );
	     }
    }

     /**
	 *  for check woocommerce install or not.
	 *
	 * @since    1.0.0
	 */

    public function my_plugin_save_settings() {
	    if ( isset( $_POST['submit'] ) ) {
		   if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			// add_settings_error( 'my_plugin_settings', 'woocommerce_not_active', 'WooCommerce plugin is active', 'error' );
		} else {
			add_settings_error( 'my_plugin_settings', 'woocommerce_not_active', 'WooCommerce plugin is not active', 'error' );
		}
	  }
    }

}



// add_action('add_meta_boxes', 'my_custom_meta_box');

function my_metaBox_HTML(){ 
	$merchi_id = get_post_meta(get_the_ID(), 'merchi_id', true);
	$redirectAfterSuccessUrl = get_post_meta(get_the_ID(), 'redirectAfterSuccessUrl', true);
	$redirectAfterQuoteSuccessUrl = get_post_meta(get_the_ID(), 'redirectAfterQuoteSuccessUrl', true);
	$redirectWithValue = get_post_meta(get_the_ID(), 'redirectWithValue', true);
	$hideInfo = get_post_meta(get_the_ID(), 'hideInfo', true);
	$hidePreview = get_post_meta(get_the_ID(), 'hidePreview', true);
	$hidePrice = get_post_meta(get_the_ID(), 'hidePrice', true);
	$hideTitle = get_post_meta(get_the_ID(), 'hideTitle', true);
	$hideCalculatedPrice = get_post_meta(get_the_ID(), 'hideCalculatedPrice', true);
	$includeBootstrap = get_post_meta(get_the_ID(), 'includeBootstrap', true);
	$notIncludeDefaultCss = get_post_meta(get_the_ID(), 'notIncludeDefaultCss', true);
	$invoiceRedirect = get_post_meta(get_the_ID(), 'invoiceRedirect', true);
	$loadTheme = get_post_meta(get_the_ID(), 'loadTheme', true);
	$mountPointId = get_post_meta(get_the_ID(), 'mountPointId', true);
	$singleColumn = get_post_meta(get_the_ID(), 'singleColumn', true);
	$quoteRequestedRedirect = get_post_meta(get_the_ID(), 'quoteRequestedRedirect', true);
	$googleApiPublicKey = get_post_meta(get_the_ID(), 'googleApiPublicKey', true);
	$allowAddToCart = get_post_meta(get_the_ID(), 'allowAddToCart', true);
	$hideDrafting = get_post_meta(get_the_ID(), 'hideDrafting', true);
	?>
      <div class="card-header">Merchi Product ID</div>
       <div class="card-body text-dark">
        <input type="text" id="merchi_id" name="merchi_id" placeholder="Merchi Id" value="<?php echo $merchi_id; ?>">
      </div>
	  <div class="card-header">Redirect After Success URL</div>
	  <div class="card-body text-dark">
        <input type="text" id="redirectAfterSuccessUrl" name="redirectAfterSuccessUrl" placeholder="Redirect URL" value="<?php echo $redirectAfterSuccessUrl; ?>">
      </div>
	  <div class="card-header">Redirect After Quote URL</div>
	  <div class="card-body text-dark">
        <input type="text" id="redirectAfterQuoteSuccessUrl" name="redirectAfterQuoteSuccessUrl" placeholder="Redirect Quote URL" value="<?php echo $redirectAfterQuoteSuccessUrl; ?>">
      </div>
	  <div class="card-header">Redirect With Value </div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="redirectWithValue" name="redirectWithValue" <?php checked( $redirectWithValue, 1, true );?> value="1">
      </div>
	  <div class="card-header">Hide Info</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="hideInfo" name="hideInfo" <?php checked( $hideInfo, 1, true );?> value="1">
      </div>
	  <div class="card-header">Hide Preview</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="hidePreview" name="hidePreview" <?php checked( $hidePreview, 1, true );?> value="1">
      </div>
	  <div class="card-header">Hide Price</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="hidePrice" name="hidePrice" <?php checked( $hidePrice, 1, true );?> value="1">
      </div>
	  <div class="card-header">Hide Title</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="hideTitle" name="hideTitle" <?php checked( $hideTitle, 1, true );?> value="1">
      </div>
	  <div class="card-header">Hide Calculated Price</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="hideCalculatedPrice" name="hideCalculatedPrice" <?php checked( $hideCalculatedPrice, 1, true );?> value="1">
      </div>
	  <div class="card-header">Include Bootstrap</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="includeBootstrap" name="includeBootstrap" <?php checked( $includeBootstrap, 1, true );?> value="1">
      </div>
	  <div class="card-header">Not Include Default CSS</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="notIncludeDefaultCss" name="notIncludeDefaultCss" <?php checked( $notIncludeDefaultCss, 1, true );?> value="1">
      </div>
	  <div class="card-header">Invoice Redirect</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="invoiceRedirect" name="invoiceRedirect" <?php checked( $invoiceRedirect, 1, true );?> value="1">
      </div>
	  <div class="card-header">Load Theme</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="loadTheme" name="loadTheme" <?php checked( $loadTheme, 1, true );?> value="1">
      </div>
	  <div class="card-header">Mount Point Id</div>
	  <div class="card-body text-dark">
        <input type="text" id="mountPointId" name="mountPointId" placeholder="Mount Point Id" value="<?php echo $mountPointId; ?>">
      </div>
	  <div class="card-header">Single Column</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="singleColumn" name="singleColumn" <?php checked( $singleColumn, 1, true );?> value="1">
      </div>
	  <div class="card-header">Quote Requested Redirect</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="quoteRequestedRedirect" name="quoteRequestedRedirect" <?php checked( $quoteRequestedRedirect, 1, true );?> value="1">
      </div>
	  <div class="card-header">Google API Public Key</div>
	  <div class="card-body text-dark">
        <input type="text" id="googleApiPublicKey" name="googleApiPublicKey" placeholder="Google API Public Key" value="<?php echo $googleApiPublicKey; ?>">
      </div>
	  <div class="card-header">Allow Add To Cart</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="allowAddToCart" name="allowAddToCart" <?php checked( $allowAddToCart, 1, true );?> value="1">
      </div>
	  <div class="card-header">Hide Drafting</div>
	  <div class="card-body text-dark">
        <input type="checkbox" id="hideDrafting" name="hideDrafting" <?php checked( $hideDrafting, 1, true );?> value="1">
      </div>
<?php }


//  add_action('save_post', 'save_meta_box_value', 10 ,2);
//  add_action('wp_head', 'get_api_data_by_id');
//  add_action('woocommerce_before_add_to_cart_button', 'woocommerce_before_add_to_cart');


function my_plugin_add_settings_page() {
    add_options_page(
        'Merchi Settings',
        'Merchi Product Setting',
        'manage_options',
        'Merchi-plugin-settings',
        'Merchi_plugin_settings_page' 
    );
}

function Merchi_plugin_settings_page() { ?> <div class="wrap">
    <h1>
        Merchi Products Setting Options 
    </h1>
	  <form action="options.php" method="POST">
		<?php
		  settings_fields('mrchipluginpage');
		   do_settings_sections('Merchi-plugin-settings');
		  submit_button();
	    ?>
	  </form>
    </div>
  <?php
 }


function settings() {
	add_settings_section('mpp_first_section', null, null, 'Merchi-plugin-settings');
		
	add_settings_field('mpp_location', 'Select Option','my_html_page', 'Merchi-plugin-settings', 'mpp_first_section');
	register_setting( 'mrchipluginpage', 'mpp_location', array('senitize_callback' => 'senitize_text_fiels', 'default' => '0'));
}

	
function my_html_page() { 
	?>
	<select name="mpp_location">
		<option value="0" <?php selected(get_option('mpp_location', '0'));  ?>>With Woocommerce</option>
		<option value="1" <?php selected(get_option('mpp_location', '1'));  ?>>With Custum</option>
	</select>
	<?php 
}

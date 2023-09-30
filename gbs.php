<?php 
/*
Plugin Name: gbs Shipping
Description: This plugin will allow the shipping fee to be set for different locations
Version: 1.0
Author: gbs.code
*/
/**
 * Add_Quantity_On_Checkout
 **/
if (!class_exists('gbs_Shipping')) {

	class gbs_Shipping {

		public $plugin_version = '1.0';
		public function __construct() {
			
			add_action( 'woocommerce_after_order_notes', array($this,'wps_add_select_checkout_field' ));
			add_action( 'woocommerce_after_order_notes', array($this,'wps_add_select_checkout2_field' ));
			add_action( 'wp_footer', array($this,'add_script_on_checkout1' ));
			add_action( 'woocommerce_cart_calculate_fees', array($this,'calculate_cost1' ));
		}
        
        
function wps_add_select_checkout_field($checkout){
	woocommerce_form_field( 'shipping_loc_fee', array(
	    'type'          => 'select',
	    'class'         => array( 'form-row-wide' ),
	    'label'         => __( 'Select your Delivery Location' ),
	    'options'       => array(
	    	'blank'		=> __( 'Choose your nearest location', 'wps' ),
	        'blank1'		=> __( '***INTERNATIONAL LOCATIONS***', 'wps' ),
	        'USA' 	=> __( 'USA', 'wps' ),
	        'UK' 	=> __( 'UK', 'wps' ),
	        'Canada' 	=> __( 'Canada', 'wps' ),
	        'African countries' 	=> __( 'African countries', 'wps' ),
	        'Other countries' 	=> __( 'Other Countries', 'wps' ),
			'blank2'		=> __( '***FREE PICK-UP LOCATIONS***', 'wps' ),
	        'Omu Aran Free Pickup' 	=> __( 'Omu Aran', 'wps' ),
	        //'Abeokuta Free Pickup' 	=> __( 'Abeokuta', 'wps' ),
	        //'VI Free Pickup' 	=> __( 'VI', 'wps' ),
	        //'Ilupeju, Lagos Free Pickup' 	=> __( 'Ilupeju, Lagos', 'wps' ),
	        'blank3' 	=> __( '****NIGERIA STATES LOCATIONS***', 'wps' ),
	        'Abia State' 	=> __( 'Abia', 'wps' ),
	        'Adamawa State' 	=> __( 'Adamawa', 'wps' ),
	        'Akwa Ibom State' 	=> __( 'Akwa Ibom', 'wps' ),
	        'Anambra State' 	=> __( 'Anambra', 'wps' ),
			'Bauchi State' 	=> __( 'Bauchi', 'wps' ),
	        'Bayelsa State' 	=> __( 'Bayelsa', 'wps' ),
	        'Benue State' 	=> __( 'Benue', 'wps' ),
	        'Borno State' 	=> __( 'Borno', 'wps' ),
	        'Cross River State' 	=> __( 'Cross River', 'wps' ),
			'Delta State' 	=> __( 'Delta', 'wps' ),
			'Ebonyi State' 	=> __( 'Ebonyi', 'wps' ),
	        'Edo State' 	=> __( 'Edo', 'wps' ),
	        'Ekiti State' 	=> __( 'Ekiti', 'wps' ),
	        'Enugu State' 	=> __( 'Enugu', 'wps' ),
	        'Gombe State' 	=> __( 'Gombe', 'wps' ),
	        'Imo State' 	=> __( 'Imo', 'wps' ),
	        'Jigawa State' 	=> __( 'Jigawa', 'wps' ),
	        'Kaduna State' 	=> __( 'Kaduna', 'wps' ),
	        'Kano State' 	=> __( 'Kano', 'wps' ),
	        'Katsina State' 	=> __( 'Katsina', 'wps' ),
	        'Kebbi State' 	=> __( 'Kebbi', 'wps' ),
	        'Kogi State' 	=> __( 'Kogi', 'wps' ),
	        'Kwara State' 	=> __( 'Kwara', 'wps' ),
	        'Lagos State' 	=> __( 'Lagos', 'wps' ),
	        'Nasarawa State' 	=> __( 'Nasarawa', 'wps' ),
	        'Niger State' 	=> __( 'Niger', 'wps' ),
	        'Ogun State' 	=> __( 'Ogun', 'wps' ),
	        'Ondo State' 	=> __( 'Ondo', 'wps' ),
	        'Osun State' 	=> __( 'Osun', 'wps' ),
	        'Oyo State' 	=> __( 'Oyo', 'wps' ),
	        'Plateau State' 	=> __( 'Plateau', 'wps' ),
	        'Rivers State' 	=> __( 'Rivers', 'wps' ),
	        'Sokoto State' 	=> __( 'Sokoto', 'wps' ),
	        'Taraba State' 	=> __( 'Taraba', 'wps' ),
	        'Yobe State' 	=> __( 'Yobe', 'wps' ),
	        'Zamfara State' 	=> __( 'Zamfara', 'wps' ),
	        'FCT State' 	=> __( 'FCT', 'wps' )	    
	    )
		),
	$checkout->get_value( 'shipping_loc_fee' ));
}

function wps_add_select_checkout2_field( $checkout ) {
			
	//echo '<h2>'.__('gbs Shipping Address').'</h2>';
	woocommerce_form_field( 'delivery_type', array(
	    'type'          => 'select',
	    'class'         => array( 'form-row-wide' ),
	    'label'         => __( 'Select your Delivery options' ),
	    'options'       => array(
	    	'blank'		=> __( 'Select your Delivery options', 'wps' ),
	        'Door step Delivery' 	=> __( 'Door step Delivery', 'wps' )
	        //'Bus Park Pick Up Delivery' 	=> __( 'Bus Park Pick-up', 'wps' )
	    )
 ),
 			$checkout->get_value( 'delivery_type' ));
			
}

 function add_script_on_checkout1(){
		if (is_checkout()) {
    ?>
		    <script type="text/javascript">
		    jQuery( document ).ready(function( $ ) {
		        $('#shipping_loc_fee').change(function(){
		            //alert('hello');
		            jQuery(document.body).trigger("update_checkout");
					//jQuery('body').trigger('update_checkout');
					
		        });

				$('#delivery_type').change(function(){
		            //alert('hello');
		            jQuery(document.body).trigger("update_checkout");
					//jQuery('body').trigger('update_checkout');
					
		        });
		    });
		    </script>
	    <?php
	    }
	}

		
		
 function calculate_cost1( $cart ){
        $ext_cst_label_billing 	= 'Shipping Fee';
        
        if ( ! $_POST || ( is_admin() && ! is_ajax() ) ) {
        	return;
	    }

	 if ( isset( $_POST['post_data'] ) ) {
        parse_str( $_POST['post_data'], $post_data );
    } else {
        $post_data = $_POST; // fallback for final checkout (non-ajax)
    }
	 
	    if (isset($post_data['shipping_loc_fee'])) {
			//echo $post_data['shipping_loc_fee'];
	    	global $woocommerce;
	    	switch ($post_data['shipping_loc_fee']) {
				case 'Omu Aran Free Pickup':	$extracost =  0; break;
				case 'Abeokuta Free Pickup':	$extracost =  0; break;
				case 'VI Free Pickup':	$extracost =  0; break;
				case 'Ilupeju, Lagos Free Pickup':	$extracost =  0; break;
				case 'USA':	$extracost =  13000; break;
				case 'UK':	$extracost =  12000; break;
				case 'Canada':	$extracost =  13000; break;
				case 'African countries':	$extracost =  10000; break;
				case 'Other countries':	$extracost =  15000; break;
				case 'blank1':	$extracost =  0; break;
				case 'blank2':	$extracost =  0; break;
				case 'blank3':	$extracost =  0; break;
				case 'Abia State':
						switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  2000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Adamawa State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3700;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Akwa Ibom State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Anambra State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  2000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Bauchi State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Bayelsa State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Benue State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Borno State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3700;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Cross River State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Delta State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Ebonyi State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Edo State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  1500;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  1500;
						break;
						default:
						$extracost =  1500;
	    				break;
						}
						break;
	    		case 'Ekiti State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  1500;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  500;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Enugu State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Gombe State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Imo State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Jigawa State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Kaduna State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3700;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Kano State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3700;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Katsina State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3700;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Kebbi State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3700;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Kogi State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Kwara State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  1500;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  500;
						break;
						default:
						$extracost =  1500;
	    				break;
						}
						break;
	    		case 'Lagos State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  1500;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  1500;
						break;
						default:
						$extracost =  1500;
	    				break;
						}
						break;
	    		case 'Nasarawa State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Niger State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Ogun State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  1500;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  1500;
						break;
						default:
						$extracost =  1500;
	    				break;
						}
						break;
	    		case 'Ondo State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  1500;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  1500;
						break;
						default:
						$extracost =  1500;
	    				break;
						}
						break;
	    		case 'Osun State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  1500;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  1000;
						break;
						default:
						$extracost =  1500;
	    				break;
						}
						break;
	    		case 'Oyo State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  1500;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  1500;
						break;
						default:
						$extracost =  1500;
	    				break;
						}
						break;
	    		case 'Plateau State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  3000;
	    				break;
						}
						break;
	    		case 'Rivers State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  2500;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2500;
	    				break;
						}
						break;
	    		case 'Sokoto State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3700;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  3700;
	    				break;
						}
						break;
	    		case 'Taraba State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3700;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  2000;
	    				break;
						}
						break;
	    		case 'Yobe State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3000;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  3000;
	    				break;
						}
						break;
	    		case 'Zamfara State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  3700;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2000;
						break;
						default:
						$extracost =  3700;
	    				break;
						}
						break;
	    		case 'FCT State':
	    		    switch ($post_data['delivery_type']) {
						case 'Door step Delivery':
						$extracost =  2500;
						break;
						case 'Bus Park Pick Up Delivery':
						$extracost =  2500;
						break;
						default:
						$extracost =  2500;
	    				break;
						}
						break;
	    		default:
	    			$extracost =  0000;
	    			break;
	    	}
	        WC()->cart->add_fee( $ext_cst_label_billing, $extracost );
			
	    }
	}

	}
		add_action('woocommerce_checkout_process', 'wps_select_checkout_field_process');
 function wps_select_checkout_field_process() {
    global $woocommerce;
    // Check if set, if its not set add an error.
    if ($_POST['shipping_loc_fee'] == "blank" || $_POST['shipping_loc_fee'] == "blank1" || $_POST['shipping_loc_fee'] == "blank2" || $_POST['shipping_loc_fee'] == "blank3"){
	   wc_add_notice( '<strong>Please select a shipping address under Delivery options</strong>', 'error' );	
	}
	
  
 }

	
	add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');

function custom_checkout_field_update_order_meta($order_id)

{

if (!empty($_POST['shipping_loc_fee'])) {

update_post_meta($order_id, 'Delivery Location',sanitize_text_field($_POST['shipping_loc_fee']));
update_post_meta($order_id, 'Delivery Option',sanitize_text_field($_POST['delivery_type']));

}

}
	
	
	
}
$change_quantity_on_checkout = new gbs_Shipping();


<?php if(!isset($content_width)) $content_width = 640;
define('CPOTHEME_ID', 'cpothemes');
define('CPOTHEME_NAME', 'CPOThemes');
define('CPOTHEME_VERSION', '4.1.0');
//Other constants
define('CPOTHEME_LOGO_WIDTH', '200');
define('CPOTHEME_THUMBNAIL_WIDTH', '700');
define('CPOTHEME_THUMBNAIL_HEIGHT', '480');
define('CPOTHEME_USE_TESTIMONIALS', true);
define('CPOTHEME_USE_FEATURES', true);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);

//Load Core; check existing core or load development core
$core_path = get_template_directory().'/core/';
if(defined('CPOTHEME_CORE')) $core_path = CPOTHEME_CORE;
require_once $core_path.'init.php';

$include_path = get_template_directory().'/includes/';

//Main components
require_once($include_path.'setup.php');
require_once($include_path.'metadata.php');
require_once($include_path.'metaboxes.php');
require_once($include_path.'layout.php');
require_once($include_path.'functions.php');
//Custom posts
require_once($include_path.'cposts/cpost_themes.php');
// require_once($include_path.'cposts/cpost_plugins.php');
require_once($include_path.'cposts/cpost_themefeatures.php');
require_once($include_path.'cposts/cpost_documentation.php');
// require_once($include_path.'cposts/cpost_showcase.php');


// remove "new password" email notifications
add_filter( 'send_email_change_email', '__return_false' );

function cpo_edd_purchase_form_required_fields( $required_fields ) {
    $required_fields['card_address'] = array(
        'error_id' => 'invalid_address',
        'error_message' => __( 'Please enter your address.', 'cpothemes' )
    );
	$required_fields['card_city'] = array(
        'error_id' => 'invalid_city',
        'error_message' => __( 'Please enter your billing city.', 'cpothemes' )
    );
	$required_fields['card_zip'] = array(
    	'error_id' => 'invalid_zip',
    	'error_message' => __( 'Please enter a correct ZIP code.', 'cpothemes' )
    );

 //    if ( isset( $required_fields['card_city'] ) ) {
	// 	unset( $required_fields['card_city'] );
	// }

	// if ( isset( $required_fields['card_zip'] ) ) {
	// 	unset( $required_fields['card_zip'] );
	// }

	// if ( isset( $required_fields['card_state'] ) ) {
	// 	unset( $required_fields['card_state'] );
	// }

    return $required_fields;
}
// add_filter( 'edd_purchase_form_required_fields', 'cpo_edd_purchase_form_required_fields' );

function cpo_pdf_template_extra_fields( $offset, $template_name, $eddpdfi_pdf, $eddpdfi_payment, $eddpdfi_payment_meta, $eddpdfi_buyer_info, $colors ) {
	if ( ! edd_use_taxes() ) {
		return $offset;
	}

	// If there's no VAT number there's no reverse charge (EU directive requirement regardless of local law)
	if ( ! empty( $eddpdfi_buyer_info['vat_number'] ) ) {
		// Only recharge if no VAT has been charged
		$vat = edd_get_payment_tax( $eddpdfi_payment->ID );
		if ( $vat == 0 ) {
			$eddpdfi_pdf->SetX( 90 );
			$eddpdfi_pdf->SetTextColor( $colors['body'][0], $colors['body'][1], $colors['body'][2] );
			$eddpdfi_pdf->Cell( 0, 6, 'VAT Reversed', 0, 2, 'L', false );

			$offset += 6;
		}
	}

	// Address line 1
	$eddpdfi_pdf->SetX( 60 );
	$eddpdfi_pdf->SetTextColor( $colors['emphasis'][0], $colors['emphasis'][1], $colors['emphasis'][2] );
	$eddpdfi_pdf->Cell( 30, 6, __( 'Address', 'eddpdfi' ), 0, 0, 'L', false );
	$eddpdfi_pdf->SetTextColor( $colors['body'][0], $colors['body'][1], $colors['body'][2] );
	$eddpdfi_pdf->Cell( 0, 6, $eddpdfi_buyer_info['address']['line1'], 0, 2, 'L', false );

	$offset += 6;

	// Optionally add address line 2
	if ( ! empty( $eddpdfi_buyer_info['address']['line2'] ) ) {
		$eddpdfi_pdf->SetTextColor( $colors['body'][0], $colors['body'][1], $colors['body'][2] );
		$eddpdfi_pdf->Cell( 0, 6, $eddpdfi_buyer_info['address']['line2'], 0, 2, 'L', false );

		$offset += 6;
	}

	// City
	if ( ! empty( $eddpdfi_buyer_info['address']['city'] ) ) {
		$eddpdfi_pdf->SetX( 90 );
		$eddpdfi_pdf->SetTextColor( $colors['body'][0], $colors['body'][1], $colors['body'][2] );
		$eddpdfi_pdf->Cell( 0, 6, $eddpdfi_buyer_info['address']['city'], 0, 2, 'L', false );

		$offset += 6;
	}

	// State/County/Region
	if ( ! empty( $eddpdfi_buyer_info['address']['state'] ) ) {
		$eddpdfi_pdf->SetX( 90 );
		$eddpdfi_pdf->SetTextColor( $colors['body'][0], $colors['body'][1], $colors['body'][2] );
		$eddpdfi_pdf->Cell( 0, 6, $eddpdfi_buyer_info['address']['state'], 0, 2, 'L', false );

		$offset += 6;
	}

	// Country
	$eddpdfi_pdf->SetX( 90 );
	$eddpdfi_pdf->SetTextColor( $colors['body'][0], $colors['body'][1], $colors['body'][2] );
	$eddpdfi_pdf->Cell( 0, 6, $eddpdfi_buyer_info['address']['country'], 0, 2, 'L', false );

	// Zip
	$eddpdfi_pdf->SetX( 90 );
	$eddpdfi_pdf->SetTextColor( $colors['body'][0], $colors['body'][1], $colors['body'][2] );
	$eddpdfi_pdf->Cell( 0, 6, $eddpdfi_buyer_info['address']['zip'], 0, 2, 'L', false );

	$offset += 12;

	// IP Address
	$eddpdfi_pdf->SetX( 60 );
	$eddpdfi_pdf->SetTextColor( $colors['emphasis'][0], $colors['emphasis'][1], $colors['emphasis'][2] );
	$eddpdfi_pdf->Cell( 30, 6, __( 'IP Address', 'eddpdfi' ), 0, 0, 'L', false );
	$eddpdfi_pdf->SetTextColor( $colors['body'][0], $colors['body'][1], $colors['body'][2] );
	$eddpdfi_pdf->Cell( 0, 6, edd_get_payment_user_ip( $eddpdfi_payment->ID ), 0, 2, 'L', false );

	$offset += 6;

	return $offset;
}

// hook our function
add_filter( 'eddpdfi_pdf_template_extra_fields', 'cpo_pdf_template_extra_fields', 10, 7 );

// add filter for fastspring usd price
add_filter( 'pp-edd-fs/prepare_fs_checkout_data_single_product', 'cpo_filter_price' );

function cpo_filter_price( $product_checkout_data ){

	if ( isset( $product_checkout_data['pricing']['price']['EUR'] ) ) {
		$product_checkout_data['pricing']['price']['USD'] = $product_checkout_data['pricing']['price']['EUR'];
	}

	return $product_checkout_data;
}

// function cpo_edd_purchase_form_required_fields( $required_fields ) {

// 	if ( isset( $required_fields['card_city'] ) ) {
// 		unset( $required_fields['card_city'] );
// 	}

// 	if ( isset( $required_fields['card_zip'] ) ) {
// 		unset( $required_fields['card_zip'] );
// 	}

// 	if ( isset( $required_fields['card_state'] ) ) {
// 		unset( $required_fields['card_state'] );
// 	}

// 	return $required_fields;
// }
// add_filter( 'edd_purchase_form_required_fields', 'cpo_edd_purchase_form_required_fields' );

add_filter( 'edd-vat-use-checkout-billing-template', '__return_false' );
add_filter( 'edd_require_billing_address', '__return_false', 99 ); 

// Sigma Current year shortcode
add_shortcode( 'sigma_current_year', 'cpo_sigma_return_current_year' );
function cpo_sigma_return_current_year( ) {

	$now = new DateTime();
	$result = $now->format("Y");

    return $result;
}


add_filter('comment_form_default_fields', 'cpo_website_remove'); 
function cpo_website_remove($fields) { 
	if(isset($fields['url'])) { 
		unset($fields['url']);
	} 
	return $fields;
}



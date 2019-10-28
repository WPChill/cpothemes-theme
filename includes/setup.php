<?php 
//Top elements
add_action('cpotheme_top', 'cpotheme_top_menu');
add_action('cpotheme_top', 'cpotheme_social');

//Header elements
add_action('cpotheme_header', 'cpotheme_logo');
add_action('cpotheme_header', 'cpotheme_theme_languages');
add_action('cpotheme_header', 'cpotheme_menu');
add_action('cpotheme_header', 'cpotheme_menu_toggle');

//Header elements
add_action('cpotheme_before_main', 'cpotheme_header_slider');
add_action('cpotheme_title', 'cpotheme_page_title');

//Footer elements
add_action('cpotheme_subfooter', 'cpotheme_subfooter');
add_action('cpotheme_footer', 'cpotheme_footer_menu');
add_action('cpotheme_footer', 'cpotheme_footer');


//Add homepage welcome
//add_action('cpotheme_before_wrapper', 'cpotheme_layout_notice');
function cpotheme_layout_notice(){ 
	cpotheme_block('sitewide_notice', 'top-notice', 'container'); 
}

//Add homepage welcome
//add_action('cpotheme_header', 'cpotheme_layout_home_slider', 20);
function cpotheme_layout_home_slider(){ 
	if(is_front_page()) get_template_part('homepage', 'slider'); 
}

//Add homepage themes
// add_action('cpotheme_before_main', 'cpotheme_layout_home_themes', 21);
function cpotheme_layout_home_themes(){ 
	if(is_front_page()) get_template_part('homepage', 'themes'); 
}

//Add homepage themes
// add_action('cpotheme_before_main', 'cpotheme_layout_home_testimonials', 22);
function cpotheme_layout_home_testimonials(){ 
	if(is_front_page()) get_template_part('homepage', 'testimonials'); 
}

//Add homepage features
// add_action('cpotheme_before_main', 'cpotheme_layout_home_features', 40);
function cpotheme_layout_home_features(){ 
	if(is_front_page()) get_template_part('homepage', 'features'); 
}

//Add footer subscribe cta
//add_action('cpotheme_after_main', 'cpotheme_layout_footer_cta', 20);
function cpotheme_layout_footer_cta(){ 
	$footer = cpotheme_layout_footer();
	if($footer != 'none' && $footer != 'minimal')
		get_template_part('element', 'footer-notice'); 
}



add_action('after_setup_theme', 'cpotheme_theme_setup');
function cpotheme_theme_setup(){
	load_theme_textdomain('cpotheme', get_template_directory().'/languages');
	$locale = get_locale();
	$locale_file = get_template_directory()."/languages/$locale.php";
	if(is_readable($locale_file)) require_once($locale_file);
}


//Add custom bbpress styles
add_action('wp_enqueue_scripts', 'cpotheme_theme_resources');
function cpotheme_theme_resources(){
	if(function_exists('is_bbpress') && is_bbpress())
		wp_enqueue_style('bbpress', get_template_directory_uri().'/style-bbpress.css');
}


add_filter('wp_enqueue_scripts', 'cpotheme_theme_scripts');
function cpotheme_theme_scripts(){ 
	wp_enqueue_script('cpotheme-cpothemes', get_template_directory_uri().'/scripts/general.js', array(), false, true);
}

//Remove edd_download pages link
remove_action('edd_after_download_content', 'edd_show_has_purchased_item_message');
remove_action('edd_after_download_content', 'edd_append_purchase_link');


//Modify main query on taxonomy page to change ordering
add_action('pre_get_posts', 'cpotheme_tax_supporttheme_query');
function cpotheme_tax_supporttheme_query($query){	
	if(is_tax('cpo_support_category')){
		if($query->is_main_query()){
			$query->set('orderby', 'menu_order');
			$query->set('order', 'ASC');
			$query->set('posts_per_page', -1);
		}
	}
}


//Display language switcher
function cpotheme_theme_languages($display = false){
	if(function_exists('icl_get_languages')):
		$output = '<div id="langs" class="langs">';
		$langs = icl_get_languages('skip_missing=0&orderby=code');
		
		//Print full lagnguage list
		foreach($langs as $current_lang):
			$active = '';
			if($current_lang['language_code'] == ICL_LANGUAGE_CODE) $active = ' language-item-active';
			$output .= '<a class="language-item'.$active.'" href="'.$current_lang['url'].'" id="language-switch-'.$current_lang['language_code'].'" title="'.$current_lang['native_name'].'">';
			$output .= '<img src="'.get_template_directory_uri().'/images/flag-'.$current_lang['language_code'].'.png" alt="'.$current_lang['language_code'].'"> ';
			$output .= '</a>';
		endforeach;
		
		$output .= '</div>';
		echo $output;
	endif;
}


//Add property pages
//add_action('init', 'cpotheme_rewrite_rules');
function cpotheme_rewrite_rules() {
    //Alias themes with downloads
	add_rewrite_rule('^theme/([^/]*)', 'index.php?download=$matches[1]', 'top');
    add_rewrite_rule('^es/theme/([^/]*)', 'index.php?download=$matches[1]&lang=es', 'top');
    //Alias plugins with downloads
	add_rewrite_rule('^plugin/([^/]*)', 'index.php?download=$matches[1]', 'top');
    add_rewrite_rule('^es/plugin/([^/]*)', 'index.php?download=$matches[1]&lang=es', 'top');
}



/**
 * Trigger a custom GA impression
 */
function cpotheme_eddeet_impression( $download_id ) {

	if(class_exists('EDD_Enhanced_Ecommerce_Tracking')){
		global $edd_impressions;

		$download 		= new EDD_Download( $download_id );
		$categories 	= (array) get_the_terms( $download->ID, 'download_category' );
		$category_names	= wp_list_pluck( $categories, 'name' );
		$first_category	= reset( $category_names );
		$list 			= EDD_Enhanced_Ecommerce_Tracking()->triggers->get_the_list();
		$c				= count( $edd_impressions ) + 1;

		// Prevent duplicate impressions on one page
		if ( isset( $edd_impressions[ $download->ID ] ) ) :
			return;
		endif;

		$edd_impressions[ $download->ID ] = array(
			"il{$c}nm"			=> 'Overview',
			"il{$c}pi1id"		=> $download->ID,
			"il{$c}pi1nm"  		=> $download->post_title,
			"il{$c}pi1ca"  		=> $first_category,
			"il{$c}pi1br"  		=> '',
			"il{$c}pi1va"  		=> '',
			"il{$c}pi1ps"  		=> '',
			"il{$c}pi1cd1"		=> get_the_author_meta( 'display_name', $download->post_author ),
		);

	}
}


/**
 * Trigger a custom GA detail page
 */
function cpotheme_eddeet_detail( $download_id ) {
	if(class_exists('EDD_Enhanced_Ecommerce_Tracking')){
		$download 		= new EDD_Download( $download_id );
		$categories 	= (array) get_the_terms( $download->ID, 'download_category' );
		$category_names	= wp_list_pluck( $categories, 'name' );
		$first_category	= reset( $category_names );
		$list 			= EDD_Enhanced_Ecommerce_Tracking()->triggers->get_the_list();

		EDD_Enhanced_Ecommerce_Tracking()->measurement_protocol->track_event( apply_filters( 'eddeet_trigger_detail_args', array(
			't' 			=> 'event',
			'ec'			=> 'ecommerce',
			'ea'			=> 'detail',
			'el'			=> 'Detail',
			'pa'			=> 'detail',
			'pal'			=> '',
			'pr1id' 		=> $download->ID,			// ID
			'pr1nm'			=> $download->post_title,	// Name
			'pr1ca'			=> $first_category,			// Category
		) ) );
	}
}


//Remove bbPress styles when not in use
add_action('wp_enqueue_scripts', 'cpotheme_dequeue_styles', 99);
remove_action('wp_head', 'edd_sl_checkout_js');
add_action('wp_footer', 'edd_sl_checkout_js');
function cpotheme_dequeue_styles(){
	if(class_exists('bbPress')){
		if(!is_bbpress()){
			wp_dequeue_style('bbp-default');
			wp_dequeue_style('bbp_private_replies_style');
			wp_dequeue_style('bbps-style.css');
			wp_dequeue_script('bbpress-editor');
		}
	}
	if(!is_singular('post')){
		wp_dequeue_style('ssbp_styles');
		wp_dequeue_script('ssbp_standard');
	}
	
	if(!is_page(12598)){
		wp_dequeue_script('edd-ajax');
	}
}


//Move EDD terms JS to footer, after jQuery
remove_action('edd_checkout_form_top', 'edd_agree_to_terms_js');
add_action('wp_footer', 'cpotheme_edd_terms');
function cpotheme_edd_terms(){
	if ( ! edd_is_checkout() ) {
		return;
	}
	edd_agree_to_terms_js();
}


//Move all scripts to footer
//add_action('wp_enqueue_scripts', 'cpotheme_move_scripts_footer');
function cpotheme_move_scripts_footer() { 
   remove_action('wp_head', 'wp_print_scripts'); 
   remove_action('wp_head', 'wp_print_head_scripts', 9); 
   remove_action('wp_head', 'wp_enqueue_scripts', 1);
   add_action('wp_footer', 'wp_print_scripts', 5);
   add_action('wp_footer', 'wp_enqueue_scripts', 5);
   add_action('wp_footer', 'wp_print_head_scripts', 5); 
} 


//Remove emojis
add_action('init', 'cpotheme_dequeue_emojis');
function cpotheme_dequeue_emojis(){
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');	
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');	
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}


//Prevent duplicate items in the cart
add_action('edd_pre_add_to_cart', 'cpotheme_edd_prevent_duplicate_cart', 10, 2);
function cpotheme_edd_prevent_duplicate_cart($download_id, $options){
	if(edd_item_in_cart($download_id, $options)){
		wp_redirect(edd_get_checkout_uri()); 
		exit;
	}
}


//Remove required fields on checkout
add_filter('edd_purchase_form_required_fields', 'cpotheme_edd_required_fields');
function cpotheme_edd_required_fields($required_fields){
	unset($required_fields['card_city']);
	unset($required_fields['card_zip']);
	unset($required_fields['card_state']);
	return $required_fields;
}

<?php //Contains assorted functions and utilities for themes.

//Calculate sidebar class to load
function cpotheme_get_sidebar_position(){
	$current_id = cpotheme_current_id();
	$sidebar_layout = '';
	if(is_home()){ 
		$sidebar_layout = cpotheme_get_option('sidebar_position_home');
	}elseif(function_exists('is_shop') && is_shop()){
		$sidebar_layout = get_post_meta(get_option('woocommerce_shop_page_id'), 'layout_sidebar', true);
	}elseif(is_tax() || is_category() || is_tag()){ 
		$sidebar_layout = cpotheme_tax_meta($current_id, 'layout_sidebar');
	}else{
		$sidebar_layout = get_post_meta($current_id, 'layout_sidebar', true);
	}
	
	//Sanitize
	if($sidebar_layout != '' && $sidebar_layout != 'default'){
		$sidebar_class = $sidebar_layout;
	}else{
		$sidebar_class = cpotheme_get_option('sidebar_position');
	}
	
	return $sidebar_class;
}


//Return the style of the header
if(!function_exists('cpotheme_layout_header')){
	function cpotheme_layout_header(){
		$current_id = cpotheme_current_id();
		$layout = '';
		if(is_front_page() || is_home()){
			$layout = 'normal';
		}else{
			if(function_exists('is_shop') && is_shop()){
				$layout = get_post_meta(get_option('woocommerce_shop_page_id'), 'page_header', true);
			}elseif(is_tax() || is_category() || is_tag()){ 
				$layout = cpotheme_tax_meta($current_id, 'page_header');
			}else{
				$layout = get_post_meta($current_id, 'page_header', true);
			}
		}
		if($layout == '') $layout = 'normal';
		return $layout;
	}
}

//Return the style of the header
if(!function_exists('cpotheme_layout_title')){
	function cpotheme_layout_title(){
		$current_id = cpotheme_current_id();
		$layout = '';
		if(is_front_page() || is_home()){
			$layout = 'none';
		}else{
			if(function_exists('is_shop') && is_shop()){
				$layout = get_post_meta(get_option('woocommerce_shop_page_id'), 'page_title', true);
			}elseif(is_tax() || is_category() || is_tag()){ 
				$layout = cpotheme_tax_meta($current_id, 'page_title');
			}else{
				$layout = get_post_meta($current_id, 'page_title', true);
			}
		}
		if($layout == '') $layout = 'normal';
		return $layout;
	}
}

//Return the style of the header
if(!function_exists('cpotheme_layout_footer')){
	function cpotheme_layout_footer(){
		$current_id = cpotheme_current_id();
		$layout = '';
		if(is_front_page() || is_home()){
			$layout = 'normal';
		}else{
			if(function_exists('is_shop') && is_shop()){
				$layout = get_post_meta(get_option('woocommerce_shop_page_id'), 'page_footer', true);
			}elseif(is_tax() || is_category() || is_tag()){ 
				$layout = cpotheme_tax_meta($current_id, 'page_footer');
			}else{
				$layout = get_post_meta($current_id, 'page_footer', true);
			}
		}
		if($layout == '') $layout = 'normal';
		return $layout;
	}
}

//Check current page layout and remove associated actions
if(!function_exists('cpotheme_layout_actions')){
	add_action('wp_head', 'cpotheme_layout_actions');
	function cpotheme_layout_actions(){
		//Header
		$header = cpotheme_layout_header();
		if($header == 'minimal'){
			remove_all_actions('cpotheme_top');
		}elseif($header == 'none'){
			remove_all_actions('cpotheme_top');
			remove_all_actions('cpotheme_header');
		}
		
		//Title
		$title = cpotheme_layout_title();
		if($title == 'none'){
			remove_all_actions('cpotheme_title');
		}
		
		//Footer
		$footer = cpotheme_layout_footer();
		if($footer == 'minimal'){
			remove_all_actions('cpotheme_subfooter');
		}elseif($footer == 'none'){
			remove_all_actions('cpotheme_subfooter');
			remove_all_actions('cpotheme_before_footer');
			remove_all_actions('cpotheme_footer');
			remove_all_actions('cpotheme_after_footer');
		}
		
	}
}

//Abstracted function for retrieving specific options inside option arrays
if(!function_exists('cpotheme_get_option')){
	function cpotheme_get_option($option_name = '', $option_array = 'cpotheme_settings'){
		
		$option_value = '';
		
		//Check against option array and see if it is multilingual
		$options = cpotheme_metadata_customizer();
		if(isset($options[$option_name]['multilingual']) && $options[$option_name]['multilingual'] == true){
			//Determines whether to grab current language, or original language's option
			$option_array = $option_array.cpotheme_wpml_current_language();
		}
		
		//If options exists and is not empty, get value
		$option_list = get_option($option_array, false);
		if($option_list && isset($option_list[$option_name]) && (is_bool($option_list[$option_name]) === true || $option_list[$option_name] !== '')){
			$option_value = $option_list[$option_name];
		}
		
		//If option is empty, check whether it needs a default value
		if($option_value === '' || !isset($option_list[$option_name])){
			$options = cpotheme_metadata_customizer();
			//If option cannot be empty, use default value
			if(!isset($options[$option_name]['empty'])){
				if(isset($options[$option_name]['default'])){
					$option_value = $options[$option_name]['default'];
				}
			//If it can be empty but not set, use default value
			}elseif(!isset($option_list[$option_name])){
				if(isset($options[$option_name]['default'])){
					$option_value = $options[$option_name]['default'];
				}
			}
		}
		return $option_value;
	}
}

//Abstracted function for updating specific options inside arrays
if(!function_exists('cpotheme_update_option')){
	function cpotheme_update_option($option_name, $option_value, $option_array = 'cpotheme_settings'){
		
		//Check against option array and see if it is multilingual
		$options = cpotheme_metadata_customizer();
		if(isset($options[$option_name]['multilingual']) && $options[$option_name]['multilingual'] == true){
			//Determines whether to grab current language, or original language's option
			$option_array = $option_array.cpotheme_wpml_current_language();
		}
		
		
		$option_list = get_option($option_array, false);
		if(!$option_list)
			$option_list = array();
		$option_list[$option_name] = $option_value;
		if(update_option($option_array, $option_list))
			return true;
		else
			return false;
	}
}

//Returns the current language's code in the event that WPML is active
if(!function_exists('cpotheme_wpml_current_language')){
	function cpotheme_wpml_current_language(){
		$language_code = '';
		if(cpotheme_wpml_active()){		
			$default_language = cpotheme_wpml_default_language();
			$active_language = ICL_LANGUAGE_CODE;
			if($active_language != $default_language)
				$language_code = '_'.$active_language;
		}
		return $language_code;
	}
}

//Check if WPML is active
if(!function_exists('cpotheme_wpml_active')){	
	function cpotheme_wpml_active(){
		if(defined('ICL_LANGUAGE_CODE') && defined('ICL_SITEPRESS_VERSION'))
			return true;
		else
			return false;
	}
}

//Retrieve languages from WPML
if(!function_exists('cpotheme_wpml_languages')){
	function cpotheme_wpml_languages(){
		if(cpotheme_wpml_active()){
			global $sitepress;
			return $sitepress->get_active_languages();
		}
	}
}

//Retrieve default WPML language
if(!function_exists('cpotheme_wpml_default_language')){
	function cpotheme_wpml_default_language(){
		if(cpotheme_wpml_active()){
			global $sitepress;
			return $sitepress->get_default_language();
		}
	}
}


//Searches for a link inside a string. Used for post formats
if(!function_exists('cpotheme_find_link')){
	function cpotheme_find_link($content, $fallback){
	
		$link_url = '';
		$link_pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		$post_content = $content;
		if(preg_match($link_pattern, $post_content, $link_url))
			return $link_url[0];
		else
			return $fallback;
	}
}


//Retrieve page number for the current post or page
if(!function_exists('cpotheme_current_page')){
	function cpotheme_current_page(){
		$current_page = 1;
		if(is_front_page()){
			if(get_query_var('page')) $current_page = get_query_var('page'); else $current_page = 1;
		}else{
			if(get_query_var('paged')) $current_page = get_query_var('paged'); else $current_page = 1;
		}
		return $current_page;
	}
}


//Retrieve current post or taxonomy id
if(!function_exists('cpotheme_current_id')){
	function cpotheme_current_id(){
		$current_id = false;
		if(is_tax() || is_category() || is_tag()){ 
			$current_id = get_queried_object()->term_id;
		}else{
			global $post;
			if(isset($post->ID)) $current_id = $post->ID; else $current_id = false;
		}
		return $current_id;
	}
}


//Return true if posts should be displayed on homepage
function cpotheme_show_posts(){
	$display = false;
	if(!is_front_page() || cpotheme_get_option('home_posts') === true){
		$display = true;
	}
	return $display;
}


//Return true if page title should be displayed
function cpotheme_show_title(){
	$display = false;
	if(!is_front_page() && !is_home()){
		$display = true;
	}
	return $display;
}


//Add shortcode functionality to text widgets
add_filter('widget_text', 'do_shortcode');


//Custom function to do some cleanup on nested shortcodes
//Used for columns and layout-related shortcodes
if(!function_exists('cpotheme_do_shortcode')){
	function cpotheme_do_shortcode($content){ 
		$content = do_shortcode(shortcode_unautop($content)); 
		$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
		return $content;
	}
}

//Changes the brighness of a HEX color
if(!function_exists('cpotheme_alter_brightness')){
	function cpotheme_alter_brightness($colourstr, $steps) {
		$colourstr = str_replace('#','',$colourstr);
		$rhex = substr($colourstr,0,2);
		$ghex = substr($colourstr,2,2);
		$bhex = substr($colourstr,4,2);

		$r = hexdec($rhex);
		$g = hexdec($ghex);
		$b = hexdec($bhex);

		$r = max(0,min(255,$r + $steps));
		$g = max(0,min(255,$g + $steps));  
		$b = max(0,min(255,$b + $steps));
	  
		$r = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
		$g = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);  
		$b = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
		return '#'.$r.$g.$b;
	}
}


add_action('after_switch_theme', 'cpotheme_rewrite_flush');
function cpotheme_rewrite_flush(){
    flush_rewrite_rules();
}


//Returns the query for related portfolio items
if(!function_exists('cpotheme_related_query')){
	function cpotheme_related_query($id, $type = 'cpo_portfolio', $taxonomy = 'cpo_portfolio_category', $limit = 3){
		if(cpotheme_get_option('portfolio_related') == 1){
			$term_list = get_the_terms(get_the_ID(), $taxonomy);
			if(is_array($term_list)){
				$terms = array();
				foreach($term_list as $current_term)
					$terms[] = $current_term->term_id;
				$args = array(
				'post_type' => $type,
				'order' => 'ASC',
				'orderby' => 'menu_order',
				'posts_per_page' => $limit,
				'post__not_in' => array(get_the_ID()),
				'tax_query' => array(array('taxonomy' => $taxonomy, 'field' => 'id', 'terms' => $terms)));
				return $args;
			}
		}
		return false;
	}
}


function cpotheme_homepage_order($key){
	$order = cpotheme_get_option('home_order');
	$array = explode(',', $order);
	$count = 100;
	foreach($array as $current_value){
		if($key == $current_value){
			return $count;
		}
		$count += 100;
	}
	return $count;
}


//Sanitize boolean values
function cpotheme_sanitize_bool($data){
    if($data === true){
		return true;
	}
	return false;
}
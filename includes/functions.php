<?php 

//Get total counts of current page
function cpotheme_share_count($url){
	$json = @file_get_contents('http://api.sharedcount.com/?url='.rawurlencode($url));
	$counts = json_decode($json, true);
	$totalcounts = $counts['Twitter'] + $counts['Facebook']['total_count'] + $counts['GooglePlusOne'];
	return $totalcounts;
}


//Redirect visitors if not logged in
function cpotheme_login_redirect(){
	if(!is_user_logged_in()) wp_redirect(cpotheme_get_option('url_login'));
}

//Check if the user is currently subscribed
function cpotheme_subscription_status(){
	$result = false;
	$subscription = 26846;
	$user = get_current_user_id();
	
	if(current_user_can('manage_options')) return true;
	
	if(class_exists('EDD_Recurring_Customer') && function_exists('edd_has_user_purchased'))
		if(edd_has_user_purchased($user, $subscription) && EDD_Recurring_Customer::is_customer_active($user))
			$result = true;
	
	return $result;
}

//Hide admin bar for non-admins
add_filter('show_admin_bar', 'cpotheme_hide_admin_bar');
function cpotheme_hide_admin_bar(){
    if(!current_user_can('manage_options')) return false;
	return true;
}


add_action('init', 'cpotheme_register_new_user');
function cpotheme_register_new_user(){
    $error = false;
	if(isset($_POST['user_register'])){
		//Validate all fields
		$user_name = trim($_POST['user_name']);
		$user_first_name = trim($_POST['user_first_name']);
		$user_email = trim($_POST['user_email']);
		$user_password = trim($_POST['user_password']);
		$user_check = $_POST['user_check'];
		$user_details = $_POST['user_details'];
		
		//Validate Fields
		if($user_name == '' || $user_first_name == '' || $user_email == '' || $user_password == '' || $user_check != '')
			$error = true;
			
		//If validation is ok, attempt to register user
		if(!$error){
			$args = array(
			'first_name' => $user_first_name,
			'user_email' => $user_email,
			'user_login' => $user_name,
			'user_pass' => $user_password);
			
			$registered_id = wp_insert_user($args);
			
			//If user has been registered, proceed to insert metadata
			if(is_wp_error($registered_id)){
				$error = $registered_id->get_error_message();	
			}else{
				add_user_meta($registered_id, 'cpothemes_data', $user_details);
				//Sign user on
				$credentials['user_login'] = $user_email;
				$credentials['user_password'] = $user_password;
				$credentials['remember'] = true;
				$user = wp_signon($credentials, false);
				wp_set_current_user($registered_id);
				wp_set_auth_cookie($registered_id, 0, 0);

				
				//Redirect to success page
				wp_redirect(cpotheme_get_option('url_register').'?register=ok');
				exit();
			}
		}
	} 
}


//Add custom fields to support forum
add_action('bbp_theme_before_topic_form_content', 'cpotheme_bbp_fields');
function cpotheme_bbp_fields() {
	$value = get_post_meta(bbp_get_topic_id(), 'bbp_website_url', true);
	echo '<label for="bbp_website_url">'.__('URL of Your Site', 'cpotheme').'</label><br>';
	echo '<input type="text" name="bbp_website_url" value="'.$value.'">';
}

//Save custom fields in support forum
add_action('bbp_new_topic', 'cpotheme_bbp_save_fields', 10, 1);
add_action('bbp_edit_topic', 'cpotheme_bbp_save_fields', 10, 1);
function cpotheme_bbp_save_fields($topic_id = 0){
	if(isset($_POST) && $_POST['bbp_website_url'] != ''){
		update_post_meta($topic_id, 'bbp_website_url', $_POST['bbp_website_url']);
	}
}

//Display custom fields in forum
add_action('bbp_template_before_replies_loop', 'bbp_show_extra_fields');
function bbp_show_extra_fields(){
	if(current_user_can('manage_options')){
		$topic_id = bbp_get_topic_id();
		$value = get_post_meta($topic_id, 'bbp_website_url', true);
		if(!strstr($value, 'http')){
			$value = 'http://'.$value;
		}
		echo '<div style="clear:both; margin-bottom:30px" class="content-block">';
		echo 'URL: <a href="'.$value.'" target="_blank">'.$value.'</a><br>';
		echo '</div>';
	}
}
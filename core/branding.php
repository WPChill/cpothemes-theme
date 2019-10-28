<?php

//Adds custom css code in the admin header
if(!function_exists('cpotheme_branding_login')){
	add_action('login_head', 'cpotheme_branding_login');
	function cpotheme_branding_login(){
		$logo_url = cpotheme_get_option('login_logo');
		$bg_url = cpotheme_get_option('login_bg');
		$custom_css = cpotheme_get_option('login_css');
		
		echo '<style type="text/css">'; 
		if($bg_url != '') echo 'body.login { background:url('.$bg_url.') no-repeat center; } '; 
		if($logo_url != '') echo '#login h1 a { background:url('.$logo_url.') no-repeat center; } '; 
		echo $custom_css; 
		echo '</style>'; 
	}
}

//Modifies the login logo URL to a custom value
if(!function_exists('cpotheme_branding_login_url')){
	if(cpotheme_get_option('login_url') != '')
		add_filter('login_headerurl', 'cpotheme_branding_login_url', 10, 4);
	function cpotheme_branding_login_url(){
		return cpotheme_get_option('login_url');
	}
}

//Modifies the login logo URL to a custom value
if(!function_exists('cpotheme_login_title')){
	if(cpotheme_get_option('login_title') != '')
		add_filter('login_headertitle', 'cpotheme_branding_login_title', 10, 4);
	function cpotheme_branding_login_title(){
		return cpotheme_get_option('login_title');
	}
}

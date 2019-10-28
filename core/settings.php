<?php

//Display Settings page
if(!function_exists('cpotheme_settings')){
	function cpotheme_settings(){
		cpotheme_custom_form('cpotheme_settings', cpotheme_metadata_settings());
	}
}

//Save Settings page
if(!function_exists('cpotheme_settings_save')){
	add_action('admin_init', 'cpotheme_settings_save');
	function cpotheme_settings_save(){
		cpotheme_license_activate('cpotheme_settings');
		cpotheme_custom_save('cpotheme_settings', cpotheme_metadata_settings());
	}
}
	
//Install settings upon theme switch
if(!function_exists('cpotheme_settings_defaults')){
	//add_action('after_switch_theme', 'cpotheme_settings_defaults', 10, 2);
	function cpotheme_settings_defaults(){
		cpotheme_custom_install('cpotheme_settings', cpotheme_metadata_settings(), false);
	}
}
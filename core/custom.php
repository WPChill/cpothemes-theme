<?php

//Adds the admin custom pages for Theme Settings, SEO and Update
if(!function_exists('cpotheme_custom')){
	add_action('admin_menu', 'cpotheme_custom');
	function cpotheme_custom(){
		//Get the image path for the core icon
		$core_path = get_template_directory_uri().'/core/';
		if(defined('CPOTHEME_CORE')) $core_path = CPOTHEME_CORE;
		
		//Set up data to add admin menus
		//add_theme_page(__('Theme Options', 'cpotheme'), __('Theme Options', 'cpotheme'), 'edit_theme_options', 'cpotheme_settings', 'cpotheme_settings', $core_path.'images/icon_options.png', 50);
	}
}

//Build Settings Form
if(!function_exists('cpotheme_custom_form')){
	function cpotheme_custom_form($option_name, $option_list){ 
		wp_enqueue_style('cpotheme_admin');
		$option_name = $option_name.cpotheme_wpml_option_suffix(); ?>
		
		<div class="wrap">
			<div class="cpothemes-version">
				<span><?php printf(__('Version %s', 'cpotheme'), CPOTHEME_VERSION); ?></span>
				<span><?php printf(__('Core %s', 'cpotheme'), CPOCORE_VERSION); ?></span>
				<span><a href="//cpothemes.com/documentation?utm_source=theme%20settings&utm_medium=options&utm_campaign=themes" target="_blank"><?php _e('Help', 'cpotheme'); ?></a></span>
			</div>
			
			<h2><?php echo get_admin_page_title(); ?></h2>
			
			<?php //cpotheme_custom_header($option_list); ?>
			
			<div id="settingsmenu" class="cpothemes-menu">
				<?php cpotheme_custom_nav($option_list); ?>
			</div>

			<?php if(isset($_GET['ok'])): ?>
			<div id="message" class="updated">
				<p><strong><?php _e('Changes have been saved.', 'cpotheme'); ?></strong></p>
			</div>
			<?php endif; ?>
			<?php if(isset($_GET['error'])): ?>
			<div id="message" class="error">
				<p><strong><?php _e('Changes could not be saved.', 'cpotheme'); ?></strong></p>
			</div>
			<?php endif; ?> 
			
			<form name="cpotheme_custom_form" method="post" action="admin.php?page=<?php echo $_GET['page'].cpotheme_wpml_option_url(); ?>" enctype="multipart/form-data">
				<?php if(isset($_GET['tab']) && $_GET['tab'] != '') $current_tab = htmlentities($_GET['tab']); else $current_tab = ''; ?>
				<input type="hidden" name="cpotheme_custom_tab" id="cpotheme_custom_tab" value="<?php echo $current_tab; ?>" />
				<input type="hidden" name="cpotheme_custom_action" id="cpotheme_custom_action" value="<?php echo $option_name; ?>" />
				<?php cpotheme_custom_fields($option_list, $option_name); ?>
				<?php if(function_exists('wp_nonce_field')) wp_nonce_field('cpotheme_nonce'); ?>
			</form>
		</div>
	<?php }
}


//Create navigation menu for settings page
if(!function_exists('cpotheme_custom_nav')){
	function cpotheme_custom_nav($options){
		$field_list = $options;
		$output = '<ul>';
		$current_tab = '';
		if(isset($_GET['tab']) && $_GET['tab'] != '')
			$current_tab = htmlentities($_GET['tab']);
		$nav_count = 0;
		
		foreach($field_list as $current_field){
			if($current_field['type'] == 'separator'){
				$field_id = $current_field["id"];
				$field_name = $current_field["name"];
				$field_desc = $current_field['desc'];
				$output .= '<li id="'.$field_id.'" title="'.$field_desc.'" class="cpothemes-menu-item';
				if($current_tab == $field_id || ($current_tab == '' && $nav_count == 0)) $output .= ' active';
				$output .= '">'.$field_name.'</li>';
				$nav_count++;
			}
		}
		
		$output .= '</ul>';
		$output .= '<div class="cpothemes-languages">';
		$output .= cpotheme_wpml_nav();
		//$output .= '<a href="//www.cpothemes.com/support">'.__('Support', 'cpotheme').'</a>';
		$output .= '</div>';
		echo $output;
	}
}

//Display the options forms fields
if(!function_exists('cpotheme_custom_fields')){
	function cpotheme_custom_fields($options, $list_name){    
		$output = '';
		$tab_count = 0;
		$current_tab = '';
		if(isset($_GET['tab']) && $_GET['tab'] != '')
			$current_tab = htmlentities($_GET['tab']);
		$option_list = get_option($list_name, false);
	   
		foreach($options as $current_field_id => $current_field){
			
			//Set common attributes for each element
			$field_name = isset($current_field['id']) ? $current_field['id'] : '';
			$field_title = isset($current_field['name']) ? $current_field['name'] : '';
			$field_desc = isset($current_field['desc']) ? $current_field['desc'] : '';
			$field_type = isset($current_field['type']) ? $current_field['type'] : 'separator';
			
			$field_value = '';
			//$field_value = get_option($field_name);
			if($option_list && isset($option_list[$field_name])) $field_value = $option_list[$field_name];
			
			//Is a field block separator. Print a separate container.
			if($field_type == 'separator'){
				if($tab_count > 0):
					$output .= '<input class="cpothemes-submit button-primary" type="submit" name="cpotheme_settings_save" value="'.__('Save Settings', 'cpotheme').'" />';
					$output .= '</div>';
				endif;
				$output .= '<div class="cpothemes-block" id="'.$field_name.'_block"';
				if(($current_tab != '' && $current_tab != $field_name) || ($current_tab == '' && $tab_count > 0)) $output .= ' style="display:none;"';
				$output .= '>';
				$output .= '<input class="cpothemes-submit button-primary" type="submit" name="cpotheme_settings_save" value="'.__('Save Settings', 'cpotheme').'" />';
				$output .= '<div class="cpothemes-separator">';
				$output .= $field_title.'<br/><span class="separator-desc">'.$field_desc.'</span>';
				$output .= '</div>';
				$tab_count++;
				
			// Is a field divider
			}elseif($field_type == 'divider'){
				$output .= '<h3 class="cpothemes-divider">'.$field_title.'</h3>';
			
			//Is a normal field. Print field containers
			}else{
				$output .= '<div class="item';
				if($field_type == 'collection' || $field_type == 'code') $output .= ' item-wide';
				$output .= '">';
				$output .= '<label for="'.$field_name.'" class="field-title">'.$field_title.'</label>';
				$output .= '<div class="field-content">';
			}
			
			if($field_type == 'readonly')
				$output .= cpotheme_form_readonly($field_name, $field_value, $current_field);
			
			elseif($field_type == 'text')
				$output .= cpotheme_form_text($field_name, $field_value, $current_field);
			
			elseif($field_type == 'textarea')
				$output .= cpotheme_form_textarea($field_name, $field_value, $current_field);
			
			elseif($field_type == 'code')
				$output .= cpotheme_form_code($field_name, $field_value, $current_field);
			
			elseif($field_type == 'select')
				$output .= cpotheme_form_select($field_name, $field_value, $current_field['option'], $current_field);
			
			elseif($field_type == 'collection')
				$output .= cpotheme_form_collection($field_name, $field_value, $current_field['option'], $current_field);
			
			elseif($field_type == 'yesno' || $field_type == 'checkbox')
				$output .= cpotheme_form_yesno($field_name, $field_value, $current_field);
			
			elseif($field_type == 'color')
				$output .= cpotheme_form_color($field_name, $field_value);
			
			elseif($field_type == 'imagelist')
				$output .= cpotheme_form_imagelist($field_name, $field_value, $current_field['option'], $current_field);
				
			elseif($field_type == 'iconlist')
				$output .= cpotheme_form_iconlist($field_name, $field_value, $current_field);
				
			elseif($field_type == 'upload') 
				$output .= cpotheme_form_upload($field_name, $field_value);
			
			elseif($field_type == 'font') 
				$output .= cpotheme_form_font($field_name, $field_value, $current_field['option'], $current_field);
					
			//Separators
			if($field_type != 'separator' && $field_type != 'divider'){
				$output .= '</div>';
				$output .= '<div class="field-desc">'.$field_desc.'</div>';
				$output .= '</div>';
			}
			unset($current_field);
		}
		$output .= '<input class="cpothemes-submit button-primary" type="submit" name="cpotheme_settings_save" value="'.__('Save Settings', 'cpotheme').'" />';
		$output .= '</div>';
		echo $output;
	}
}

//Save all settings upon submitting the settings form
if(!function_exists('cpotheme_custom_save')){
	function cpotheme_custom_save($option_name, $option_fields){
		
		$lang_url = cpotheme_wpml_option_url();	
		$option_name = $option_name.cpotheme_wpml_option_suffix();
		if(isset($_POST['cpotheme_custom_tab']) && $_POST['cpotheme_custom_tab'] != '')
			$current_tab = '&tab='.htmlentities($_POST['cpotheme_custom_tab']);
		else
			$current_tab = '';
			
		//Check if we're submitting a custom page
		if(isset($_POST['cpotheme_custom_action']) && $_POST['cpotheme_custom_action'] == $option_name){
			if(!wp_verify_nonce($_POST['_wpnonce'], 'cpotheme_nonce')) header("Location: admin.php?page=".$_GET['page'].$lang_url."&error");
			

			//Get the option array, then update the array values
			$options_list = get_option($option_name, false);
			foreach($option_fields as $current_option){
				$field_id = $current_option["id"];
					
				//If the field has an update, process it.
				if(isset($_POST[$field_id])){
					$field_value = '';
					$field_value = $_POST[$field_id];
					if(!is_array($field_value)) $field_value = esc_attr(trim($field_value));

					$current_value = '';
					if(isset($options_list[$field_id]))
						$current_value = $options_list[$field_id];
					
					// Add option
					if($current_value == '' && $field_value != ''){
						$options_list[$field_id] = $field_value;
					}
					// Update option
					elseif($field_value != $current_value){
						$options_list[$field_id] = $field_value;
					}
					// Delete unused option
					elseif($field_value == ''){
						//TODO: Check default values
						$options_list[$field_id] = $field_value;
					}
				}
			}
			update_option($option_name, $options_list);
			
			header('Location: admin.php?page='.$_GET['page'].$current_tab.$lang_url."&ok");
		}
	}
}


if(!function_exists('cpotheme_custom_header')){
	function cpotheme_custom_header(){
		$theme_data = wp_get_theme(); ?>
		<div class="cpothemes-header">
			<div class="cpothemes-badge">
				<?php //_e('Version', 'cpotheme'); ?> 
				<?php echo $theme_data->get('Version'); ?>
			</div>
			
			<div class="cpothemes-header-title" id="cpothemes-header-title">
				<?php echo $theme_data->get('Name'); ?>
			</div>
			<div class="cpothemes-header-meta">
				<a target="_blank" href="//www.cpothemes.com/support"><?php _e('Theme Documentation', 'cpotheme'); ?></a>
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a target="_blank" href="//themeforest.net/user/cpothemes?ref=cpothemes"><?php _e('More Themes', 'cpotheme'); ?></a>
			</div>
		</div>
		
		<?php
	}
}

if(!function_exists('cpotheme_custom_support')){
	function cpotheme_custom_support(){
		$output = '';
		$output .= '<div class="cpothemes-support">';
		$output .= '<a target="_blank" href="//www.cpothemes.com/documentation">'.__('Theme Documentation', 'cpotheme').'</a>';
		$output .= '&nbsp;&nbsp;|&nbsp;&nbsp;';
		$output .= '<a target="_blank" href="//www.cpothemes.com/forums">'.__('Support Forum', 'cpotheme').'</a>';
		$output .= '</div>';
		return $output;
	}
}


if(!function_exists('cpotheme_custom_header_old')){
	function cpotheme_custom_header_old(){
		$theme_data = wp_get_theme(); ?>
		<div class="cpotheme-header">
			
			
			<div class="header-version">
				<div class="header-version-name">
					<?php _e('Theme Version', 'cpotheme'); ?>
				</div>
				<div class="header-version-number">
					<?php echo $theme_data->get('Version'); ?>
				</div>
			</div>
			
			<div class="header-title" id="cpo-header-title">
				<?php echo $theme_data->get('Name'); ?>
			</div>
			<div class="header-meta">
				<a target="_blank" href="//www.cpothemes.com/support"><?php _e('Theme Documentation', 'cpotheme'); ?></a>
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a target="_blank" href="//www.cpothemes.com/forums"><?php _e('Support Forums', 'cpotheme'); ?></a>
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a target="_blank" href="//www.cpothemes.com/themes"><?php _e('More Themes', 'cpotheme'); ?></a>
			</div>
		</div>
		
		<?php
	}
}


//Installs options with default values, without overriding existing ones
if(!function_exists('cpotheme_custom_install')){
	function cpotheme_custom_install($option_name, $option_fields, $overwrite){
		
		$lang_url = cpotheme_wpml_option_url();	
		$option_name = $option_name.cpotheme_wpml_option_suffix();
				
		//Get the option array, then update the array values
		$options_list = get_option($option_name, false);
		foreach($option_fields as $current_option){
			if(isset($current_option['id'])){
				$field_id = $current_option['id'];
				
				//Check if there's no value already set
				//If overwrite is set, replace values always
				if(!isset($options_list[$field_id]) || $overwrite){
					//If there's no default defined, set an empty string
					if(isset($current_option['std']))
						$field_default = $current_option['std'];
					else
						$field_default = '';
								
					$options_list[$field_id] = $field_default;
				}
			}
		}
		update_option($option_name, $options_list);
	}
}

//Create navigation menu for settings page
if(!function_exists('cpotheme_wpml_nav')){
	function cpotheme_wpml_nav(){
		$output = '';
		if(cpotheme_wpml_active()){
			$language_list = cpotheme_wpml_languages();
			
			//Get current language
			if(isset($_GET['lang'])){
				$active_language = trim(htmlentities($_GET['lang']));
			}else{
				$active_language = cpotheme_wpml_default_language();
			}
			
			$output = '';
			$first_link = true;
			foreach($language_list as $current_language){
				$language_code = $current_language['code'];
				$language_name = $current_language['display_name'];
				$language_active = false;
				//Disable link for default language
				if($active_language == $language_code)
					$language_active = true;
				
				if(!$first_link)
					$output .= ' | ';
				
				if($language_active)
					$output .= '<span><b>';
				else
					$output .= '<a href="admin.php?page='.$_GET['page'].'&lang='.$language_code.'">';
				
				$output .= $language_name;
				if(cpotheme_wpml_default_language() == $language_code) 
					$output .= ' ('.__('default', 'cpotheme').')';
				
				if($language_active)
					$output .= '</b></span>';
				else
					$output .= '</a>';
					
				$first_link = false;
			}
		return $output;
		}
	}
}

//Check if WPML is present and append language code to option array
//The default language should not be appended
if(!function_exists('cpotheme_wpml_option_suffix')){
	function cpotheme_wpml_option_suffix(){
		$language_code = '';
		if(cpotheme_wpml_active()){
			if(isset($_GET['lang']) && $_GET['lang'] != ''){
				$default_language = cpotheme_wpml_default_language();
				$active_language = trim(htmlentities($_GET['lang']));
				if($active_language != $default_language)
					$language_code = '_'.$active_language;
			}
		}
		return $language_code;
	}
}

//Return the language url for page redirections, empty if default language
if(!function_exists('cpotheme_wpml_option_url')){
	function cpotheme_wpml_option_url(){
		$lang_url = '';
		if(cpotheme_wpml_active()){
			if(isset($_GET['lang']) && $_GET['lang'] != ''){
				$default_language = cpotheme_wpml_default_language();
				$active_language = trim(htmlentities($_GET['lang']));
				if($active_language != $default_language)
					$lang_url = '&lang='.$active_language;
			}
		}
		return $lang_url;
	}
}
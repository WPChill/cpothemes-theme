<?php 

//Print HTML for an icon
//TODO: Icon value should be in the format 'fontawesome-\f001'
if(!function_exists('cpotheme_icon')){
	function cpotheme_icon($value, $wrapper = '', $echo = true){
		if($value === '0' || $value === 0 || $value === '') return;
		
		if(strpos($value, '-') === false){
			$font_library = 'fontawesome';
			$font_value = $value;
		}else{
			$icon_data = explode('-', $value);
			$font_library = $icon_data[0];
			$font_value = $icon_data[1];
		}
		
		$output = '';
		if($wrapper != '')
			$output .= '<div class="'.$wrapper.'">';
		$output .= cpotheme_get_icon($font_library, html_entity_decode($font_value));
		if($wrapper != '')
			$output .= '</div>';
		
		if($echo == false)
			return $output;
		else
			echo $output;
	}
}

//Retrieve the correct library
function cpotheme_get_icon($library, $value){
	$result = '';
	switch($library){
		case 'fontawesome': 
			$result = cpotheme_icon_library_fontawesome($value); 
		break;
		case 'linearicons': 
			$result = cpotheme_icon_library_linearicons($value); 
		break;
		case 'typicons': 
			$result = cpotheme_icon_library_typicons($value); 
		break;
		default: 
			$result = cpotheme_icon_library_fontawesome($value); 
		break;
	}
	return $result;
}


//Icon library for fontawesome
function cpotheme_icon_library_fontawesome($value){
	wp_enqueue_style('cpotheme-fontawesome');
	return '<span style="font-family:\'fontawesome\'">'.$value.'</span>';
}


//Icon library for linearicons
function cpotheme_icon_library_linearicons($value){
	wp_enqueue_style('cpotheme-linearicons');
	return '<span style="font-family:\'linearicons\'">'.$value.'</span>';
}


//Icon library for typicons
function cpotheme_icon_library_typicons($value){
	wp_enqueue_style('cpotheme-typicons');
	return '<span style="font-family:\'typicons\'">'.$value.'</span>';
}
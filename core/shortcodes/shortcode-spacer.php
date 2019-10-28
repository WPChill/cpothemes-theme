<?php 

/* Spacer Shortcode */
if(!function_exists('ctsc_shortcode_spacer')){
	function ctsc_shortcode_spacer($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		
		$attributes = extract(shortcode_atts(array(
		'height' => 'fade', 
		'id' => '',
		'class' => ''),
		$atts));		
		
		$element_height = $height != '' ? $height : '25';
		$element_class = ' '.$class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		$element_style = ' style="height:'.$element_height.'px"';
		
		$output = '<div class="ctsc-spacer '.$element_class.'"'.$element_id.$element_style.'></div>';
		return $output;
	}
	add_shortcode('spacer', 'ctsc_shortcode_spacer');
}
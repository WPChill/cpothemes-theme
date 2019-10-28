<?php 

/* Separator Shortcode */
if(!function_exists('ctsc_shortcode_separator')){
	function ctsc_shortcode_separator($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		
		$attributes = extract(shortcode_atts(array(
		'style' => '',
		'title' => '',
		'color' => '',
		'top' => '',
		'icon' => '',
		'id' => '',
		'class' => '',
		'animation' => ''
		), $atts));
		
		$element_style = ' ctsc-separator-'.esc_attr($style);
		$element_title = esc_attr($title);
		$element_color = esc_attr($color);
		$element_top = esc_attr($top);
		$element_icon = esc_attr($icon);
		$element_class = ' '.$class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
		
		//Background color -- if gradient is set, add it as well
		if($color != ''){
			$element_color = ' color:'.$color.';';
		}
		
		//Icon
		if($icon != '') 
			$element_class .= ' ctsc-separator-has-icon';
		
		$icon_styling = ' style="'.$element_color.'"';
		
		$output = '<div class="ctsc-separator'.$element_class.$element_style.'"'.$element_id.'>';
		$output .= '<div class="ctsc-separator-line"></div>';
		if($element_icon != '')
			$output .= '<div class="ctsc-separator-icon icon-'.$element_icon.'"'.$icon_styling.'></div>';
		if($element_top != '')
			$output .= '<a class="ctsc-separator-top ctsc-back-top" href="#top" rel="top">'.$element_top.'</a>';
		if($element_title != '') 
			$output .= '<div class="ctsc-separator-title">'.$element_title.'</div>';
		$output .= '<div class="clear"></div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('separator', 'ctsc_shortcode_separator');
}
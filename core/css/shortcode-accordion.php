<?php 

/* Accordion Shortcode */
if(!function_exists('ctsc_shortcode_accordion')){
	function ctsc_shortcode_accordion($atts, $content = null){
		//Enqueue necessary scripts
		wp_enqueue_script('ctsc-toggles');
		wp_enqueue_style('ctsc-shortcodes');
		
		$attributes = extract(shortcode_atts(array(
		'title' => '(No Title)', 
		'icon' => '', 
		'style' => '', 
		'state' => '',
		'group' => '',
		'id' => '',
		'class' => '',
		'animation' => ''
		),
		$atts));
		
		//Set default values
		$element_title = esc_attr($title);
		$element_color = '';
		$element_icon = '';
		$element_class = $class;
		$element_style = ' ctsc-accordion-'.$style;
		$element_state = '';
		$element_group = $group != '' ? ' data-group="'.$group.'"' : '';
		$element_display = ' style="display:none;"';
		$element_content = $content;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
				
		//Accordion Icon
		if($icon != ''){
			$element_icon = '<span class="ctsc-accordion-icon primary_color icon-'.esc_attr($icon).'"></span> ';
			wp_enqueue_style('ctsc-fontawesome');
		}
		
		//Accordion State
		if($state == 'open'){
			$element_state = ' ctsc-accordion-open';
			$element_display = '';
		}
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
			
		$output = '<div class="ctsc-accordion'.$element_state.$element_style.$element_class.'"'.$element_id.$element_group.'>';
		$output .= '<h4 class="ctsc-accordion-title">'.$element_icon.$title.'</h4>';
		$output .= '<div class="ctsc-accordion-content"'.$element_display.'>'.ctsc_do_shortcode($content).'</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'accordion', 'ctsc_shortcode_accordion');
}
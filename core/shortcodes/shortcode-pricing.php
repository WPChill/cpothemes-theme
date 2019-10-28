<?php 

/* Pricing Item Shortcode */
if(!function_exists('ctsc_shortcode_pricing')){
	function ctsc_shortcode_pricing($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'type' => 'none',
		'title' => '',
		'subtitle' => '',
		'description' => '',
		'price' => '',
		'color' => '',
		'before' => '',
		'after' => '',
		'id' => '',
		'class' => '',
		'animation' => '',
		'download_id' => '',
		), $atts));
		$random_id = rand();
		
		
		//Set values
		$element_background = '';
		$element_color = '';
		$element_type = ' ctsc-pricing-'.$type;
		$element_content = esc_attr($content);
		$element_class = ' '.$class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
		
		//Background color -- if gradient is set, add it as well
		$title_styling = '';
		if($color != '')
			$title_styling = ' style="background:'.$color.'; color:#fff;"';
		
		
		$output = '';
		$output .= '<div class="ctsc-pricing '.$element_type.$element_class.'"'.$element_id.'>';
		
		//title
		if($title != ''){
			$output .= '<div class="ctsc-pricing-title"'.$title_styling.'>';
			$output .= $title;
			if($subtitle != '') 
				$output .= '<div class="ctsc-pricing-subtitle">'.$subtitle.'</div>';
			$output .= '</div>';
		}
		
		//Price
		if($price != '' || $download_id != '' ){
			$output .= '<div class="ctsc-pricing-price">';
			if($before != '') 
				$output .= '<span class="ctsc-pricing-before">'.esc_attr($before).'</span>';

			if ( $download_id != '' ) {
				$output .= '<span class="ctsc-pricing-price-value">'.ctsc_do_shortcode( '[edd_price id="' . $download_id . '"]' ).'</span>';
			}else {
				$output .= '<span class="ctsc-pricing-price-value">'.esc_attr($price).'</span>';
			}
			if($after != '') 
				$output .= '<span class="ctsc-pricing-after">'.esc_attr($after).'</span>';
			if($description != '') 
				$output .= '<span class="ctsc-pricing-description">'.esc_attr($description).'</span>';
			$output .= '</div>';
		}
		
		//Content
		$output .= '<div class="ctsc-pricing-content">';
		$output .= ctsc_do_shortcode($content);
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('pricing', 'ctsc_shortcode_pricing');
	add_shortcode('pricing_item', 'ctsc_shortcode_pricing');
}
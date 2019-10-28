<?php 


/* Leading Paragraph Shortcode */
if(!function_exists('ctsc_shortcode_leading')){
	function ctsc_shortcode_leading($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'icon' => ''), $atts));
		
		$content = trim($content);
		$output = '<span class="ctsc-leading">'.$content.'</span>';
		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'leading', 'ctsc_shortcode_leading');
}
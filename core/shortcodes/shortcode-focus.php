<?php

/* focus Shortcode */
if (!function_exists('ctsc_shortcode_focus')) {
    function ctsc_shortcode_focus($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(
            array(
        'style' => '',
        'color' => '',
        'background' => '',
        'gradient' => '',
        'id' => '',
        'class' => '',
        'animation' => ''),
            $atts
        ));
        $random_id = rand();
        
        //Set values
        $element_background = '';
        $element_color = '';
        $element_style = ' ctsc-focus-'.$style;
        $element_content = $content;
        $element_class = ' '.$class;
        $element_id = $id != '' ? ' id="'.$id.'"' : '';
        
        //Text color
        if ($color == 'dark') {
            $element_color = ' ctsc-dark';
        }
        
        $content = trim($content);
        
        //Background color -- if gradient is set, add it as well
        if ($background != '') {
            $element_background = ' background:'.$background.';';
            if ($gradient != '') {
                $element_background .= '
				background:-moz-linear-gradient(top, '.$background.' 0%, '.$gradient.' 100%);
				background:-webkit-linear-gradient(top, '.$background.' 0%, '.$gradient.' 100%); 
				background:linear-gradient(to bottom, '.$background.' 0%, '.$gradient.' 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$background.'\', endColorstr=\''.$gradient.'\',GradientType=0);';
            }
        }
        
        //Entrace effects and delay
        if ($animation != '') {
            wp_enqueue_script('ctsc-waypoints');
            wp_enqueue_script('ctsc-core');
            $element_class .= ' ctsc-animation ctsc-animation-'.$animation;
        }
        
        $element_styling = ' style="'.$element_background.'"';

        $output = '<div class="ctsc-focus'.$element_style.$element_color.$element_class.'"'.$element_id.$element_styling.'>';
        $output .= ctsc_do_shortcode($element_content);
        $output .= '</div>';
        return $output;
    }
    add_shortcode('focus', 'ctsc_shortcode_focus');
    add_shortcode('notice', 'ctsc_shortcode_focus');
}

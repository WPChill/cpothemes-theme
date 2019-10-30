<?php

/* Button Shortcode */
if (!function_exists('ctsc_shortcode_button')) {
    function ctsc_shortcode_button($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        
        $attributes = extract(shortcode_atts(
            array(
        'url' => '',
        'position' => '',
        'description' => '',
        'size' => '',
        'icon' => '',
        'color' => 'white',
        'background' => 'gray',
        'gradient' => '',
        'border' => '',
        'target' => '',
        'popup' => '',
        'rel' => '',
        'id' => '',
        'class' => '',
        'animation' => ''
        ),
            $atts
        ));
        
        //Set values
        $element_size = ' ctsc-button-'.trim(strip_tags($size));
        $element_background = '';
        $element_description = trim(strip_tags($description));
        $element_color = '';
        $element_border = '';
        $element_position = ' ctsc-button-'.$position;
        $element_url = esc_url($url);
        $element_content = esc_attr($content);
        $element_class = ' '.$class;
        $element_popup = $popup != '' ? ' data-ctsc-popup="'.$popup.'"' : '';
        $element_id = $id != '' ? ' id="'.$id.'"' : '';
        $element_target = $target != '' ? ' target="'.$target.'"' : '';
        $element_rel = $rel != '' ? ' rel="'.$rel.'"' : '';
        
        
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
    
        //Popup color
        if ($element_popup != '') {
            $element_class .= ' ctsc-popup-show';
        }
            
        //Text color
        if ($color != '') {
            $element_color = ' color:'.$color.';';
        }
            
        //Border style
        if ($border != '') {
            $element_border = ' border:'.$border.';';
        }
        
        //Icon and class
        if ($icon != '') {
            wp_enqueue_style('ctsc-fontawesome');
            $element_class .= ' ctsc-button-has-icon';
            $icon = '<span class="ctsc-button-icon icon-'.htmlentities($icon).'"></span> ';
        }
        
        //Entrance effects and delay
        if ($animation != '') {
            wp_enqueue_script('ctsc-waypoints');
            wp_enqueue_script('ctsc-core');
            $element_class .= ' ctsc-animation ctsc-animation-'.$animation;
        }
        
        $element_style = ' style="'.$element_background.$element_color.$element_border.'"';
        
        $output = '';
        $output .= '<a class="ctsc-button'.$element_size.$element_position.' '.$element_class.'" href="'.$url.'"'.$element_style.$element_id.$element_rel.$element_target.$element_popup.'>';
        
        //Button contents
        $output .= '<span class="ctsc-button-content">';
        $output .= $icon;
        $output .= '<span class="ctsc-button-text">'.$content.'</span>';
        if ($element_description != '') {
            $output .= '<span class="ctsc-button-description">'.$element_description.'</span>';
        }
        $output .= '</span>';
        
        $output .= '</a>';
        return $output;
    }
    add_shortcode('button', 'ctsc_shortcode_button');
}

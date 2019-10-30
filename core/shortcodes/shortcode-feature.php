<?php

/* Feature Block Shortcode */
if (!function_exists('ctsc_shortcode_feature')) {
    function ctsc_shortcode_feature($atts, $content = null)
    {
        wp_enqueue_style('ctsc-fontawesome');
        wp_enqueue_style('ctsc-shortcodes');
        
        $attributes = extract(shortcode_atts(
            array(
        'title' => '(No Title)',
        'icon' => '',
        'color' => '',
        'image' => '',
        'background' => '',
        'gradient' => '',
        'border' => '',
        'size' => '',
        'style' => '',
        'layout' => '',
        'url' => '',
        'id' => '',
        'class' => '',
        'animation' => ''
        ),
            $atts
        ));
        
        //Set values
        $element_size = ' ctsc-feature-'.trim(strip_tags($size));
        $element_style = ' ctsc-feature-'.$style;
        $element_class = $class;
        $element_url = esc_url($url);
        $element_title = esc_attr($title);
        $element_content = $content;
        $element_image = '';
        $element_background = '';
        $element_color = '';
        $element_border = '';
        $element_id = $id != '' ? ' id="'.$id.'"' : '';
        
        //Background color -- if gradient is set, add it as well
        if ($image != '') {
            $element_image = ctsc_image_url($image);
            $element_class .= ' ctsc-feature-has-image';
        }
        if ($background != '') {
            $element_background = ' background-color:'.$background.';';
            $element_class .= ' ctsc-feature-has-icon';
            if ($gradient != '') {
                $element_background .= '
				background-color:-moz-linear-gradient(top, '.$background.' 0%, '.$gradient.' 100%);
				background-color:-webkit-linear-gradient(top, '.$background.' 0%, '.$gradient.' 100%); 
				background-color:linear-gradient(to bottom, '.$background.' 0%, '.$gradient.' 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$background.'\', endColorstr=\''.$gradient.'\',GradientType=0);';
            }
        }

        //Text color
        if ($color != '') {
            $element_color = ' color:'.$color.';';
        }
            
        //Border style
        if ($border != '') {
            $element_border = ' border:'.$border.';';
        }
        
        //Entrace effects and delay
        if ($animation != '') {
            wp_enqueue_script('ctsc-waypoints');
            wp_enqueue_script('ctsc-core');
            $element_class .= ' ctsc-animation ctsc-animation-'.$animation;
        }
        
        $element_icon_style = ' style="'.$element_background.$element_color.$element_border.'"';
        
        $output = '<div class="ctsc-feature '.$element_size.$element_style.$element_class.'"'.$element_id.'>';
        if ($image != '') {
            $output .= '<div class="ctsc-feature-image"><img src="'.$element_image.'"></div>';
        } elseif ($icon != '') {
            wp_enqueue_style('style_fontawesome');
            $output .= '<div class="ctsc-feature-icon"'.$element_icon_style.'><span class="icon-'.$icon.'"></span></div>';
        }
        $output .= '<div class="ctsc-feature-body">';
        $output .= '<h4 class="ctsc-feature-title">';
        
        if ($element_url != '') {
            $output .= '<a href="'.$element_url.'">';
        }
        $output .= $title;
        if ($element_url != '') {
            $output .= '</a>';
        }
        $output .= '</h4>';
        $output .= '<div class="ctsc-feature-content">'.ctsc_do_shortcode($content).'</div>';
        $output .= '</div>';
        
        $output .= '</div>';
        
        return $output;
    }
    add_shortcode('feature', 'ctsc_shortcode_feature');
}

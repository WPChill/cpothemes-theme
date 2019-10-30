<?php


/* ctsc-column Wrapper Shortcode - Alternate Markup */
if (!function_exists('ctsc_shortcode_columns')) {
    function ctsc_shortcode_columns($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('number' => '2'), $atts));
        return '<div class="ctsc-columns ctsc-col'.$number.'">'.ctsc_do_shortcode($content).'<div class="ctsc-col-divide"></div></div>';
    }
    add_shortcode('columns', 'ctsc_shortcode_columns');
}


/* Single ctsc-column Shortcode - Alternate Markup */
if (!function_exists('ctsc_shortcode_column_single')) {
    function ctsc_shortcode_column_single($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $content = $content;
        return '<div class="ctsc-column">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column', 'ctsc_shortcode_column_single');
}


/* Half ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column2')) {
    function ctsc_shortcode_column2($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col2'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_half', 'ctsc_shortcode_column2');
}

/* Half Last ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column2_last')) {
    function ctsc_shortcode_column2_last($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col2 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
    }
    add_shortcode('column_half_last', 'ctsc_shortcode_column2_last');
}



/* Third ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column3')) {
    function ctsc_shortcode_column3($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col3'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_third', 'ctsc_shortcode_column3');
}

/* Two-Thirds ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column3x2')) {
    function ctsc_shortcode_column3x2($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col3x2'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_two_thirds', 'ctsc_shortcode_column3x2');
}

/* Third Last ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column3_last')) {
    function ctsc_shortcode_column3_last($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col3 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
    }
    add_shortcode('column_third_last', 'ctsc_shortcode_column3_last');
}

/* Two-Thirds Last ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column3x2_last')) {
    function ctsc_shortcode_column3x2_last($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col3x2 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
    }
    add_shortcode('column_two_thirds_last', 'ctsc_shortcode_column3x2_last');
}



/* Quarter ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column4')) {
    function ctsc_shortcode_column4($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col4'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_fourth', 'ctsc_shortcode_column4');
}

/* Three-Quarters ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column4x3')) {
    function ctsc_shortcode_column4x3($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col4x3'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_three_fourths', 'ctsc_shortcode_column4x3');
}

/* Quarter Last ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column4_last')) {
    function ctsc_shortcode_column4_last($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col4 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
    }
    add_shortcode('column_fourth_last', 'ctsc_shortcode_column4_last');
}

/* Three-Quarters Last ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column4x3_last')) {
    function ctsc_shortcode_column4x3_last($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col4x3 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
    }
    add_shortcode('column_three_fourths_last', 'ctsc_shortcode_column4x3_last');
}



/* Fifth ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column5')) {
    function ctsc_shortcode_column5($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col5'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_fifth', 'ctsc_shortcode_column5');
}

/* Two-Fifths ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column5x2')) {
    function ctsc_shortcode_column5x2($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col5x2'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_two_fifths', 'ctsc_shortcode_column5x2');
}

/* Three-Fifths ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column5x3')) {
    function ctsc_shortcode_column5x3($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col5x3'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_three_fifths', 'ctsc_shortcode_column5x3');
}

/* Four-Fifths ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column5x4')) {
    function ctsc_shortcode_column5x4($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col5x4'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_four_fifths', 'ctsc_shortcode_column5x4');
}

/* Fifth Last ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column5_last')) {
    function ctsc_shortcode_column5_last($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col5 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
    }
    add_shortcode('column_fifth_last', 'ctsc_shortcode_column5_last');
}

/* Two-Fifths Last ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column5x2_last')) {
    function ctsc_shortcode_column5x2_last($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col5x2 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_two_fifths_last', 'ctsc_shortcode_column5x2_last');
}

/* Three-Fifths Last ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column5x3_last')) {
    function ctsc_shortcode_column5x3_last($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col5x3 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_three_fifths_last', 'ctsc_shortcode_column5x3_last');
}

/* Four-Fifths Last ctsc-column Shortcode */
if (!function_exists('ctsc_shortcode_column5x4_last')) {
    function ctsc_shortcode_column5x4_last($atts, $content = null)
    {
        wp_enqueue_style('ctsc-shortcodes');
        $attributes = extract(shortcode_atts(array('style' => ''), $atts));
        $style = $style == '' ? '' : ' ctsc-column-'.$style;
        return '<div class="ctsc-column ctsc-col5x4 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div>';
    }
    add_shortcode('column_four_fifths_last', 'ctsc_shortcode_column5x4_last');
}

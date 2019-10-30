<?php

//Standard text field
if (!function_exists('cpotheme_form_divider')) {
    function cpotheme_form_divider($name, $value, $args = null)
    {
        $output = '<div class="settings_divider" id="'.$name.'">'.htmlentities(stripslashes($value), ENT_QUOTES, "UTF-8").'</div>';
        return $output;
    }
}

//Read-only field
if (!function_exists('cpotheme_form_readonly')) {
    function cpotheme_form_readonly($name, $value, $args = null)
    {
        $output = '<input type="hidden" value="'.stripslashes($value).'" name="'.$name.'" id="'.$name.'"/>';
        $output .= '<span id="'.$name.'_value">'.stripslashes($value).'</span>';
        return $output;
    }
}

//Standard text field
if (!function_exists('cpotheme_form_text')) {
    function cpotheme_form_text($name, $value, $args = null)
    {
        if (isset($args['width'])) {
            $field_width = ' style="width:'.$args['width'].';"';
        } else {
            $field_width = '';
        }
        if (isset($args['placeholder'])) {
            $field_placeholder = ' placeholder="'.$args['placeholder'].'"';
        } else {
            $field_placeholder = '';
        }
        $output = '<input type="text" value="'.htmlentities(stripslashes($value), ENT_QUOTES, 'UTF-8').'" name="'.$name.'" id="'.$name.'"'.$field_width.$field_placeholder.'/>';
        return $output;
    }
}
    
//Textarea field
if (!function_exists('cpotheme_form_textarea')) {
    function cpotheme_form_textarea($name, $value, $args = null)
    {
        if (isset($args['placeholder'])) {
            $field_placeholder = ' placeholder="'.$args['placeholder'].'"';
        } else {
            $field_placeholder = '';
        }
        $output = '<textarea name="'.$name.'" id="'.$name.'"'.$field_placeholder.'>'.(stripslashes($value)).'</textarea>';
        return $output;
    }
}

//Code field
if (!function_exists('cpotheme_form_code')) {
    function cpotheme_form_code($name, $value, $args = null)
    {
        $code = isset($args['format']) ? $args['format'] : 'xml';
        if (isset($args['placeholder'])) {
            $field_placeholder = ' placeholder="'.$args['placeholder'].'"';
        } else {
            $field_placeholder = '';
        }
        wp_enqueue_script('cpotheme_script_codemirror');
        wp_enqueue_script('cpotheme_script_codemirror_'.$code);
        wp_enqueue_script('cpotheme_script_editor');
        wp_enqueue_style('cpotheme_style_codemirror');
        $output = '<textarea class="cpotheme-editor-'.$code.'" name="'.$name.'" id="'.$name.'"'.$field_placeholder.'>'.(stripslashes($value)).'</textarea>';
        return $output;
    }
}

//Checkbox field
if (!function_exists('cpotheme_form_checkbox')) {
    function cpotheme_form_checkbox($name, $value, $list, $args = null)
    {
        $output = '<input type="checkbox" value="1" name="'.$name.'" id="'.$name.'" '.checked($value, '1', false).'/>';
        return $output;
    }
}


//Checklist field
if (!function_exists('cpotheme_form_checklist')) {
    function cpotheme_form_checklist($name, $value, $list, $args = null)
    {
        $field_class = (isset($args['class']) ? $args['class'] : '');
        $output = '';
        $output = '<select class="cpometabox_field_select '.$field_class.'" name="'.$name.'" id="'.$name.'">';
        if (sizeof($list) > 0) {
            foreach ($list as $list_key => $list_content) {
                $field_name = $name.'['.$list_key.']';
                $field_content = $list_content;
                if (is_array($list_value)) {
                    $disabled = '';
                    if (isset($list_value['type']) && $list_value['type'] == 'separator') {
                        $disabled = ' disabled';
                    }
                    $output .= '<option value="'.htmlentities(stripslashes($list_key)).'"'.$disabled;
                    $output .= '>'.str_replace('&amp;', '&', htmlentities(stripslashes($list_value['name']), ENT_QUOTES, "UTF-8")).'</option>';
                } else {
                    $output = '<input type="checkbox" value="1" name="'.$field_name.'" id="'.$field_name.'" '.checked($value, '1', false).'/>';
                    
                    $output .= selected($value, $list_key, false);
                    $output .= '>'.str_replace('&amp;', '&', htmlentities(stripslashes($list_value), ENT_QUOTES, "UTF-8")).'</option>';
                }
            }
        }
        $output .= '';
        return $output;
    }
}


//Yes/No radio selection field
if (!function_exists('cpotheme_form_yesno')) {
    function cpotheme_form_yesno($name, $value, $args = null)
    {
        $checked_yes = '';
        $checked_no = ' checked';
        if ($value == '1') {
            $checked_yes = ' checked';
            $checked_no = '';
        }
        $output = '';
        $output .= '<label for="'.$name.'_yes">';
        $output .= '<input type="radio" name="'.$name.'" id="'.$name.'_yes" value="1" '.$checked_yes.'/>';
        $output .= __('Yes', 'cpotheme').'</label>';
        $output .= '&nbsp;&nbsp;&nbsp;&nbsp;';
        
        $output .= '<label for="'.$name.'_no">';
        $output .= '<input type="radio" name="'.$name.'" id="'.$name.'_no" value="0" '.$checked_no.'/>';
        $output .= __('No', 'cpotheme').'</label>';
        return $output;
    }
}


//Dropdown list field
if (!function_exists('cpotheme_form_select')) {
    function cpotheme_form_select($name, $value, $list, $args = null)
    {
        if (isset($args['width'])) {
            $field_width = ' style="width:'.$args['width'].';"';
        } else {
            $field_width = '';
        }
        $field_class = (isset($args['class']) ? $args['class'] : '');
        $output = '<select class="cpometabox_field_select '.$field_class.'" name="'.$name.'" id="'.$name.'"'.$field_width.'>';
        if (sizeof($list) > 0) {
            foreach ($list as $list_key => $list_value) {
                if (is_array($list_value)) {
                    $disabled = '';
                    if (isset($list_value['type']) && $list_value['type'] == 'separator') {
                        $disabled = ' disabled';
                    }
                    $output .= '<option value="'.htmlentities(stripslashes($list_key)).'"'.$disabled;
                    $output .= '>'.str_replace('&amp;', '&', htmlentities(stripslashes($list_value['name']), ENT_QUOTES, "UTF-8")).'</option>';
                } else {
                    $output .= '<option value="'.htmlentities(stripslashes($list_key)).'" ';
                    $output .= selected($value, $list_key, false);
                    $output .= '>'.str_replace('&amp;', '&', htmlentities(stripslashes($list_value), ENT_QUOTES, "UTF-8")).'</option>';
                }
            }
        }
        $output .= '</select>';
        return $output;
    }
}
    
//Image list selection
if (!function_exists('cpotheme_form_imagelist')) {
    function cpotheme_form_imagelist($name, $value, $list, $args = null)
    {
        $output = '<div id="'.$name.'_wrap">';
        foreach ($list as $list_key => $list_value) {
            $checked = null;
            $selected = null;
            if ($list_key == $value) {
                $checked = ' checked="checked"';
                $selected = ' class="selected"';
            }
            $output .= '<label class="form_image_list_item" for="'.$name.'_'.$list_key.'"><img '.$selected.' src="'.$list_value.'" alt="'.$list_key.'"/><br/>';
            $output .= '<input type="radio" name="'.$name.'" id="'.$name.'_'.$list_key.'" value="'.$list_key.'" '.$checked.'/>';
            $output .= '</label>';
        }
        $output .= '</div>';
        return $output;
    }
}


//Icon list selection
if (!function_exists('cpotheme_form_iconlist')) {
    function cpotheme_form_iconlist($name, $value, $args = null)
    {
        $output = '<div id="'.$name.'_wrap" class="cpotheme-iconlist">';
        
        $output .= '<label class="cpotheme-iconlist-item" for="'.$name.'_0"> ';
        $output .= '<input type="radio" name="'.$name.'" id="'.$name.'_0" value="0"/>';
        $output .= '</label>';
                
        $list = cpotheme_metadata_icons();
        foreach ($list as $library_key => $library_value) {
            $output .= '<div class="cpotheme-iconlist-heading">'.$library_value['name'].'</div>';
            foreach ($library_value['icons'] as $list_key => $list_value) {
                $checked = null;
                $selected = '';
                if ($library_key.'-'.$list_key === $value && $value != '') {
                    $checked = ' checked="checked"';
                    $selected = ' selected';
                }
                $output .= '<label class="cpotheme-iconlist-item'.$selected.'" style="font-family:\''.$library_key.'\';" for="'.$name.'_'.htmlentities(stripslashes($list_key)).'">';
                if ($list_key == '0') {
                    $output .= ' ';
                } else {
                    $output .= $list_key;
                }
                $output .= '<input type="radio" name="'.$name.'" id="'.$name.'_'.htmlentities(stripslashes($list_key)).'" value="'.htmlentities(stripslashes($library_key.'-'.$list_key)).'" '.$checked.'/>';
                $output .= '</label>';
            }
        }
        $output .= '</div>';
        return $output;
    }
}


//Expandable list of field elements-- can contain other fields
if (!function_exists('cpotheme_form_collection')) {
    function cpotheme_form_collection($name, $value, $list, $args = null)
    {
        $field_class = (isset($args['class']) ? $args['class'] : '');
        $output = '<div class="cpometabox-field-collection '.$field_class.'">';
        //Check that given value is an array. If empty, add a single row
        if (empty($value) || $value == '') {
            $value = array('');
        }
        
        $output .= '<table>';
        
        //Table header
        $output .= '<thead>';
        foreach ($list as $list_key => $list_value) {
            $field_title = isset($list_value['label']) ? $list_value['label'] : $list_value;
            $output .= '<th>'.$field_title.'</th>';
        }
        $output .= '</thead>';
        
        //Table contents
        
        $counter = -1;
        foreach ($value as $current_key => $current_value) {
            $counter++;
            $output .= '<tr class="collection-row" data-index="'.$current_key.'">';
            foreach ($list as $list_key => $list_value) {
                $output .= '<td>';
                
                //Save field data-- collections can be of any field type
                $field_name = $name.'['.$current_key.']['.$list_key.']';
                $field_type = isset($list_value['type']) ? $list_value['type'] : 'text';
                $field_args = isset($list_value['args']) ? $list_value['args'] : null;
                $field_options = isset($list_value['option']) ? $list_value['option'] : null;
                $field_value = isset($current_value[$list_key]) ? $current_value[$list_key] : '';
                
                //Display corresponding type of field
                if ($field_type == 'readonly') {
                    $output .= cpotheme_form_readonly($field_name, $field_value, $field_args);
                } elseif ($field_type == 'text') {
                    $output .= cpotheme_form_text($field_name, $field_value, $field_args);
                } elseif ($field_type == 'textarea') {
                    $output .= cpotheme_form_textarea($field_name, $field_value, $field_args);
                } elseif ($field_type == 'select') {
                    $output .= cpotheme_form_select($field_name, $field_value, $field_options, $field_args);
                } elseif ($field_type == 'checkbox') {
                    $output .= cpotheme_form_checkbox($field_name, $field_value, $field_args);
                } elseif ($field_type == 'yesno') {
                    $output .= cpotheme_form_yesno($field_name, $field_value, $field_args);
                } elseif ($field_type == 'color') {
                    $output .= cpotheme_form_color($field_name, $field_value);
                } elseif ($field_type == 'upload') {
                    $output .= cpotheme_form_upload($field_name, $field_value, null, $post);
                } elseif ($field_type == 'date') {
                    $output .= cpotheme_form_date($field_name, $field_value, null);
                }
                
                $output .= '</td>';
            }
            $output .= '<td>';
            $output .= '<a href="#" tabindex="-1" class="collection-remove-row">'.__('Remove', 'cpotheme').'</a>';
            $output .= '</td>';
            $output .= '</tr>';
        }
        $output .= '<tr>';
        $output .= '<td>';
        $output .= '<a href="#" class="button collection-add-row">'.__('Add Row', 'cpotheme').'</a>';
        $output .= '</td>';
        $output .= '</tr>';
        $output .= '</table>';
            
        $output .= '</div>';
        return $output;
    }
}
    

//Color Picker field
if (!function_exists('cpotheme_form_color')) {
    function cpotheme_form_color($name, $value, $args = null)
    {
        if (isset($args['placeholder'])) {
            $field_placeholder = ' placeholder="'.$args['placeholder'].'"';
        } else {
            $field_placeholder = '';
        }
        $output = '<div id="'.$name.'_wrap">';
        $output .= '<input type="text" class="color" value="'.esc_attr($value).'" name="'.$name.'" id="'.$name.'"'.$field_placeholder.' maxlength="7"/>';
        //$output .= '<div class="colorselector" id="'.$name.'_sample"></div>';
        $output .= '</div>';
        return $output;
    }
}



//Uploader using Media Library
if (!function_exists('cpotheme_form_upload')) {
    function cpotheme_form_upload($name, $value, $args = null, $post = null)
    {
        if (isset($args['placeholder'])) {
            $field_placeholder = ' placeholder="'.$args['placeholder'].'"';
        } else {
            $field_placeholder = '';
        }
        if (stripslashes($value) != '') {
            $image = stripslashes($value);
        } elseif (defined('CPOTHEME_CORE_URL')) {
            $image = CPOTHEME_CORE_URL.'/images/noimage.jpg';
        } else {
            $image = get_template_directory_uri().'/core/images/noimage.jpg';
        }
        
        $output = '<input class="upload_field" type="upload" value="'.stripslashes($value).'" name="'.$name.'" id="'.$name.'-field"/>';
        $output .= '<input class="upload_button" type="button" value="'.__('Upload', 'cpotheme').'" name="'.$name.'" id="'.$name.'-button"/>';
        $output .= '<img class="upload_preview" id="'.$name.'-preview" src="'.$image.'"/>';
        return $output;
    }
}
    
//Font selector field
if (!function_exists('cpotheme_form_font')) {
    function cpotheme_form_font($name, $value, $list, $args = null)
    {
        $font_name = '';
        if (isset($list[$value])) {
            $font_name = $list[$value];
            $font_name = str_replace(' (Thin)', '', $font_name);
            $font_name = str_replace(' (Light)', '', $font_name);
            $font_name = str_replace(' (Bold)', '', $font_name);
        }
        $weight = '400';
        if (strpos($value, ':100') != false) {
            $weight = '100';
        }
        if (strpos($value, ':300') != false) {
            $weight = '300';
        }
        if (strpos($value, ':700') != false) {
            $weight = '700';
        }
        $output = cpotheme_form_select($name, $value, $list, array('class'=>'font_field'));
        $output .= '<div class="font_file" id="'.$name.'-file">';
        $output .= "<link href='//fonts.googleapis.com/css?family=".$value."' rel='stylesheet' type='text/css'>";
        $output .= '</div>';
        $output .= '<div type="text" class="font_preview" id="'.$name.'-preview" style="font-family:\''.$font_name.'\'; font-weight:'.$weight.';">'.__('This is a font preview image', 'cpotheme').'</div>';
        return $output;
    }
}
    
//Date picker field
if (!function_exists('cpotheme_form_date')) {
    function cpotheme_form_date($name, $value, $args = null)
    {
        if (isset($args['placeholder'])) {
            $field_placeholder = ' placeholder="'.$args['placeholder'].'"';
        } else {
            $field_placeholder = '';
        }
        if (isset($args['autocomplete'])) {
            $field_autocomplete = ' autocomplete="'.$args['placeholder'].'"';
        } else {
            $field_autocomplete = ' autocomplete="off"';
        }
        $output = '<input type="text" class="cpothemes-dateselector" value="'.stripslashes($value).'" name="'.$name.'" id="'.$name.'"'.$field_placeholder.$field_autocomplete.'/>';
        return $output;
    }
}

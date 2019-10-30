<?php
// Prints meta field HTML in user pages
if (!function_exists('cpotheme_user_fields')) {
    function cpotheme_user_fields($user, $metadata, $title = '')
    {
        if (empty($metadata)) {
            return;
        }
        $output = '';
        
        
        if ($title != '') {
            $output .= '<h3>'.$title.'</h3>';
        }
        
        if (!empty($metadata) && is_array($metadata)) {
            foreach ($metadata as $current_meta) {
                $field_name = $current_meta['name'];
                $field_title = $current_meta['label'];
                $field_desc = $current_meta['desc'];
                $field_type = $current_meta['type'];
                $field_value = '';
                $field_value = get_user_meta($user->ID, $field_name, true);
                
                //Additional CSS classes depending on field type
                $field_classes = '';
                if ($field_type == 'collection') {
                    $field_classes = ' cpometabox-wide';
                }
                
                $output .= '<div class="cpometabox '.$field_classes.'"><div class="name">'.$field_title.'</div>';
                $output .= '<div class="field">';
                
                // Print metaboxes here. Develop different cases for each type of field.
                if ($field_type == 'readonly') {
                    $output .= cpotheme_form_readonly($field_name, $field_value, $current_field);
                } elseif ($field_type == 'text') {
                    $output .= cpotheme_form_text($field_name, $field_value, $current_meta);
                } elseif ($field_type == 'textarea') {
                    $output .= cpotheme_form_textarea($field_name, $field_value, $current_meta);
                } elseif ($field_type == 'select') {
                    $output .= cpotheme_form_select($field_name, $field_value, $current_meta['option'], $current_meta);
                } elseif ($field_type == 'collection') {
                    $output .= cpotheme_form_collection($field_name, $field_value, $current_meta['option'], $current_meta);
                } elseif ($field_type == 'checkbox') {
                    $output .= cpotheme_form_checkbox($field_name, $field_value, $current_meta['option'], $current_meta);
                } elseif ($field_type == 'yesno') {
                    $output .= cpotheme_form_yesno($field_name, $field_value, $current_meta);
                } elseif ($field_type == 'color') {
                    $output .= cpotheme_form_color($field_name, $field_value);
                } elseif ($field_type == 'imagelist') {
                    $output .= cpotheme_form_imagelist($field_name, $field_value, $current_meta['option'], $current_meta);
                } elseif ($field_type == 'upload') {
                    $output .= cpotheme_form_upload($field_name, $field_value, null, $user);
                } elseif ($field_type == 'date') {
                    $output .= cpotheme_form_date($field_name, $field_value, null);
                }
                    
                $output .= '</div>';
                $output .= '<div class="desc">'.$field_desc.'</div></div>';
            }
            echo $output;
        }
    }
}

    
// Saves meta field data into database
if (!function_exists('cpotheme_user_fields_save')) {
    function cpotheme_user_fields_save($user_id, $metadata)
    {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }
        
        //Check every option, and process the ones there's an update for.
        if (!empty($metadata) && is_array($metadata)) {
            foreach ($metadata as $current_meta) {
                $field_name = $current_meta['name'];
                
                //If the field has an update, process it.
                if (isset($_POST[$field_name])) {
                    $field_value = $_POST[$field_name];
                    
                    // Delete unused metadata
                    if (empty($field_value) || $field_value == '') {
                        delete_user_meta($user_id, $field_name);
                    // Update metadata
                    } else {
                        update_user_meta($user_id, $field_name, $field_value);
                    }
                }
            }
        }
    }
}

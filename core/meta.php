<?php
// Prints meta field HTML
if (!function_exists('cpotheme_meta_fields')) {
    function cpotheme_meta_fields($post, $cpo_metadata = null)
    {
        if ($cpo_metadata == null || sizeof($cpo_metadata) == 0) {
            return;
        }
        $output = '';
        wp_enqueue_style('cpotheme_admin');
        wp_nonce_field('cpotheme_savemeta', 'cpotheme_nonce');
        
        foreach ($cpo_metadata as $current_meta) {
            $field_name = $current_meta["name"];
            $field_title = $current_meta['label'];
            $field_desc = $current_meta['desc'];
            $field_type = $current_meta['type'];
            $field_value = '';
            $field_value = get_post_meta($post->ID, $field_name, true);
            
            //Additional CSS classes depending on field type
            $field_classes = '';
            if ($field_type == 'collection') {
                $field_classes = ' cpometabox-wide';
            }
            
            $output .= '<div class="cpometabox '.$field_classes.'"><div class="name">'.$field_title.'</div>';
            $output .= '<div class="field">';
            
            // Print metaboxes here. Develop different cases for each type of field.
            if ($field_type == 'readonly') {
                $output .= cpotheme_form_readonly($field_name, $field_value);
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
            } elseif ($field_type == 'iconlist') {
                $output .= cpotheme_form_iconlist($field_name, $field_value, $current_meta);
            } elseif ($field_type == 'upload') {
                $output .= cpotheme_form_upload($field_name, $field_value, null, $post);
            } elseif ($field_type == 'date') {
                $output .= cpotheme_form_date($field_name, $field_value, null);
            }
                
            $output .= '</div>';
            $output .= '<div class="desc">'.$field_desc.'</div></div>';
        }
        echo $output;
    }
}
    
// Saves meta field data into database
if (!function_exists('cpotheme_meta_save')) {
    function cpotheme_meta_save($option)
    {
        if (!isset($_POST['post_ID']) || !current_user_can('edit_posts')) {
            return;
        }
        
        if ( isset( $_POST[ 'cpotheme_nonce' ] ) && !wp_verify_nonce($_POST['cpotheme_nonce'], 'cpotheme_savemeta')) {
            return;
        }
        
        $cpo_metaboxes = $option;
        $post_id = $_POST['post_ID'];
            
        //Check if we're editing a post
        if (isset($_POST['action']) && $_POST['action'] == 'editpost') {
            
            //Check every option, and process the ones there's an update for.
            if (sizeof($cpo_metaboxes) > 0) {
                foreach ($cpo_metaboxes as $current_meta) {
                    $field_name = $current_meta['name'];
                
                    //If the field has an update, process it.
                    if (isset($_POST[$field_name])) {
                        if (!is_array($_POST[$field_name])) {
                            $field_value = esc_html($_POST[$field_name]);
                        } else {
                            $field_value = $_POST[$field_name];
                        }
                    
                        // Delete unused metadata
                        if (empty($field_value) || $field_value == '') {
                            delete_post_meta($post_id, $field_name, get_post_meta($post_id, $field_name, true));
                        }
                        // Update metadata
                        else {
                            update_post_meta($post_id, $field_name, $field_value);
                        }
                    }
                }
            }
        }
    }
}

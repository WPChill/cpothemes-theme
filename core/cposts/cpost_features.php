<?php

//FEATURES POST TYPE DEFINITION
//Features are the building blocks of the homepage, used in many different styles
if (defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true) {
    add_action('init', 'cpotheme_cpost_features');
    add_filter('manage_edit-cpo_feature_columns', 'cpotheme_cpost_features_columns');
}

//Define features post type
if (!function_exists('cpotheme_cpost_features')) {
    function cpotheme_cpost_features()
    {
        //Set up labels
        $labels = array('name' => __('Features', 'cpotheme'),
        'singular_name' => __('Feature', 'cpotheme'),
        'add_new' => __('Add Feature', 'cpotheme'),
        'add_new_item' => __('Add New Feature', 'cpotheme'),
        'edit_item' => __('Edit Feature', 'cpotheme'),
        'new_item' => __('New Feature', 'cpotheme'),
        'view_item' => __('View Features', 'cpotheme'),
        'search_items' => __('Search Features', 'cpotheme'),
        'not_found' =>  __('No features found.', 'cpotheme'),
        'not_found_in_trash' => __('No features found in the trash.', 'cpotheme'),
        'parent_item_colon' => '');
        
        $fields = array('labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-star-filled',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'));
        
        register_post_type('cpo_feature', $fields);
    }
}

//Define admin columns in features post type
if (!function_exists('cpotheme_cpost_features_columns')) {
    function cpotheme_cpost_features_columns($columns)
    {
        $columns = array(
        'cb' => '<input type="checkbox" />',
        'cpo-image' => __('Image', 'cpotheme'),
        'title' => __('Title', 'cpotheme'),
        'date' => __('Date', 'cpotheme'),
        'comments' => '<span class="vers"><span title="'.__('Comments', 'cpotheme').'" class="comment-grey-bubble"></span></span>',
        'author' => __('Author', 'cpotheme'),
        );
        return $columns;
    }
}

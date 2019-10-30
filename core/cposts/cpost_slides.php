<?php

//SLIDES POST TYPE DEFINITION
//Slides are used as the opening content piece in the homepage
if (defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true) {
    add_action('init', 'cpotheme_cpost_slides');
    add_filter('manage_edit-cpo_slide_columns', 'cpotheme_cpost_slides_columns');
}

//Define slides post type
if (!function_exists('cpotheme_cpost_slides')) {
    function cpotheme_cpost_slides()
    {
        //Set up labels
        $labels = array('name' => __('Slides', 'cpotheme'),
        'singular_name' => __('Slide', 'cpotheme'),
        'add_new' => __('New Slide', 'cpotheme'),
        'add_new_item' => __('Add New Slide', 'cpotheme'),
        'edit_item' => __('Edit Slide', 'cpotheme'),
        'new_item' => __('New Slide', 'cpotheme'),
        'view_item' => __('View Slide', 'cpotheme'),
        'search_items' => __('Search Slides', 'cpotheme'),
        'not_found' =>  __('No slides were found.', 'cpotheme'),
        'not_found_in_trash' => __('No slides were found in the trash.', 'cpotheme'),
        'parent_item_colon' => '');
        
        $fields = array('labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-images-alt2',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'));
        
        register_post_type('cpo_slide', $fields);
    }
}

//Define admin columns in slides post type
if (!function_exists('cpotheme_cpost_slides_columns')) {
    function cpotheme_cpost_slides_columns($columns)
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

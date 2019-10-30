<?php

//CLIENT POST TYPE DEFINITION
//Clients are used as block elements that display the opinions and thoughts of others.
if (defined('CPOTHEME_USE_CLIENTS') && CPOTHEME_USE_CLIENTS == true) {
    add_action('init', 'cpotheme_cpost_clients');
    add_filter('manage_edit-cpo_client_columns', 'cpotheme_cpost_clients_columns');
}

//Define clients post type
if (!function_exists('cpotheme_cpost_clients')) {
    function cpotheme_cpost_clients()
    {
        //Set up labels
        $labels = array('name' => __('Clients', 'cpotheme'),
        'singular_name' => __('Client', 'cpotheme'),
        'add_new' => __('Add Client', 'cpotheme'),
        'add_new_item' => __('Add New Client', 'cpotheme'),
        'edit_item' => __('Edit Client', 'cpotheme'),
        'new_item' => __('New Client', 'cpotheme'),
        'view_item' => __('View Client', 'cpotheme'),
        'search_items' => __('Search Clients', 'cpotheme'),
        'not_found' =>  __('No clients found.', 'cpotheme'),
        'not_found_in_trash' => __('No clients found in the trash.', 'cpotheme'),
        'parent_item_colon' => '');
        
        $fields = array('labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-businessman',
        'menu_position' => null,
        'supports' => array('title', 'excerpt', 'thumbnail', 'page-attributes'));
        
        register_post_type('cpo_client', $fields);
    }
}

//Define admin columns in clients post type
if (!function_exists('cpotheme_cpost_clients_columns')) {
    function cpotheme_cpost_clients_columns($columns)
    {
        $columns = array(
        'cb' => '<input type="checkbox" />',
        'cpo-image' => __('Image', 'cpotheme'),
        'title' => __('Title', 'cpotheme'),
        'date' => __('Date', 'cpotheme'),
        'author' => __('Author', 'cpotheme'),
        );
        return $columns;
    }
}

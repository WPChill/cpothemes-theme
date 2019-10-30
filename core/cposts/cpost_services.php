<?php

//PORTFOLIO POST TYPE DEFINITION
//Portfolios are a generic content unit, used for projects, clients, or works
if (defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true) {
    add_action('init', 'cpotheme_cpost_services');
    add_filter('manage_edit-cpo_service_columns', 'cpotheme_cpost_services_columns');
    add_action('init', 'cpotheme_tax_servicescategory');
    add_action('init', 'cpotheme_tax_servicestag');
    add_action('pre_get_posts', 'cpotheme_tax_services_query');
}

//Define services post type
if (!function_exists('cpotheme_cpost_services')) {
    function cpotheme_cpost_services()
    {
        //Set up labels
        $labels = array('name' => __('Services', 'cpotheme'),
        'singular_name' => __('Services', 'cpotheme'),
        'add_new' => __('Add Service', 'cpotheme'),
        'add_new_item' => __('Add New Service', 'cpotheme'),
        'edit_item' => __('Edit Service', 'cpotheme'),
        'new_item' => __('New Service', 'cpotheme'),
        'view_item' => __('View Service', 'cpotheme'),
        'search_items' => __('Search Services', 'cpotheme'),
        'not_found' =>  __('No services found.', 'cpotheme'),
        'not_found_in_trash' => __('No services found in the trash.', 'cpotheme'),
        'parent_item_colon' => '');
        
        $slug = cpotheme_get_option('slug_service');
        if ($slug == '') {
            $slug = 'service';
        }
        $fields = array('labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => apply_filters('cpotheme_slug_service', $slug)),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-archive',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'));
        
        register_post_type('cpo_service', $fields);
    }
}

//Define admin columns in services post type
if (!function_exists('cpotheme_cpost_services_columns')) {
    function cpotheme_cpost_services_columns($columns)
    {
        $columns = array(
        'cb' => '<input type="checkbox" />',
        'cpo-image' => __('Image', 'cpotheme'),
        'title' => __('Title', 'cpotheme'),
        'cpo-service-cats' => __('Categories', 'cpotheme'),
        'cpo-service-tags' => __('Tags', 'cpotheme'),
        'date' => __('Date', 'cpotheme'),
        'comments' => '<span class="vers"><span title="'.__('Comments', 'cpotheme').'" class="comment-grey-bubble"></span></span>',
        'author' => __('Author', 'cpotheme'),
        );
        return $columns;
    }
}
    
//Define services category taxonomy
if (!function_exists('cpotheme_tax_servicescategory')) {
    function cpotheme_tax_servicescategory()
    {
        $labels = array('name' => __('Service Categories', 'cpotheme'),
        'singular_name' => __('Service Category', 'cpotheme'),
        'add_new' => __('New Service Category', 'cpotheme'),
        'add_new_item' => __('Add Service Category', 'cpotheme'),
        'edit_item' => __('Edit Service Category', 'cpotheme'),
        'new_item' => __('New Service Category', 'cpotheme'),
        'view_item' => __('View Service Category', 'cpotheme'),
        'search_items' => __('Search Service Categories', 'cpotheme'),
        'not_found' =>  __('No services categories were found.', 'cpotheme'),
        'not_found_in_trash' => __('No services categories were found in the trash.', 'cpotheme'),
        'parent_item_colon' => '');
        
        $slug = cpotheme_get_option('slug_service_category');
        if ($slug == '') {
            $slug = 'service-category';
        }
        $fields = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => apply_filters('cpotheme_slug_service_category', $slug)),
        'hierarchical' => true);
        
        register_taxonomy('cpo_service_category', 'cpo_service', $fields);
    }
}
    
//Define services tag taxonomy
if (!function_exists('cpotheme_tax_servicestag')) {
    function cpotheme_tax_servicestag()
    {
        //Set up labels
        $labels = array('name' => __('Service Tags', 'cpotheme'),
        'singular_name' => __('Service Tag', 'cpotheme'),
        'add_new' => __('New Service Tag', 'cpotheme'),
        'add_new_item' => __('Add Service Tag', 'cpotheme'),
        'edit_item' => __('Edit Service Tag', 'cpotheme'),
        'new_item' => __('New Service Tag', 'cpotheme'),
        'view_item' => __('View Service Tag', 'cpotheme'),
        'search_items' => __('Search Service Tags', 'cpotheme'),
        'not_found' =>  __('No services tags were found.', 'cpotheme'),
        'not_found_in_trash' => __('No services tags were found in the trash.', 'cpotheme'),
        'parent_item_colon' => '');
        
        $slug = cpotheme_get_option('slug_service_tag');
        if ($slug == '') {
            $slug = 'service-tag';
        }
        $fields = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => apply_filters('cpotheme_slug_service_tag', $slug)),
        'hierarchical' => false);
        
        register_taxonomy('cpo_service_tag', 'cpo_service', $fields);
    }
}

//Modify main query on services categories and tags, to change number of posts equal to number of columns
if (!function_exists('cpotheme_tax_services_query')) {
    function cpotheme_tax_services_query($query)
    {
        if ((is_tax('cpo_service_category') && is_tax('cpo_service_tag')) && $query->is_main_query() && !is_admin()) {
            $columns = cpotheme_get_option('services_columns');
            if ($columns != '' && $columns > 0) {
                $post_number = cpotheme_get_option('services_columns') * 4;
                $query->set('posts_per_page', $post_number);
            }
        }
    }
}

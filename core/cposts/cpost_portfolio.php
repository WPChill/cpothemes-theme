<?php

//PORTFOLIO POST TYPE DEFINITION
//Portfolios are a generic content unit, used for projects, clients, or works
if (defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true) {
    add_action('init', 'cpotheme_cpost_portfolio');
    add_filter('manage_edit-cpo_portfolio_columns', 'cpotheme_cpost_portfolio_columns');
    add_action('init', 'cpotheme_tax_portfoliocategory');
    add_action('init', 'cpotheme_tax_portfoliotag');
    add_action('pre_get_posts', 'cpotheme_tax_portfolio_query');
}

//Define portfolio post type
if (!function_exists('cpotheme_cpost_portfolio')) {
    function cpotheme_cpost_portfolio()
    {
        $labels = array('name' => __('Portfolio', 'cpotheme'),
        'singular_name' => __('Portfolio', 'cpotheme'),
        'add_new' => __('Add Portfolio Item', 'cpotheme'),
        'add_new_item' => __('Add New Portfolio Item', 'cpotheme'),
        'edit_item' => __('Edit Portfolio Item', 'cpotheme'),
        'new_item' => __('New Portfolio Item', 'cpotheme'),
        'view_item' => __('View Portfolio', 'cpotheme'),
        'search_items' => __('Search Portfolio', 'cpotheme'),
        'not_found' =>  __('No portfolio items found.', 'cpotheme'),
        'not_found_in_trash' => __('No portfolio items found in the trash.', 'cpotheme'),
        'parent_item_colon' => '');
        
        $slug = cpotheme_get_option('slug_portfolio');
        if ($slug == '') {
            $slug = 'portfolio-item';
        }
        $fields = array('labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => apply_filters('cpotheme_slug_portfolio', $slug)),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-portfolio',
        'menu_position' => null,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'));
        
        register_post_type('cpo_portfolio', $fields);
    }
}

//Define admin columns in portfolio post type
if (!function_exists('cpotheme_cpost_portfolio_columns')) {
    function cpotheme_cpost_portfolio_columns($columns)
    {
        $columns = array(
        'cb' => '<input type="checkbox" />',
        'cpo-image' => __('Image', 'cpotheme'),
        'title' => __('Title', 'cpotheme'),
        'cpo-portfolio-cats' => __('Categories', 'cpotheme'),
        'cpo-portfolio-tags' => __('Tags', 'cpotheme'),
        'date' => __('Date', 'cpotheme'),
        'comments' => '<span class="vers"><span title="'.__('Comments', 'cpotheme').'" class="comment-grey-bubble"></span></span>',
        'author' => __('Author', 'cpotheme'),
        );
        return $columns;
    }
}
    
//Define portfolio category taxonomy
if (!function_exists('cpotheme_tax_portfoliocategory')) {
    function cpotheme_tax_portfoliocategory()
    {
        $labels = array('name' => __('Portfolio Categories', 'cpotheme'),
        'singular_name' => __('Portfolio Category', 'cpotheme'),
        'add_new' => __('New Portfolio Category', 'cpotheme'),
        'add_new_item' => __('Add Portfolio Category', 'cpotheme'),
        'edit_item' => __('Edit Portfolio Category', 'cpotheme'),
        'new_item' => __('New Portfolio Category', 'cpotheme'),
        'view_item' => __('View Portfolio Category', 'cpotheme'),
        'search_items' => __('Search Portfolio Categories', 'cpotheme'),
        'not_found' =>  __('No portfolio categories were found.', 'cpotheme'),
        'not_found_in_trash' => __('No portfolio categories were found in the trash.', 'cpotheme'),
        'parent_item_colon' => '');
        
        $slug = cpotheme_get_option('slug_portfolio_category');
        if ($slug == '') {
            $slug = 'portfolio-category';
        }
        $fields = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => apply_filters('cpotheme_slug_portfolio_category', $slug)),
        'hierarchical' => true);
        
        register_taxonomy('cpo_portfolio_category', 'cpo_portfolio', $fields);
    }
}
    
//Define portfolio tag taxonomy
if (!function_exists('cpotheme_tax_portfoliotag')) {
    function cpotheme_tax_portfoliotag()
    {
        //Set up labels
        $labels = array('name' => __('Portfolio Tags', 'cpotheme'),
        'singular_name' => __('Portfolio Tag', 'cpotheme'),
        'add_new' => __('New Portfolio Tag', 'cpotheme'),
        'add_new_item' => __('Add Portfolio Tag', 'cpotheme'),
        'edit_item' => __('Edit Portfolio Tag', 'cpotheme'),
        'new_item' => __('New Portfolio Tag', 'cpotheme'),
        'view_item' => __('View Portfolio Tag', 'cpotheme'),
        'search_items' => __('Search Portfolio Tags', 'cpotheme'),
        'not_found' =>  __('No portfolio tags were found.', 'cpotheme'),
        'not_found_in_trash' => __('No portfolio tags were found in the trash.', 'cpotheme'),
        'parent_item_colon' => '');
        
        $slug = cpotheme_get_option('slug_portfolio_tag');
        if ($slug == '') {
            $slug = 'portfolio-tag';
        }
        $fields = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => apply_filters('cpotheme_slug_portfolio_tag', $slug)),
        'hierarchical' => false);
        
        register_taxonomy('cpo_portfolio_tag', 'cpo_portfolio', $fields);
    }
}

//Modify main query on portfolio categories and tags, to change number of posts equal to number of columns
if (!function_exists('cpotheme_tax_portfolio_query')) {
    function cpotheme_tax_portfolio_query($query)
    {
        if ((is_tax('cpo_portfolio_category') && is_tax('cpo_portfolio_tag')) && $query->is_main_query() && !is_admin()) {
            $columns = cpotheme_get_option('portfolio_columns');
            if ($columns != '' && $columns > 0) {
                $post_number = cpotheme_get_option('portfolio_columns') * 4;
                $query->set('posts_per_page', $post_number);
            }
        }
    }
}

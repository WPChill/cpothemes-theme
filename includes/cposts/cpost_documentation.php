<?php
add_action('init', 'cpotheme_cpost_documentation');
function cpotheme_cpost_documentation()
{
    //Set up labels
    $labels = array('name' => 'Support Pages',
    'singular_name' => 'Support Page',
    'add_new' => 'Add Support Page',
    'add_new_item' => 'Add New Support Page',
    'edit_item' => 'Edit Support Page',
    'new_item' => 'New Support Page',
    'view_item' => 'View Support Page',
    'search_items' => 'Search Support Pages',
    'not_found' =>  'No support pages found.',
    'not_found_in_trash' => 'No support pages found in the trash.',
    'parent_item_colon' => '');
    
    $fields = array('labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'docs', 'with_front' => false),
    'capability_type' => 'post',
    'hierarchical' => true,
    'menu_icon' => 'dashicons-welcome-learn-more',
    'menu_position' => null,
    'supports' => array('title', 'editor', 'excerpt', 'page-attributes'));
    
    register_post_type('cpo_support', $fields);
}


add_action('init', 'cpotheme_tax_documentation');
function cpotheme_tax_documentation()
{
    //Set up labels
    $labels = array('name' => 'Support Categories',
    'singular_name' => 'Support Categories',
    'add_new' => 'New Support Categories',
    'add_new_item' => 'Add Support Categories',
    'edit_item' => 'Edit Support Categories',
    'new_item' => 'New Support Categories',
    'view_item' => 'View Support Categories',
    'search_items' => 'Search ',
    'not_found' =>  'No Support Categories found.',
    'not_found_in_trash' => 'No Support Categories found in the trash.',
    'parent_item_colon' => '');
    
    $fields = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => true,
    'rewrite' => array('slug' => 'theme-docs'),
    'hierarchical' => true);
    
    register_taxonomy('cpo_support_category', 'cpo_support', $fields);
}

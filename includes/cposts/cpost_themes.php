<?php

add_action('init', 'cpotheme_cpost_theme');
function cpotheme_cpost_theme() 
{
	//Set up labels
	$labels = array('name' => 'Themes',
	'singular_name' => 'Theme',
	'add_new' => 'Add Theme',
	'add_new_item' => 'Add New Theme',
	'edit_item' => 'Edit Theme',
	'new_item' => 'New Theme',
	'view_item' => 'View Theme',
	'search_items' => 'Search Theme',
	'not_found' =>  'No themes found.',
	'not_found_in_trash' => 'No themes found in the trash.', 
	'parent_item_colon' => '');
	
	$fields = array('labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => array('slug' => 'theme', 'with_front' => false),
	'capability_type' => 'post',
	'hierarchical' => false,
	'menu_icon' => 'dashicons-format-gallery',
	'menu_position' => null,
	'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')); 
	
	register_post_type('cpo_theme', $fields);
}


add_action('init', 'cpotheme_tax_theme');
function cpotheme_tax_theme() 
{
	//Set up labels
	$labels = array(
	'name' => 'Categories',
	'singular_name' => 'Category',
	'add_new' => 'New Category',
	'add_new_item' => 'Add Category',
	'edit_item' => 'Edit Category',
	'new_item' => 'New Category',
	'view_item' => 'Ver Category',
	'search_items' => 'Buscar Categories',
	'not_found' => 'No categories found.',
	'not_found_in_trash' => 'No categories found.', 
	'parent_item_colon' => '');
	
	$fields = array('labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'show_in_nav_menus' => true,
	'rewrite' => array('slug' => 'themes-category'),
	'capability_type' => 'post',
	'hierarchical' => true,
	'menu_icon' => get_bloginfo('url').'/wp-admin/images/generic.png',
	'menu_position' => null,
	'supports' => array('title', 'editor', 'thumbnail')); 
	
	register_taxonomy('cpo_theme_category', 'cpo_theme', $fields);
	
	
	//Theme Features
	/*$labels = array(
	'name' => 'Theme Features',
	'singular_name' => 'Theme Feature',
	'add_new' => 'New Feature',
	'add_new_item' => 'Add Feature',
	'edit_item' => 'Edit Feature',
	'new_item' => 'New Feature',
	'view_item' => 'Ver Feature',
	'search_items' => 'Search Features',
	'not_found' => 'No features found.',
	'not_found_in_trash' => 'No features found.', 
	'parent_item_colon' => '');
	
	$fields = array('labels' => $labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true, 
	'query_var' => true,
	'show_in_nav_menus' => true,
	'rewrite' => array('slug' => 'themes'),
	'capability_type' => 'post',
	'hierarchical' => true,
	'menu_position' => null,
	'supports' => array('title', 'editor', 'thumbnail')); 
	
	register_taxonomy('cpo_theme_feature', 'cpo_theme', $fields);*/
}
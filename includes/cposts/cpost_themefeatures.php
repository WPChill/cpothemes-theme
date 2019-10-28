<?php

add_action('init', 'cpotheme_cpost_themefeature');
function cpotheme_cpost_themefeature() 
{
	//Set up labels
	$labels = array('name' => 'Core Features',
	'singular_name' => 'Core Feature',
	'add_new' => 'Add Core Feature',
	'add_new_item' => 'Add New Core Feature',
	'edit_item' => 'Edit Core Feature',
	'new_item' => 'New Core Feature',
	'view_item' => 'View Core Features',
	'search_items' => 'Search Core Features',
	'not_found' =>  'No Core Features found.',
	'not_found_in_trash' => 'No Core Features found in the trash.', 
	'parent_item_colon' => '');
	
	$fields = array('labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => array('slug' => 'theme-feature', 'with_front' => false),
	'capability_type' => 'post',
	'hierarchical' => false,
	'menu_icon' => 'dashicons-star-filled',
	'show_in_menu' => 'edit.php?post_type=cpo_theme',
	'menu_position' => null,
	'supports' => array('title', 'editor', 'excerpt', 'page-attributes', 'thumbnail')); 
	
	register_post_type('cpo_themefeature', $fields);
}
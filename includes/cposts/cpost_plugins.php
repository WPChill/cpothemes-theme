<?php

add_action('init', 'cpotheme_cpost_plugin');
function cpotheme_cpost_plugin() 
{
	//Set up labels
	$labels = array('name' => 'Plugins',
	'singular_name' => 'Plugin',
	'add_new' => 'Add Plugin',
	'add_new_item' => 'Add New Plugin',
	'edit_item' => 'Edit Plugin',
	'new_item' => 'New Plugin',
	'view_item' => 'View Plugin',
	'search_items' => 'Search Plugin',
	'not_found' =>  'No plugins found.',
	'not_found_in_trash' => 'No plugins found in the trash.', 
	'parent_item_colon' => '');
	
	$fields = array('labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => array('slug' => 'plugin', 'with_front' => false),
	'capability_type' => 'post',
	'hierarchical' => false,
	'menu_icon' => 'dashicons-admin-plugins',
	'menu_position' => null,
	'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')); 
	
	register_post_type('cpo_plugin', $fields);
}
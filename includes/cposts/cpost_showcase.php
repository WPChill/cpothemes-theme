<?php

add_action('init', 'cpotheme_cpost_showcase');
function cpotheme_cpost_showcase() 
{
	//Set up labels
	$labels = array('name' => 'Showcases',
	'singular_name' => 'Showcase',
	'add_new' => 'New Showcase',
	'add_new_item' => 'Add New Showcase',
	'edit_item' => 'Edit Showcase',
	'new_item' => 'New Showcase',
	'view_item' => 'View Showcase',
	'search_items' => 'Search Showcases',
	'not_found' =>  'No showcases were found.',
	'not_found_in_trash' => 'No showcases were found in the trash.', 
	'parent_item_colon' => '');
	
	$fields = array('labels' => $labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true, 
	'query_var' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'menu_icon' => 'dashicons-awards',
	'menu_position' => null,
	'supports' => array('title', 'thumbnail')); 
	
	register_post_type('cpo_showcase', $fields);
}
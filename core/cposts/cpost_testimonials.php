<?php

//TESTIMONIAL POST TYPE DEFINITION
//Testimonials are used as block elements that display the opinions and thoughts of others.
if(defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true){
	add_action('init', 'cpotheme_cpost_testimonials');
	add_filter('manage_edit-cpo_testimonial_columns', 'cpotheme_cpost_testimonials_columns');
}	

//Define testimonials post type
if(!function_exists('cpotheme_cpost_testimonials')){
	function cpotheme_cpost_testimonials(){
		//Set up labels
		$labels = array('name' => __('Testimonials', 'cpotheme'),
		'singular_name' => __('Testimonial', 'cpotheme'),
		'add_new' => __('Add Testimonial', 'cpotheme'),
		'add_new_item' => __('Add New Testimonial', 'cpotheme'),
		'edit_item' => __('Edit Testimonial', 'cpotheme'),
		'new_item' => __('New Testimonial', 'cpotheme'),
		'view_item' => __('View Testimonial', 'cpotheme'),
		'search_items' => __('Search Testimonials', 'cpotheme'),
		'not_found' =>  __('No testimonials found.', 'cpotheme'),
		'not_found_in_trash' => __('No testimonials found in the trash.', 'cpotheme'), 
		'parent_item_colon' => '');
		
		$fields = array('labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-format-chat',
		'menu_position' => null,
		'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')); 
		
		register_post_type('cpo_testimonial', $fields);
	}
}

//Define admin columns in testimonials post type	
if(!function_exists('cpotheme_cpost_testimonials_columns')){
	function cpotheme_cpost_testimonials_columns($columns){
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
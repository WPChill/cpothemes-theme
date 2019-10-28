<?php

//PORTFOLIO POST TYPE DEFINITION
//Portfolios are a generic content unit, used for projects, clients, or works
if(defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true){
	add_action('init', 'cpotheme_cpost_team');
	add_filter('manage_edit-cpo_team_columns', 'cpotheme_cpost_team_columns');
	add_action('init', 'cpotheme_tax_teamcategory');
	add_action('pre_get_posts', 'cpotheme_tax_team_query');
}	

//Define team post type
if(!function_exists('cpotheme_cpost_team')){
	function cpotheme_cpost_team(){
		$labels = array('name' => __('Team Members', 'cpotheme'),
		'singular_name' => __('Team Member', 'cpotheme'),
		'add_new' => __('Add Team Member', 'cpotheme'),
		'add_new_item' => __('Add New Team Member', 'cpotheme'),
		'edit_item' => __('Edit Team Member', 'cpotheme'),
		'new_item' => __('New Team Member', 'cpotheme'),
		'view_item' => __('View Team Member', 'cpotheme'),
		'search_items' => __('Search Team Members', 'cpotheme'),
		'not_found' =>  __('No team members found.', 'cpotheme'),
		'not_found_in_trash' => __('No team members found in the trash.', 'cpotheme'), 
		'parent_item_colon' => '');
		
		$fields = array('labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-universal-access',
		'menu_position' => null,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes')); 
		
		register_post_type('cpo_team', $fields);
	}
}

//Define admin columns in team post type	
if(!function_exists('cpotheme_cpost_team_columns')){
	function cpotheme_cpost_team_columns($columns){
		$columns = array(
		'cb' => '<input type="checkbox" />',
		'cpo-image' => __('Image', 'cpotheme'),
		'title' => __('Title', 'cpotheme'),
		'cpo-team-cats' => __('Groups', 'cpotheme'),
		'date' => __('Date', 'cpotheme'),
		'author' => __('Author', 'cpotheme'),
		);
		return $columns;
	}
}
	
//Define team category taxonomy
if(!function_exists('cpotheme_tax_teamcategory')){
	function cpotheme_tax_teamcategory() 
	{
		$labels = array('name' => __('Member Groups', 'cpotheme'),
		'singular_name' => __('Member Group', 'cpotheme'),
		'add_new' => __('New Member Group', 'cpotheme'),
		'add_new_item' => __('Add Member Group', 'cpotheme'),
		'edit_item' => __('Edit Member Group', 'cpotheme'),
		'new_item' => __('New Member Group', 'cpotheme'),
		'view_item' => __('View Member Group', 'cpotheme'),
		'search_items' => __('Search Member Groups', 'cpotheme'),
		'not_found' =>  __('No member groups were found.', 'cpotheme'),
		'not_found_in_trash' => __('No member groups were found in the trash.', 'cpotheme'), 
		'parent_item_colon' => '');
		
		$fields = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => false,
		'rewrite' => array('slug' => apply_filters('cpotheme_slug_team_category', 'team-group')),
		'hierarchical' => true); 
		
		register_taxonomy('cpo_team_category', 'cpo_team', $fields);
	}
}

//Modify main query on team categories and tags, to change number of posts equal to number of columns
if(!function_exists('cpotheme_tax_team_query')){
	function cpotheme_tax_team_query($query){
		if(is_tax('cpo_team_category') && $query->is_main_query() && !is_admin()){
			$columns = cpotheme_get_option('team_columns');
			if($columns != '' && $columns > 0){
				$post_number = cpotheme_get_option('team_columns') * 4;
				$query->set('posts_per_page', $post_number);
			}
		}
	}
}
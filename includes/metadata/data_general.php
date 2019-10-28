<?php 

function cpotheme_metadata_pagelist_optional(){
	$cpotheme_data = array();	
	$page_list = get_pages('sort_column=post_parent,menu_order');    
	$cpotheme_data[0] = __('(Select a Page...)', 'cpotheme');
	foreach ($page_list as $current_page)
		$cpotheme_data[$current_page->ID] = $current_page->post_title;
	return $cpotheme_data;
}


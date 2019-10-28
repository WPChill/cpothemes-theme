<?php

//Add a new field to menu edit screen
add_filter('wp_setup_nav_menu_item', 'cpotheme_menu_fields');
function cpotheme_menu_fields($menu){
	$menu->icon = get_post_meta($menu->ID, '_menu_item_icon', true);
	$menu->style = get_post_meta($menu->ID, '_menu_item_style', true);
	return $menu;
}


//Save the field data 
add_action('wp_update_nav_menu_item', 'cpotheme_menu_fields_update', 10, 3);
function cpotheme_menu_fields_update($menu_id, $db_id, $args){
	if(isset($_REQUEST['menu-item-icon']) && is_array($_REQUEST['menu-item-icon'])){
		$icon_value = isset($_REQUEST['menu-item-icon'][$db_id]) ? $_REQUEST['menu-item-icon'][$db_id] : '';
		update_post_meta($db_id, '_menu_item_icon', $icon_value);
	}
	if(isset($_REQUEST['menu-item-style']) && is_array($_REQUEST['menu-item-style'])){
		$style_value = $_REQUEST['menu-item-style'][$db_id];
		update_post_meta($db_id, '_menu_item_style', $style_value);
	}
}


//Print the field using a custom walker
add_filter('wp_edit_nav_menu_walker', 'cpotheme_menu_fields_walker', 10, 2);
function cpotheme_menu_fields_walker($walker, $menu_id){
	return 'Cpotheme_Menu_Edit_Walker';
}


//Change the default walker for custom menu widgets
add_filter('wp_nav_menu_args', 'cpotheme_menu_walker');
function cpotheme_menu_walker($args){
	//Widgets do not use a theme_location
	if($args['theme_location'] == ''){
		$args = array_merge($args, array('walker' => new Cpotheme_Menu_Walker()));
	}
	return $args;
}
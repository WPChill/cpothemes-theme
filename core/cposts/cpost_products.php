<?php

//PRODUCTS POST TYPE DEFINITION
//Productss are offerings with a set price that can be sold.
if(defined('CPOTHEME_USE_PRODUCTS') && CPOTHEME_USE_PRODUCTS == true){
	add_action('init', 'cpotheme_cpost_products');
	add_filter('manage_edit-cpo_product_columns', 'cpotheme_cpost_products_columns');
	add_action('init', 'cpotheme_tax_productscategory');
	add_action('init', 'cpotheme_tax_productstag');
	add_action('pre_get_posts', 'cpotheme_tax_products_query');
}	

//Define products post type
if(!function_exists('cpotheme_cpost_products')){
	function cpotheme_cpost_products(){
		$labels = array('name' => __('Products', 'cpotheme'),
		'singular_name' => __('Product', 'cpotheme'),
		'add_new' => __('Add Product', 'cpotheme'),
		'add_new_item' => __('Add New Product', 'cpotheme'),
		'edit_item' => __('Edit Product', 'cpotheme'),
		'new_item' => __('New Product', 'cpotheme'),
		'view_item' => __('View Products', 'cpotheme'),
		'search_items' => __('Search Products', 'cpotheme'),
		'not_found' =>  __('No products found.', 'cpotheme'),
		'not_found_in_trash' => __('No products found in the trash.', 'cpotheme'), 
		'parent_item_colon' => '');
		
		$slug = cpotheme_get_option('slug_product');
		if($slug == '') $slug = 'product';
		$fields = array('labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array('slug' => apply_filters('cpotheme_slug_product', $slug)),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-cart',
		'menu_position' => null,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes')); 
		
		register_post_type('cpo_product', $fields);
	}
}

//Define admin columns in products post type	
if(!function_exists('cpotheme_cpost_products_columns')){
	function cpotheme_cpost_products_columns($columns){
		$columns = array(
		'cb' => '<input type="checkbox" />',
		'cpo-image' => __('Image', 'cpotheme'),
		'title' => __('Title', 'cpotheme'),
		'cpo-product-cats' => __('Categories', 'cpotheme'),
		'cpo-product-tags' => __('Tags', 'cpotheme'),
		'date' => __('Date', 'cpotheme'),
		'comments' => '<span class="vers"><span title="'.__('Comments', 'cpotheme').'" class="comment-grey-bubble"></span></span>',
		'author' => __('Author', 'cpotheme'),
		);
		return $columns;
	}
}
	
//Define products category taxonomy
if(!function_exists('cpotheme_tax_productscategory')){
	function cpotheme_tax_productscategory() 
	{
		$labels = array('name' => __('Product Categories', 'cpotheme'),
		'singular_name' => __('Product Category', 'cpotheme'),
		'add_new' => __('New Product Category', 'cpotheme'),
		'add_new_item' => __('Add Product Category', 'cpotheme'),
		'edit_item' => __('Edit Product Category', 'cpotheme'),
		'new_item' => __('New Product Category', 'cpotheme'),
		'view_item' => __('View Product Category', 'cpotheme'),
		'search_items' => __('Search Product Categories', 'cpotheme'),
		'not_found' =>  __('No products categories were found.', 'cpotheme'),
		'not_found_in_trash' => __('No products categories were found in the trash.', 'cpotheme'), 
		'parent_item_colon' => '');
		
		$slug = cpotheme_get_option('slug_product_category');
		if($slug == '') $slug = 'product-category';
		$fields = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'rewrite' => array('slug' => apply_filters('cpotheme_slug_product_category', $slug)),
		'hierarchical' => true); 
		
		register_taxonomy('cpo_product_category', 'cpo_product', $fields);
	}
}
	
//Define products tag taxonomy
if(!function_exists('cpotheme_tax_productstag')){
	function cpotheme_tax_productstag() 
	{
		//Set up labels
		$labels = array('name' => __('Product Tags', 'cpotheme'),
		'singular_name' => __('Product Tag', 'cpotheme'),
		'add_new' => __('New Product Tag', 'cpotheme'),
		'add_new_item' => __('Add Product Tag', 'cpotheme'),
		'edit_item' => __('Edit Product Tag', 'cpotheme'),
		'new_item' => __('New Product Tag', 'cpotheme'),
		'view_item' => __('View Product Tag', 'cpotheme'),
		'search_items' => __('Search Product Tags', 'cpotheme'),
		'not_found' =>  __('No product tags were found.', 'cpotheme'),
		'not_found_in_trash' => __('No product tags were found in the trash.', 'cpotheme'), 
		'parent_item_colon' => '');
		
		$slug = cpotheme_get_option('slug_product_tag');
		if($slug == '') $slug = 'product-tag';
		$fields = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'rewrite' => array('slug' => apply_filters('cpotheme_slug_product_tag', $slug)),
		'hierarchical' => false); 
		
		register_taxonomy('cpo_product_tag', 'cpo_product', $fields);
	}
}

//Modify main query on products categories and tags, to change number of posts equal to number of columns
if(!function_exists('cpotheme_tax_products_query')){
	function cpotheme_tax_products_query($query){
		if((is_tax('cpo_product_category') && is_tax('cpo_product_tag')) && $query->is_main_query() && !is_admin()){
			$columns = cpotheme_get_option('products_columns');
			if($columns != '' && $columns > 0){
				$post_number = cpotheme_get_option('products_columns') * 4;
				$query->set('posts_per_page', $post_number);
			}
		}
	}
}
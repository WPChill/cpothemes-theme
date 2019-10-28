<?php

//Add default metaboxes to posts
add_action('add_meta_boxes', 'cpotheme_metaboxes');
function cpotheme_metaboxes(){
	$args = array('public' => true);
	
	//Add common metaboxes
	$post_types = get_post_types($args, 'names');
	$post_type_list = array();
	foreach($post_types as $current_type)
		add_meta_box('cpotheme_layout_'.$current_type, __('Layout Options', 'cpotheme'), 'cpotheme_metabox_layout', $current_type, 'normal', 'low');
	
	if(defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true){
		add_meta_box('cpotheme_slide', __('Slide Options', 'cpotheme'), 'cpotheme_metabox_slide', 'cpo_slide', 'normal', 'high');
	}
	if(defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true){
		add_meta_box('cpotheme_feature', __('Feature Options', 'cpotheme'), 'cpotheme_metabox_feature', 'cpo_feature', 'normal', 'high');
	}
	if(defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true){
		add_meta_box('cpotheme_portfolio', __('Portfolio Options', 'cpotheme'), 'cpotheme_metabox_portfolio', 'cpo_portfolio', 'normal', 'high');
		add_meta_box('cpotheme_portfolio_gallery', __('Attached Images', 'cpotheme'), 'cpotheme_metabox_gallery', 'cpo_portfolio', 'side', 'low');
	}
	if(defined('CPOTHEME_USE_PRODUCTS') && CPOTHEME_USE_PRODUCTS == true){
		add_meta_box('cpotheme_product', __('Product Options', 'cpotheme'), 'cpotheme_metabox_product', 'cpo_product', 'normal', 'high');
		add_meta_box('cpotheme_product_gallery', __('Attached Images', 'cpotheme'), 'cpotheme_metabox_gallery', 'cpo_product', 'side', 'low');
	}
	if(defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true){
		add_meta_box('cpotheme_service', __('Service Options', 'cpotheme'), 'cpotheme_metabox_service', 'cpo_service', 'normal', 'high');
		add_meta_box('cpotheme_service_gallery', __('Attached Images', 'cpotheme'), 'cpotheme_metabox_gallery', 'cpo_service', 'side', 'low');
	}
	if(defined('CPOTHEME_USE_CLIENTS') && CPOTHEME_USE_CLIENTS == true){
		add_meta_box('cpotheme_client', __('Client Options', 'cpotheme'), 'cpotheme_metabox_client', 'cpo_client', 'normal', 'high');
	}
	if(defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true){
		add_meta_box('cpotheme_team', __('Member Options', 'cpotheme'), 'cpotheme_metabox_team', 'cpo_team', 'normal', 'high');
	}
	if(defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true){
		add_meta_box('cpotheme_testimonial', __('Testimonial Options', 'cpotheme'), 'cpotheme_metabox_testimonial', 'cpo_testimonial', 'normal', 'high');
	}
	//Featured posts and pages
	if(defined('CPOTHEME_USE_PAGES') && CPOTHEME_USE_PAGES == true){
		add_meta_box('cpotheme_post', __('Post Options', 'cpotheme'), 'cpotheme_metabox_page', 'post', 'normal', 'high');
		add_meta_box('cpotheme_page', __('Page Options', 'cpotheme'), 'cpotheme_metabox_page', 'page', 'normal', 'high');
	}
}

//Display and save post metaboxes
function cpotheme_metabox_layout($post){ 
	cpotheme_meta_fields($post, cpotheme_metadata_layout_options());
}
function cpotheme_metabox_slide($post){
	cpotheme_meta_fields($post, cpotheme_metadata_slide_options());
}
function cpotheme_metabox_feature($post){
	cpotheme_meta_fields($post, cpotheme_metadata_feature_options());
}
function cpotheme_metabox_portfolio($post){
	cpotheme_meta_fields($post, cpotheme_metadata_portfolio_options());
}
function cpotheme_metabox_product($post){
	cpotheme_meta_fields($post, cpotheme_metadata_product_options());
}
function cpotheme_metabox_service($post){
	cpotheme_meta_fields($post, cpotheme_metadata_service_options());
}
function cpotheme_metabox_client($post){
	cpotheme_meta_fields($post, cpotheme_metadata_client_options());
}
function cpotheme_metabox_team($post){
	cpotheme_meta_fields($post, cpotheme_metadata_team_options());
}
function cpotheme_metabox_testimonial($post){
	cpotheme_meta_fields($post, cpotheme_metadata_testimonial_options());
}
function cpotheme_metabox_page($post){
	cpotheme_meta_fields($post, cpotheme_metadata_page_options());
}
add_action('edit_post', 'cpotheme_metaboxes_save');
function cpotheme_metaboxes_save($post){
	cpotheme_meta_save(cpotheme_metadata_layout_options());
	if(defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true) cpotheme_meta_save(cpotheme_metadata_slide_options());
	if(defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true) cpotheme_meta_save(cpotheme_metadata_feature_options());
	if(defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true) cpotheme_meta_save(cpotheme_metadata_portfolio_options());
	if(defined('CPOTHEME_USE_PRODUCTS') && CPOTHEME_USE_PRODUCTS == true) cpotheme_meta_save(cpotheme_metadata_product_options());
	if(defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true) cpotheme_meta_save(cpotheme_metadata_service_options());
	if(defined('CPOTHEME_USE_CLIENTS') && CPOTHEME_USE_CLIENTS == true) cpotheme_meta_save(cpotheme_metadata_client_options());
	if(defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true) cpotheme_meta_save(cpotheme_metadata_team_options());
	if(defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true) cpotheme_meta_save(cpotheme_metadata_testimonial_options());
	if(defined('CPOTHEME_USE_PAGES') && CPOTHEME_USE_PAGES == true) cpotheme_meta_save(cpotheme_metadata_page_options());
}


//Add default metaboxes to taxonomies
add_action('admin_init', 'cpotheme_taxonomy_metaboxes');
function cpotheme_taxonomy_metaboxes(){
	$args = array('public' => true);
	
	//Add common metaboxes
	$taxonomy_types = get_taxonomies($args, 'names');
	foreach($taxonomy_types as $current_taxonomy){
		add_action($current_taxonomy.'_edit_form', 'cpotheme_taxonomy_metabox_layout');
		add_action('edit_'.$current_taxonomy, 'cpotheme_taxonomy_layout_save');
		add_action('delete_'.$current_taxonomy, 'cpotheme_taxonomy_layout_delete');
	}
}

//Display forms for all public taxonomies
function cpotheme_taxonomy_metabox_layout($post){
	cpotheme_taxonomy_meta_form(__('Layout Options', 'cpotheme'), $post, cpotheme_metadata_layout_options());
}

//Save the data
function cpotheme_taxonomy_layout_save($post){
	cpotheme_taxonomy_meta_save(cpotheme_metadata_layout_options());
}

//Delete the data
function cpotheme_taxonomy_layout_delete(){
	cpotheme_taxonomy_meta_delete(cpotheme_metadata_layout_options());
}

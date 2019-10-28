<?php

// Adds home link to navigation menus
if(!function_exists('cpotheme_nav_menu_args')){
	add_filter('wp_page_menu_args', 'cpotheme_nav_menu_args');
	function cpotheme_nav_menu_args($args){
		$args['show_home'] = true;
		return $args;
	}
}

//Remove tag stripping for menu descriptions
//TODO: Deactivated. Causes page content to be copied onto description
//remove_filter('nav_menu_description', 'strip_tags');
//add_filter('wp_setup_nav_menu_item', 'cpotheme_menu_description_filter');
function cpotheme_menu_description_filter($menu_item) {
	if(isset($menu_item->post_content) && isset($menu_item->description))
		$menu_item->description = apply_filters('nav_menu_description', $menu_item->post_content);
	return $menu_item;
}


//Change content width variable according to current template
add_filter('template_redirect', 'cpotheme_content_width_size');
function cpotheme_content_width_size($size){
	if(is_page_template('template-full.php') || is_page_template('template-blank.php')){
		global $content_width;
		$content_width = 980;
	}
}


//Turn off inline styles for gallery shortcode
add_filter('use_default_gallery_style', '__return_false');

//Turn off styles in Recent Comments widget
if(!function_exists('cpotheme_remove_recent_comments_style')){
	add_action('widgets_init', 'cpotheme_remove_recent_comments_style');
	function cpotheme_remove_recent_comments_style(){
		add_filter('show_recent_comments_widget_style', '__return_false');
	}
}

if(!function_exists('cpotheme_gallery_lightbox')){
	add_filter('wp_get_attachment_link', 'cpotheme_gallery_lightbox', 10, 4);
	function cpotheme_gallery_lightbox($link, $id, $size, $permalink){
		global $post;
		wp_enqueue_style('cpotheme-magnific');
		wp_enqueue_script('cpotheme-magnific');
		if(!$permalink)
			$link = str_replace('<a ', '<a data-gallery="gallery" ', $link);
		return $link;
	}
}


//Displays an ellipsis on automatic excerpts
add_filter('excerpt_more', 'cpotheme_excerpt_more');
if(!function_exists('cpotheme_excerpt_more')){
	function cpotheme_excerpt_more($more){
		$output = '&hellip;';
		return $output;
	}
}


// Limits excerpt length to a certain size
add_filter('excerpt_length', 'cpotheme_excerpt_length');
if(!function_exists('cpotheme_excerpt_length')){
	function cpotheme_excerpt_length($length){
		return 80;
	}
}

add_filter('post_class', 'cpotheme_has_post_thumbnail');
if(!function_exists('cpotheme_has_post_thumbnail')){
	function cpotheme_has_post_thumbnail($classes){
		global $post;
		if(has_post_thumbnail($post->ID)){
			$classes[] = 'post-has-thumbnail';
		}
		return $classes;
	}
}

//Add portfolio thumbnail size to WordPress admin
add_action('admin_init', 'cpotheme_thumbnail_settings');
if(!function_exists('cpotheme_thumbnail_settings')){
	function cpotheme_thumbnail_settings(){
		$option_values = get_option('cpotheme_thumbnail');
		$default_values = array('width' => CPOTHEME_THUMBNAIL_WIDTH, 'height' => CPOTHEME_THUMBNAIL_HEIGHT);
		$data = shortcode_atts( $default_values, $option_values);
		register_setting('media', 'cpotheme_thumbnail');		
		add_settings_field('cpotheme_portfolio_thumbnails', __('Portfolio Size', 'cpotheme'), 'cpotheme_thumbnail_fields', 'media' , 'default', $data);
	}
}


//Print fields for managing thumbnail sizes
if(!function_exists('cpotheme_thumbnail_fields')){
	function cpotheme_thumbnail_fields($args){
		?>
		<legend class="screen-reader-text"><span><?php _e('Portfolio size', 'cpotheme'); ?></span></legend>
		<label for="cpotheme_portfolio_width"><?php _e('Max Width', 'cpotheme'); ?></label>
		<input name="cpotheme_thumbnail[width]" type="number" step="1" min="0" id="cpotheme_portfolio_width" value="<?php echo $args['width']; ?>" class="small-text" />
		<label for="cpotheme_portfolio_height"><?php _e('Max Height', 'cpotheme'); ?></label>
		<input name="cpotheme_thumbnail[height]" type="number" step="1" min="0" id="cpotheme_portfolio_height" value="<?php echo $args['height']; ?>" class="small-text" />
		<?php
	}
}


//Add portfolio thumbnail size to WordPress admin
add_filter('image_size_names_choose', 'cpotheme_add_thumbnail');
if(!function_exists('cpotheme_add_thumbnail')){
	function cpotheme_add_thumbnail($sizes){
		return array_merge($sizes, array('portfolio' => __('Portfolio Size', 'cpotheme')));
	}
}


//Add a wrapper to embeds so they become responsive
add_filter('embed_oembed_html', 'cpotheme_embed_wrapper', 10, 3);
add_filter('video_embed_html', 'cpotheme_embed_wrapper');
function cpotheme_embed_wrapper($html){
    if(strstr($html, 'youtube.com') != false || strstr($html, 'vimeo.com') != false || strstr($html, 'wordpress.tv') != false){
		return '<div class="video">'.$html.'</div>';
	}else{
		return $html;
	}
}
 
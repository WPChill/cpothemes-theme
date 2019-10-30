<?php

//Create meta fields for pages and taxonomies alike
function cpotheme_metadata_layout_options()
{
    $data = array();
    
    $data['layout_sidebar'] = array(
    'name' => 'layout_sidebar',
    'label' => __('Sidebar Position', 'cpotheme'),
    'desc' => __('Determines the location of the sidebar by default.', 'cpotheme'),
    'type' => 'imagelist',
    'option' => cpotheme_metadata_sidebarposition_optional(),
    'std' => 'default');
    
    if (defined('REVSLIDER_TEXTDOMAIN') || function_exists('putRevSlider')) {
        $data['page_slider'] = array(
        'name' => 'page_slider',
        'std'  => '',
        'label' => __('Page Slider', 'cpotheme'),
        'desc' => sprintf(__('Sets a slider for this page. Requires the %s plugin.', 'cpotheme'), '<a target="_blank" href="http://cpothemes.com/go/revolution-slider-integration">Revolution Slider</a>'),
        'type' => 'select',
        'option' => cpotheme_metadata_revsliders(),
        'std' => '0');
    }
    
    $data['page_header'] = array(
    'name' => 'page_header',
    'std'  => '',
    'label' => __('Page Header', 'cpotheme'),
    'desc' => __('Specifies the format of the header for this page.', 'cpotheme'),
    'type' => 'select',
    'option' => cpotheme_metadata_page_header(),
    'std' => 'normal');
    
    $data['page_title'] = array(
    'name' => 'page_title',
    'std'  => '',
    'label' => __('Page Title', 'cpotheme'),
    'desc' => __('Specifies the format of the title heading for this page.', 'cpotheme'),
    'type' => 'select',
    'option' => cpotheme_metadata_page_title(),
    'std' => 'normal');
    
    $data['page_footer'] = array(
    'name' => 'page_footer',
    'std'  => '',
    'label' => __('Page Footer', 'cpotheme'),
    'desc' => __('Specifies the format of the footer for this page.', 'cpotheme'),
    'type' => 'select',
    'option' => cpotheme_metadata_page_footer(),
    'std' => 'normal');
    
    $data['page_full'] = array(
    'name' => 'page_full',
    'std'  => '',
    'label' => __('Full Width Page', 'cpotheme'),
    'desc' => __('Allows the page content to fill the entire width of the screen. Useful for creating full width rows with backgrounds.', 'cpotheme'),
    'type' => 'yesno');
    
    return apply_filters('cpotheme_metadata_layout', $data);
}


//Create slide meta fields
function cpotheme_metadata_slide_options()
{
    $data = array();
        
    $data['slide_image'] = array(
    'name' => 'slide_image',
    'std'  => '',
    'label' => __('Slide Image', 'cpotheme'),
    'desc' => __('Add a complementary image to the slide.', 'cpotheme'),
    'type' => 'upload');
    
    $data['slide_url'] = array(
    'name' => 'slide_url',
    'std'  => '',
    'label' => __('Destination URL', 'cpotheme'),
    'desc' => __('Specify a target URL to link the slide.', 'cpotheme'),
    'type' => 'text');
    
    $data['slide_link'] = array(
    'name' => 'slide_link',
    'std'  => '',
    'label' => __('Link Text', 'cpotheme'),
    'desc' => __('Sets the text of the link for this slide. Requires a valid destination URL.', 'cpotheme'),
    'type' => 'text');
    
    $data['slide_position'] = array(
    'name' => 'slide_position',
    'std'  => '',
    'label' => __('Caption Position', 'cpotheme'),
    'desc' => __('Determines where the caption of the slide is positioned.', 'cpotheme'),
    'type' => 'select',
    'option' => cpotheme_metadata_slide_position());
    
    $data['slide_color'] = array(
    'name' => 'slide_color',
    'std'  => '',
    'label' => __('Color Scheme', 'cpotheme'),
    'desc' => __('Determines the color scheme used in the caption.', 'cpotheme'),
    'type' => 'select',
    'option' => cpotheme_metadata_color_scheme());
    
    return apply_filters('cpotheme_metadata_slide', $data);
}


//Create feature meta fields
function cpotheme_metadata_feature_options()
{
    $data = array();
        
    $data['feature_icon'] = array(
    'name' => 'feature_icon',
    'std'  => '',
    'label' => __('Feature Icon', 'cpotheme'),
    'desc' => __('Sets an icon to be used as the featured element.', 'cpotheme'),
    'type' => 'iconlist');
    
    $data['feature_url'] = array(
    'name' => 'feature_url',
    'std'  => '',
    'label' => __('Target URL', 'cpotheme'),
    'desc' => __('Sets a destination URL for this feature.', 'cpotheme'),
    'type' => 'text');
    
    return apply_filters('cpotheme_metadata_feature', $data);
}


//Create portfolio meta fields
function cpotheme_metadata_portfolio_options()
{
    $data = array();
        
    $data['portfolio_featured'] = array(
    'name' => 'portfolio_featured',
    'std'  => '',
    'label' => __('Featured Item', 'cpotheme'),
    'desc' => __('Specifies whether this item appears in the homepage.', 'cpotheme'),
    'type' => 'yesno');
    
    $data['portfolio_layout'] = array(
    'name' => 'portfolio_layout',
    'std'  => '',
    'label' => __('Media Layout', 'cpotheme'),
    'desc' => __('Specifies how the images attached to this item should be displayed. The featured image will be excluded from the list of elements.', 'cpotheme'),
    'type' => 'select',
    'option' => cpotheme_metadata_media());
    
    return apply_filters('cpotheme_metadata_portfolio', $data);
}


//Create product meta fields
function cpotheme_metadata_product_options()
{
    $data = array();
        
    $data['product_featured'] = array(
    'name' => 'product_featured',
    'std'  => '',
    'label' => __('Featured Item', 'cpotheme'),
    'desc' => __('Specifies whether this item appears in the homepage.', 'cpotheme'),
    'type' => 'yesno');
    
    $data['product_layout'] = array(
    'name' => 'product_layout',
    'std'  => '',
    'label' => __('Media Layout', 'cpotheme'),
    'desc' => __('Specifies how the images attached to this item should be displayed. The featured image will be excluded from the list of elements.', 'cpotheme'),
    'type' => 'select',
    'option' => cpotheme_metadata_media());
    
    return apply_filters('cpotheme_metadata_product', $data);
}


//Create service meta fields
function cpotheme_metadata_service_options()
{
    $data = array();
        
    $data['service_featured'] = array(
    'name' => 'service_featured',
    'std'  => '',
    'label' => __('Featured Item', 'cpotheme'),
    'desc' => __('Specifies whether this item appears in the homepage.', 'cpotheme'),
    'type' => 'yesno');
    
    $data['service_icon'] = array(
    'name' => 'service_icon',
    'std'  => '',
    'label' => __('Service Icon', 'cpotheme'),
    'desc' => __('Sets an icon to be used as the service preview.', 'cpotheme'),
    'type' => 'iconlist');
    
    $data['service_layout'] = array(
    'name' => 'service_layout',
    'std'  => '',
    'label' => __('Media Layout', 'cpotheme'),
    'desc' => __('Specifies how the images attached to this item should be displayed. The featured image will be excluded from the list of elements.', 'cpotheme'),
    'type' => 'select',
    'option' => cpotheme_metadata_media());
    
    return apply_filters('cpotheme_metadata_service', $data);
}


//Create client meta fields
function cpotheme_metadata_client_options()
{
    $data = array();
        
    $data['client_url'] = array(
    'name' => 'client_url',
    'std'  => '',
    'label' => __('Destination URL', 'cpotheme'),
    'desc' => __('Links the client to a specific URL.', 'cpotheme'),
    'type' => 'text');
    
    return apply_filters('cpotheme_metadata_client', $data);
}


//Create team meta fields
function cpotheme_metadata_team_options()
{
    $data = array();
        
    $data['team_featured'] = array(
    'name' => 'team_featured',
    'std'  => '',
    'label' => __('Featured Member', 'cpotheme'),
    'desc' => __('Specifies whether this member appears in the homepage.', 'cpotheme'),
    'type' => 'yesno');
    
    $data['team_description'] = array(
    'name' => 'team_description',
    'std'  => '',
    'label' => __('Member Description', 'cpotheme'),
    'desc' => __('Specifies a small description for this team member.', 'cpotheme'),
    'type' => 'text');
    
    $data['team_links'] = array(
    'name' => 'team_links',
    'std'  => '',
    'label' => __('Social Profiles', 'cpotheme'),
    'desc' => __('Enter the URL of the social profiles for this team member.', 'cpotheme'),
    'type' => 'collection',
    'option' => cpotheme_metadata_social_profiles());
    
    return apply_filters('cpotheme_metadata_team', $data);
}


//Create testimonial meta fields
function cpotheme_metadata_testimonial_options()
{
    $data = array();
        
    $data['testimonial_description'] = array(
    'name' => 'testimonial_description',
    'std'  => '',
    'label' => __('Testimonial Description', 'cpotheme'),
    'desc' => __('Specifies a small description for this testimonial.', 'cpotheme'),
    'type' => 'text');
    
    return apply_filters('cpotheme_metadata_testimonial', $data);
}


//Create page meta fields
function cpotheme_metadata_page_options()
{
    $data = array();
    
    $data['page_featured'] = array(
    'name' => 'page_featured',
    'std'  => '',
    'label' => __('Show In Homepage', 'cpotheme'),
    'desc' => __('Specifies whether this item is featured in the homepage.', 'cpotheme'),
    'type' => 'select',
    'option' => cpotheme_metadata_featured_page());
    
    return apply_filters('cpotheme_metadata_page', $data);
}

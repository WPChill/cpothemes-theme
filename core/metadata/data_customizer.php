<?php

//Define customizer sections
if (!function_exists('cpotheme_metadata_panels')) {
    function cpotheme_metadata_panels()
    {
        $data = array();
        
        $data['cpotheme_layout'] = array(
        'title' => __('Layout', 'cpotheme'),
        'description' => __('Here you can find settings that control the structure and positioning of specific elements within your website.', 'cpotheme'),
        'priority' => 25);
        
        $data['cpotheme_content'] = array(
        'title' => __('Content Areas', 'cpotheme'),
        'description' => __('This theme includes a few areas where you can insert cutom content.', 'cpotheme'),
        'capability' => 'edit_theme_options',
        'priority' => 26);
        
        return apply_filters('cpotheme_customizer_panels', $data);
    }
}


//Define customizer sections
if (!function_exists('cpotheme_metadata_sections')) {
    function cpotheme_metadata_sections()
    {
        $data = array();
        
        $data['cpotheme_management'] = array(
        'title' => __('General Theme Options', 'cpotheme'),
        'description' => __('Options that help you manage your theme better.', 'cpotheme'),
        'capability' => 'edit_theme_options',
        'priority' => 15);
        
        $data['cpotheme_layout_general'] = array(
        'title' => __('Site Wide Structure', 'cpotheme'),
        'description' => __('Settings that control the structure and positioning of design elements.', 'cpotheme'),
        'capability' => 'edit_theme_options',
        'panel' => 'cpotheme_layout',
        'priority' => 25);
        
        $data['cpotheme_layout_home'] = array(
        'title' => __('Homepage', 'cpotheme'),
        'description' => __('Customize the appearance and behavior of the homepage elements.', 'cpotheme'),
        'capability' => 'edit_theme_options',
        'panel' => 'cpotheme_layout',
        'priority' => 50);
        
        if (defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true) {
            $data['cpotheme_layout_slider'] = array(
            'title' => __('Slider', 'cpotheme'),
            'description' => __('Customize the appearance and behavior of the slider.', 'cpotheme'),
            'capability' => 'edit_theme_options',
            'panel' => 'cpotheme_layout',
            'priority' => 50);
        }
        
        if (defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true) {
            $data['cpotheme_layout_features'] = array(
            'title' => __('Features', 'cpotheme'),
            'description' => __('Customize the appearance and behavior of the feature blocks.', 'cpotheme'),
            'capability' => 'edit_theme_options',
            'panel' => 'cpotheme_layout',
            'priority' => 50);
        }
        
        if (defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true) {
            $data['cpotheme_layout_portfolio'] = array(
            'title' => __('Portfolio', 'cpotheme'),
            'description' => __('Customize the appearance and behavior of the portfolio.', 'cpotheme'),
            'capability' => 'edit_theme_options',
            'panel' => 'cpotheme_layout',
            'priority' => 50);
        }
        
        if (defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true) {
            $data['cpotheme_layout_services'] = array(
            'title' => __('Services', 'cpotheme'),
            'description' => __('Customize the appearance and behavior of the services.', 'cpotheme'),
            'capability' => 'edit_theme_options',
            'panel' => 'cpotheme_layout',
            'priority' => 50);
        }
        
        if (defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true) {
            $data['cpotheme_layout_team'] = array(
            'title' => __('Team Members', 'cpotheme'),
            'description' => __('Customize the appearance and behavior of the team listing.', 'cpotheme'),
            'capability' => 'edit_theme_options',
            'panel' => 'cpotheme_layout',
            'priority' => 50);
        }
        
        if (defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true) {
            $data['cpotheme_layout_testimonials'] = array(
            'title' => __('Testimonials', 'cpotheme'),
            'description' => __('Customize the appearance and behavior of the testimonials.', 'cpotheme'),
            'capability' => 'edit_theme_options',
            'panel' => 'cpotheme_layout',
            'priority' => 50);
        }
        
        if (defined('CPOTHEME_USE_CLIENTS') && CPOTHEME_USE_CLIENTS == true) {
            $data['cpotheme_layout_clients'] = array(
            'title' => __('Clients', 'cpotheme'),
            'description' => __('Customize the appearance and behavior of the client listing.', 'cpotheme'),
            'capability' => 'edit_theme_options',
            'panel' => 'cpotheme_layout',
            'priority' => 50);
        }
        
        $data['cpotheme_layout_posts'] = array(
        'title' => __('Blog Posts', 'cpotheme'),
        'description' => __('Modify the appearance and behavior of your blog posts by enabling specific elements.', 'cpotheme'),
        'capability' => 'edit_theme_options',
        'panel' => 'cpotheme_layout',
        'priority' => 50);
        
        $data['cpotheme_typography'] = array(
        'title' => __('Typography', 'cpotheme'),
        'description' => __('Custom typefaces for the entire site.', 'cpotheme'),
        'capability' => 'edit_theme_options',
        'priority' => 45);

        $data['cpotheme_content_general'] = array(
        'title' => __('Site Wide Content', 'cpotheme'),
        'description' => __('Content areas located in common areas throughout the site. You can use HTML and shortcodes here.', 'cpotheme'),
        'capability' => 'edit_theme_options',
        'panel' => 'cpotheme_content',
        'priority' => 50);
        
        $data['cpotheme_content_home'] = array(
        'title' => __('Homepage', 'cpotheme'),
        'description' => __('Add custom content to specific areas of the homepage. You can use HTML and shortcodes here.', 'cpotheme'),
        'capability' => 'edit_theme_options',
        'panel' => 'cpotheme_content',
        'priority' => 50);
    
        return apply_filters('cpotheme_customizer_sections', $data);
    }
}


if (!function_exists('cpotheme_metadata_customizer')) {
    function cpotheme_metadata_customizer($std = null)
    {
        $data = array();
        
        $data['general_logo'] = array(
        'label' => __('Custom Logo', 'cpotheme'),
        'description' => __('Insert the URL of an image to be used as a custom logo.', 'cpotheme'),
        'section' => 'title_tagline',
        'sanitize' => 'esc_url',
        'type' => 'image');

        $data['general_favicon'] = array(
        'label' => __('Custom Favicon', 'cpotheme'),
        'description' => __('Recommended sizes are 16x16 pixels.', 'cpotheme'),
        'section' => 'title_tagline',
        'sanitize' => 'esc_url',
        'type' => 'image');
        
        $data['general_logo_width'] = array(
        'label' => __('Logo Width (px)', 'cpotheme'),
        'description' => __('Forces the logo to have a specified width.', 'cpotheme'),
        'section' => 'title_tagline',
        'type' => 'text',
        'placeholder' => '(none)',
        'sanitize' => 'absint',
        'width' => '100px');
        
        $data['general_texttitle'] = array(
        'label' => __('Enable Text Title?', 'cpotheme'),
        'description' => __('Activate this to display the site title as text.', 'cpotheme'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'std' => false);
        
        $data['general_editlinks'] = array(
        'label' => __('Show Edit Links', 'cpotheme'),
        'description' => __('Display edit links on the site layout for logged in users.', 'cpotheme'),
        'section' => 'cpotheme_management',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'std' => true);
        
        $data['general_css'] = array(
        'label' => __('Custom CSS', 'cpotheme'),
        'description' => __('Add custom CSS styling for the entire site, overriding the default stylesheet.', 'cpotheme'),
        'section' => 'cpotheme_management',
        'type' => 'textarea',
        'sanitize' => 'wp_filter_nohtml_kses',
        'format' => 'css');
        
        //Layout
        /*$data['layout_style'] = array(
        'label' => __('Layout Style', 'cpotheme'),
        'section' => 'cpotheme_layout_general',
        'type' => 'select',
        'choices' => cpotheme_metadata_layoutstyle(),
        'default' => 'fixed');*/
        
        $data['sidebar_position'] = array(
        'label' => __('Default Sidebar Position', 'cpotheme'),
        'description' => __('This option can be overridden in individual pages.', 'cpotheme'),
        'section' => 'cpotheme_layout_general',
        'type' => 'select',
        'choices' => cpotheme_metadata_sidebarposition_text(),
        'default' => 'right');
        
        $data['layout_subfooter_columns'] = array(
        'label' => __('Number of Footer Columns', 'cpotheme'),
        'section' => 'cpotheme_layout_general',
        'type' => 'select',
        'choices' => cpotheme_metadata_sidebar_columns_text(),
        'default' => 3);
        
        $data['layout_breadcrumbs'] = array(
        'label' => __('Enable breadcrumb navigation', 'cpotheme'),
        'section' => 'cpotheme_layout_general',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default'  => true);
        
        $data['layout_languages'] = array(
        'label' => __('Enable Language Switcher', 'cpotheme'),
        'section' => 'cpotheme_layout_general',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default'  => true);
        
        $data['layout_cart'] = array(
        'label' => __('Enable Shopping Cart', 'cpotheme'),
        'section' => 'cpotheme_layout_general',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default'  => true);
        
        $data['general_credit'] = array(
        'label' => __('Show Credit Link', 'cpotheme'),
        'section' => 'cpotheme_layout_general',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default' => true);
        
        $data['footer_text'] = array(
        'label' => __('Footer Text', 'cpotheme'),
        'description' => __('Add custom text that replaces the copyright line in the footer.', 'cpotheme'),
        'section' => 'cpotheme_layout_general',
        'multilingual' => true,
        'sanitize' => 'esc_html',
        'type' => 'textarea');
        
        $data['social_links'] = array(
        'label' => __('Social Links', 'cpotheme'),
        'description' => __('Enter the URL of your preferred social profiles, one per line.', 'cpotheme'),
        'section' => 'cpotheme_layout_general',
        'multilingual' => true,
        'sanitize' => 'esc_html',
        'type' => 'textarea');
        
        //Homepage
        $data['sidebar_position_home'] = array(
        'label' => __('Sidebar Position in Homepage', 'cpotheme'),
        'description' => __('If you set a static page to serve as the homepage, this option will be overridden by that page\'s settings.', 'cpotheme'),
        'section' => 'cpotheme_layout_home',
        'type' => 'select',
        'choices' => cpotheme_metadata_sidebarposition_text(),
        'default' => 'right');
        
        $data['home_order'] = array(
        'label' => __('Content Ordering', 'cpotheme'),
        'description' => __('Change the ordering of the various elements in the homepage.', 'cpotheme'),
        'section' => 'cpotheme_layout_home',
        'type' => 'sortable',
        'choices' => cpotheme_metadata_homepage_order(),
        'default' => cpotheme_metadata_homepage_order_default());
        
        //Homepage Content
        $data['home_tagline'] = array(
        'label' => __('Tagline Title', 'cpotheme'),
        'section' => 'cpotheme_layout_home',
        'empty' => true,
        'multilingual' => true,
        'default' => __('Add your custom tagline here.', 'cpotheme'),
        'sanitize' => 'esc_html',
        'type' => 'textarea');
        
        //Homepage Slider
        if (defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true) {
            $data['slider_height'] = array(
            'label' => __('Slider Height (px)', 'cpotheme'),
            'section' => 'cpotheme_layout_slider',
            'type' => 'text',
            'sanitize' => 'absint',
            'default' => '500');
            
            $data['slider_speed'] = array(
            'label' => __('Slider Transition Speed (ms)', 'cpotheme'),
            'section' => 'cpotheme_layout_slider',
            'type' => 'text',
            'sanitize' => 'absint',
            'default' => '1500');
            
            $data['slider_timeout'] = array(
            'label' => __('Slider Timeout (ms)', 'cpotheme'),
            'section' => 'cpotheme_layout_slider',
            'type' => 'text',
            'sanitize' => 'absint',
            'default' => '8000');
            
            $data['slider_always'] = array(
            'label' => __('Always Display Slider', 'cpotheme'),
            'description' => __('Shows the homepage slider in all pages.', 'cpotheme'),
            'section' => 'cpotheme_layout_slider',
            'type' => 'checkbox',
            'sanitize' => 'cpotheme_sanitize_bool',
            'default' => false);
        }
        
        //Homepage Features
        if (defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true) {
            $data['home_features'] = array(
            'label' => __('Features Description', 'cpotheme'),
            'section' => 'cpotheme_layout_features',
            'empty' => true,
            'multilingual' => true,
            'default' => __('Our core features', 'cpotheme'),
            'sanitize' => 'esc_html',
            'type' => 'textarea');
            
            $data['features_columns'] = array(
            'label' => __('Features Columns', 'cpotheme'),
            'section' => 'cpotheme_layout_features',
            'type' => 'select',
            'choices' => cpotheme_metadata_columns(),
            'default' => 3);
        }
        
        //Portfolio layout
        if (defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true) {
            $data['home_portfolio'] = array(
            'label' => __('Portfolio Description', 'cpotheme'),
            'section' => 'cpotheme_layout_portfolio',
            'empty' => true,
            'multilingual' => true,
            'default' => __('Take a look at our work', 'cpotheme'),
            'sanitize' => 'esc_html',
            'type' => 'textarea');
            
            $data['portfolio_columns'] = array(
            'label' => __('Portfolio Columns', 'cpotheme'),
            'section' => 'cpotheme_layout_portfolio',
            'type' => 'select',
            'choices' => cpotheme_metadata_columns(),
            'default' => 3);
            
            $data['portfolio_related'] = array(
            'label' => __('Enable Related Portfolio Items', 'cpotheme'),
            'description' => __('Shows portfolio items belonging to the same category at the end of each portfolio item.', 'cpotheme'),
            'section' => 'cpotheme_layout_portfolio',
            'type' => 'checkbox',
            'sanitize' => 'cpotheme_sanitize_bool',
            'default'  => true);
        }
        
        //Services layout
        if (defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true) {
            $data['home_services'] = array(
            'label' => __('Services Description', 'cpotheme'),
            'section' => 'cpotheme_layout_services',
            'empty' => true,
            'multilingual' => true,
            'default' => __('What we can offer you', 'cpotheme'),
            'sanitize' => 'esc_html',
            'type' => 'textarea');
            
            $data['services_columns'] = array(
            'label' => __('Services Columns', 'cpotheme'),
            'section' => 'cpotheme_layout_services',
            'type' => 'select',
            'choices' => cpotheme_metadata_columns(),
            'default' => 3);
        }
        
        //Team layout
        if (defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true) {
            $data['home_team'] = array(
            'label' => __('Team Members Description', 'cpotheme'),
            'section' => 'cpotheme_layout_team',
            'empty' => true,
            'multilingual' => true,
            'default' => __('Meet our team', 'cpotheme'),
            'sanitize' => 'esc_html',
            'type' => 'textarea');
            
            $data['team_columns'] = array(
            'label' => __('Team Columns', 'cpotheme'),
            'section' => 'cpotheme_layout_team',
            'type' => 'select',
            'choices' => cpotheme_metadata_columns(),
            'default' => 3);
        }
        
        //Testimonials
        if (defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true) {
            $data['home_testimonials'] = array(
            'label' => __('Testimonials Description', 'cpotheme'),
            'section' => 'cpotheme_layout_testimonials',
            'empty' => true,
            'multilingual' => true,
            'default' => __('What they say about us', 'cpotheme'),
            'sanitize' => 'esc_html',
            'type' => 'textarea');
        }
        
        //Blog Posts
        $data['home_posts'] = array(
        'label' => __('Enable Posts On Homepage', 'cpotheme'),
        'section' => 'cpotheme_layout_home',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default' => false);
        
        $data['postpage_dates'] = array(
        'label' => __('Enable Post Dates', 'cpotheme'),
        'section' => 'cpotheme_layout_posts',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default' => true);
        
        $data['postpage_authors'] = array(
        'label' => __('Enable Post Authors', 'cpotheme'),
        'section' => 'cpotheme_layout_posts',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default' => true);
        
        $data['postpage_comments'] = array(
        'label' => __('Enable Comment Count', 'cpotheme'),
        'section' => 'cpotheme_layout_posts',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default' => true);
        
        $data['postpage_categories'] = array(
        'label' => __('Enable Post Categories', 'cpotheme'),
        'section' => 'cpotheme_layout_posts',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default' => true);
        
        $data['postpage_tags'] = array(
        'label' => __('Enable Post Tags', 'cpotheme'),
        'section' => 'cpotheme_layout_posts',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default' => true);
        
        $data['postpage_preview'] = array(
        'label' => __('Show Full Content on Blog Listing', 'cpotheme'),
        'section' => 'cpotheme_layout_posts',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default' => false);
        
        //Typography
        $data['type_size'] = array(
        'label' => __('Font Size', 'cpotheme'),
        'section' => 'cpotheme_typography',
        'type' => 'select',
        'choices' => cpotheme_metadata_font_sizes(),
        'default' => '0.875');
        
        $data['type_headings'] = array(
        'label' => __('Headings & Titles', 'cpotheme'),
        'section' => 'cpotheme_typography',
        'type' => 'select',
        'choices' => cpotheme_metadata_fonts(),
        'default' => '');
        
        $data['type_nav'] = array(
        'label' => __('Main Navigation Menu', 'cpotheme'),
        'section' => 'cpotheme_typography',
        'type' => 'select',
        'choices' => cpotheme_metadata_fonts(),
        'default' => '');
        
        $data['type_body'] = array(
        'label' => __('Body Text', 'cpotheme'),
        'section' => 'cpotheme_typography',
        'type' => 'select',
        'choices' => cpotheme_metadata_fonts(),
        'default' => '');
        
        $data['type_body_variants'] = array(
        'label' => __('Load Font Variants', 'cpotheme'),
        'description' => __('Loads additional font variations for the selected body typeface, if available. This will result in better-looking bold/light text.', 'cpotheme'),
        'section' => 'cpotheme_typography',
        'type' => 'checkbox',
        'sanitize' => 'cpotheme_sanitize_bool',
        'default' => true);
        
        //Colors
        $data['primary_color'] = array(
        'label' => __('Primary Color', 'cpotheme'),
        'description' => __('Used in buttons, headings, and other prominent elements.', 'cpotheme'),
        'section' => 'colors',
        'type' => 'color',
        'sanitize' => 'sanitize_hex_color',
        'default' => '#444444');
        
        $data['secondary_color'] = array(
        'label' => __('Secondary Color', 'cpotheme'),
        'description' => __('Used in minor design elements and backgrounds.', 'cpotheme'),
        'section' => 'colors',
        'type' => 'color',
        'sanitize' => 'sanitize_hex_color',
        'default' => '#333355');
        
        $data['type_headings_color'] = array(
        'label' => __('Headings & Titles', 'cpotheme'),
        'description' => '',
        'section' => 'colors',
        'type' => 'color',
        'sanitize' => 'sanitize_hex_color',
        'default' => '#444444');
        
        $data['type_widgets_color'] = array(
        'label' => __('Widget Titles', 'cpotheme'),
        'description' => '',
        'section' => 'colors',
        'type' => 'color',
        'sanitize' => 'sanitize_hex_color',
        'default' => '#444444');
        
        $data['type_nav_color'] = array(
        'label' => __('Main Menu', 'cpotheme'),
        'section' => 'colors',
        'type' => 'color',
        'sanitize' => 'sanitize_hex_color',
        'default' => '#444444');
        
        $data['type_body_color'] = array(
        'label' => __('Body Text', 'cpotheme'),
        'section' => 'colors',
        'type' => 'color',
        'sanitize' => 'sanitize_hex_color',
        'default' => '#777777');
        
        $data['type_link_color'] = array(
        'label' => __('Hyperlinks', 'cpotheme'),
        'section' => 'colors',
        'type' => 'color',
        'sanitize' => 'sanitize_hex_color',
        'default' => '#f5663e');
        
        return apply_filters('cpotheme_customizer_controls', $data);
    }
}

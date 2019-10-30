<?php
//Theme options setup
if (!function_exists('cpotheme_setup')) {
    add_action('after_setup_theme', 'cpotheme_setup');
    function cpotheme_setup()
    {
        //Set core variables
        define('CPOCORE_STORE', 'https://www.cpothemes.com');
        define('CPOCORE_VERSION', '4.3.4');
        define('CPOCORE_AUTHOR', 'CPOThemes');
        if (!defined('CPOTHEME_ID')) {
            define('CPOTHEME_ID', 'core');
        }
        if (!defined('CPOTHEME_NAME')) {
            define('CPOTHEME_NAME', 'theme');
        }
        if (!defined('CPOTHEME_VERSION')) {
            define('CPOTHEME_VERSION', '1.0.0');
        }
        if (!defined('CPOTHEME_THUMBNAIL_WIDTH')) {
            define('CPOTHEME_THUMBNAIL_WIDTH', '600');
        }
        if (!defined('CPOTHEME_THUMBNAIL_HEIGHT')) {
            define('CPOTHEME_THUMBNAIL_HEIGHT', '400');
        }

        //Add custom image size
        $thumbnail_sizes = get_option('cpotheme_thumbnail', '');
        $thumbnail_width = isset($thumbnail_sizes['width']) && $thumbnail_sizes['width'] != '' ? $thumbnail_sizes['width'] : CPOTHEME_THUMBNAIL_WIDTH;
        $thumbnail_height = isset($thumbnail_sizes['height']) && $thumbnail_sizes['height'] != '' ? $thumbnail_sizes['height'] : CPOTHEME_THUMBNAIL_HEIGHT;
        add_image_size('portfolio', apply_filters('cpotheme_thumbnail_width', $thumbnail_width), apply_filters('cpotheme_thumbnail_height', $thumbnail_height), true);

        //Initialize supported theme features
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('custom-header', array('header-text' => false,'width' => 1600, 'height' => 500, 'flex-width' => true, 'flex-height' => true));
        add_theme_support('custom-background', apply_filters('cpotheme_background_args', array('default-color' => 'ffffff')));
        add_theme_support('automatic-feed-links');
        add_theme_support('woocommerce');
        add_theme_support('bbpress');
        add_post_type_support('page', 'excerpt');

        //Set content width for embeds
        global $content_width;
        if (!isset($content_width)) {
            $content_width = 640;
        }

        //Remove WordPress version number for security purposes
        remove_action('wp_head', 'wp_generator');

        //Load translation text domain and make translation available
        $languages_path = get_template_directory().'/core/languages';
        if (defined('CPOTHEME_CORE')) {
            $languages_path = CPOTHEME_CORE.'/languages';
        }
        load_theme_textdomain('cpotheme', $languages_path);
        //load_theme_textdomain('cpotheme', get_template_directory().'/languages');
        $locale = get_locale();
        $locale_file = get_template_directory()."/languages/$locale.php";
        if (is_readable($locale_file)) {
            require_once($locale_file);
        }
    }
}

//Add Public scripts
if (!function_exists('cpotheme_scripts_front')) {
    add_action('wp_enqueue_scripts', 'cpotheme_scripts_front');
    function cpotheme_scripts_front()
    {
        $scripts_theme_path = get_template_directory_uri().'/scripts/';
        $scripts_path = get_template_directory_uri().'/core/scripts/';

        if (defined('CPOTHEME_CORE_URL')) {
            $scripts_path = CPOTHEME_CORE_URL.'/scripts/';
        }

        //Enqueue necessary scripts already in the WordPress core
        //wp_enqueue_script('jquery-ui-core');
        if (is_singular() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        wp_enqueue_script('cpotheme_html5', $scripts_path.'html5-min.js');
        //Register custom scripts for later enqueuing

        wp_enqueue_style('dashicons');
        wp_enqueue_script('cpotheme_core', $scripts_path.'core.js', array(), false, true);
        wp_register_script('cpotheme_stellar', $scripts_path.'jquery-stellar.js', array('jquery'), false, true);
        wp_register_script('cpotheme_waypoints', $scripts_path.'jquery-waypoints.js', array('jquery'), false, true);
        wp_register_script('cpotheme_waypoints_sticky', $scripts_path.'jquery-waypoints-sticky.js', array('cpotheme_waypoints'), false, true);
        wp_register_script('cpotheme_cycle', $scripts_path.'jquery-cycle2-min.js', array('jquery'), false, true);
        wp_register_script('cpotheme-magnific', $scripts_path.'jquery-magnific-min.js', array('jquery'), false, true);
    }
}

//Add Admin scripts
if (!function_exists('cpotheme_scripts_back')) {
    add_action('admin_enqueue_scripts', 'cpotheme_scripts_back');
    function cpotheme_scripts_back()
    {
        $screen = get_current_screen();
        $scripts_theme_path = get_template_directory_uri().'/scripts/';
        $scripts_path = get_template_directory_uri().'/core/scripts/';
        if (defined('CPOTHEME_CORE_URL')) {
            $scripts_path = CPOTHEME_CORE_URL.'/scripts/';
        }

        //Common scripts

        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-widget');
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('jquery-effects-core');
        wp_enqueue_script('jquery-effects-fade');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script('cpotheme_customizer', $scripts_path.'customizer.js');
        wp_enqueue_script('cpotheme_script_admin', $scripts_path.'admin.js');
        wp_register_script('cpotheme_script_editor', $scripts_path.'editor.js', array(), false, true);
        wp_register_script('cpotheme_script_codemirror', $scripts_path.'codemirror.js', array(), false, true);
        wp_register_script('cpotheme_script_codemirror_css', $scripts_path.'codemirror-css.js', array(), false, true);
        wp_register_script('cpotheme_script_codemirror_js', $scripts_path.'codemirror-js.js', array(), false, true);
        wp_register_script('cpotheme_script_codemirror_xml', $scripts_path.'codemirror-xml.js', array(), false, true);

        if (defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true && $screen->post_type == 'cpo_portfolio') {
            wp_enqueue_script('cpotheme_script_gallery', $scripts_path.'gallery.js');
        }
    }
}

if (!function_exists('cpotheme_scripts_customizer')) {
    add_action('customize_controls_enqueue_scripts', 'cpotheme_scripts_customizer');
    function cpotheme_scripts_customizer()
    {
        $screen = get_current_screen();
        $scripts_theme_path = get_template_directory_uri().'/scripts/';
        $scripts_path = get_template_directory_uri().'/core/scripts/';
        if (defined('CPOTHEME_CORE_URL')) {
            $scripts_path = CPOTHEME_CORE_URL.'/scripts/';
        }

        //Common scripts
        wp_enqueue_script('cpotheme_script_sortable', $scripts_path.'sortable.js', array('jquery-ui-sortable'), false, true);
    }
}



//Add public stylesheets
if (!function_exists('cpotheme_add_styles')) {
    add_action('wp_enqueue_scripts', 'cpotheme_add_styles');
    function cpotheme_add_styles()
    {
        $stylesheets_path = get_template_directory_uri().'/core/css/';
        if (defined('CPOTHEME_CORE_URL')) {
            $stylesheets_path = CPOTHEME_CORE_URL.'/css/';
        }

        //Font Libraries
        // wp_enqueue_style('cpotheme-icon-fontawesome', $stylesheets_path.'icon-fontawesome.css');
        wp_enqueue_style('cpotheme-fontawesome', $stylesheets_path.'fontawesome.css');
        wp_enqueue_style('cpotheme-linearicons', $stylesheets_path.'icon-linearicons.css');
        wp_enqueue_style('cpotheme-typicons', $stylesheets_path.'icon-typicons.css');

        //Common styles
        wp_enqueue_style('cpotheme-base', $stylesheets_path.'base.css');
        wp_register_style('cpotheme-prettyphoto', $stylesheets_path.'prettyphoto.css');
        wp_register_style('cpotheme-magnific', $stylesheets_path.'magnific.css');
        wp_enqueue_style('cpotheme-main', get_bloginfo('stylesheet_url'));
    }
}

//Add admin stylesheets
if (!function_exists('cpotheme_add_admin_styles')) {
    add_action('admin_print_styles', 'cpotheme_add_admin_styles');
    function cpotheme_add_admin_styles()
    {
        $stylesheets_path = get_template_directory_uri().'/core/css/';
        if (defined('CPOTHEME_CORE_URL')) {
            $stylesheets_path = CPOTHEME_CORE_URL.'/css/';
        }

        add_editor_style($stylesheets_path.'editor.css');

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style('cpotheme_admin', $stylesheets_path.'admin.css');

        wp_enqueue_style('cpotheme-fontawesome', $stylesheets_path.'icon-fontawesome.css');
        wp_enqueue_style('cpotheme-linearicons', $stylesheets_path.'icon-linearicons.css');
        wp_enqueue_style('cpotheme-typicons', $stylesheets_path.'icon-typicons.css');

        wp_enqueue_style('thickbox');
        wp_register_style('cpotheme_style_codemirror', $stylesheets_path.'codemirror.css');
    }
}


//Add all Core components
$core_path = get_template_directory().'/core/';
if (defined('CPOTHEME_CORE')) {
    $core_path = CPOTHEME_CORE;
}

//Classes
require_once($core_path.'classes/class_menu_edit.php');
require_once($core_path.'classes/class_menu.php');
require_once($core_path.'classes/class_customizer.php');

//Main Components
require_once($core_path.'functions.php');
require_once($core_path.'markup.php');
require_once($core_path.'filters.php');
require_once($core_path.'users.php');
require_once($core_path.'meta.php');
require_once($core_path.'metaboxes.php');
require_once($core_path.'gallery.php');
require_once($core_path.'custom.php');
require_once($core_path.'forms.php');
require_once($core_path.'taxonomy.php');
require_once($core_path.'icons.php');
require_once($core_path.'layout.php');
require_once($core_path.'woocommerce.php');
require_once($core_path.'menus.php');
require_once($core_path.'customizer.php');

//Metadata
require_once($core_path.'metadata/data_general.php');
require_once($core_path.'metadata/data_icons.php');
require_once($core_path.'metadata/data_metaboxes.php');
require_once($core_path.'metadata/data_customizer.php');

// Shortcodes
require_once($core_path.'shortcodes/general.php');
require_once($core_path.'shortcodes/shortcode-column.php');
require_once($core_path.'shortcodes/shortcode-pricing.php');
require_once($core_path.'shortcodes/shortcode-separator.php');
require_once($core_path.'shortcodes/shortcode-spacer.php');
require_once($core_path.'shortcodes/shortcode-feature.php');
require_once($core_path.'shortcodes/shortcode-button.php');
require_once($core_path.'shortcodes/shortcode-leading.php');
require_once($core_path.'shortcodes/shortcode-accordion.php');
require_once($core_path.'shortcodes/shortcode-focus.php');
require_once($core_path.'shortcodes/shortcode-pricing-table.php');

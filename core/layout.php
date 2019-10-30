<?php
//Generate dynamic CSS styling
add_action('wp_head', 'cpotheme_styling_css', 19);
function cpotheme_styling_css()
{
    $primary_color = cpotheme_get_option('primary_color');
    $secondary_color = cpotheme_get_option('secondary_color');
            
    $type_size = cpotheme_get_option('type_size');
    $type_headings = apply_filters('cpotheme_font_headings', cpotheme_get_option('type_headings'));
    $type_nav = apply_filters('cpotheme_font_menu', cpotheme_get_option('type_nav'));
    $type_body = apply_filters('cpotheme_font_body', cpotheme_get_option('type_body'));
    
    $color_headings = cpotheme_get_option('type_headings_color');
    $color_widgets = cpotheme_get_option('type_widgets_color');
    $color_nav = cpotheme_get_option('type_nav_color');
    $color_body = cpotheme_get_option('type_body_color');
    $color_links = cpotheme_get_option('type_link_color'); ?>
	<style type="text/css">
		body {
			<?php if ($type_size != ''): ?>
			font-size:<?php echo $type_size; ?>em; 
			<?php endif; ?>
			
			<?php if ($type_body != ''): ?>
			font-family:'<?php echo cpotheme_metadata_fonts_name($type_body); ?>'; 
			font-weight:<?php echo cpotheme_metadata_fonts_weight($type_body); ?>; 
			<?php endif; ?>
			
			<?php if ($color_body != ''): ?>
			color:<?php echo $color_body; ?>; 
			<?php endif; ?>
		}
		
		
		<?php if ($type_body): ?>
		.button, .button:link, .button:visited, 
		input[type=submit],
		.tp-caption { 		
			font-family:'<?php echo cpotheme_metadata_fonts_name($type_body); ?>';
			font-weight:<?php echo cpotheme_metadata_fonts_weight($type_body); ?>; 
		}
		<?php endif; ?>
		
		
		h1, h2, h3, h4, h5, h6, .heading, .header .title { 		
			<?php if ($type_headings): ?>
			font-family:'<?php echo cpotheme_metadata_fonts_name($type_headings); ?>'; 
			font-weight:<?php echo cpotheme_metadata_fonts_weight($type_headings); ?>; 
			<?php endif; ?>
			<?php if ($color_headings != '') {
        echo "color:$color_headings;";
    } ?>
		}
		
		
		.widget-title { 		
			<?php if ($color_widgets != '') {
        echo "color:$color_widgets;";
    } ?>
		}
		
		
		.menu-main li a { 		
			<?php if ($type_nav): ?>
			font-family:'<?php echo cpotheme_metadata_fonts_name($type_nav); ?>'; 
			font-weight:<?php echo cpotheme_metadata_fonts_weight($type_nav); ?>; 
			<?php endif; ?>
			<?php if ($color_nav != '') {
        echo "color:$color_nav;";
    } ?>
		}
		
		.menu-mobile li a { 		
			<?php if ($type_nav): ?>
			font-family:'<?php echo cpotheme_metadata_fonts_name($type_nav); ?>'; 
			font-weight:<?php echo cpotheme_metadata_fonts_weight($type_nav); ?>; 
			<?php endif; ?>
			<?php if ($color_body != ''): ?>
			color:<?php echo $color_body; ?>; 
			<?php endif; ?>
		}
		
		
		<?php if ($color_links != ''): ?>
		a:link, a:visited { color:<?php echo $color_links; ?>; }
		a:hover { <?php echo "color:$color_links;"; ?> }
		<?php endif; ?>

		
		<?php if ($primary_color != ''): ?>
		.primary-color { color:<?php echo $primary_color; ?>; }
		.primary-color-bg { background-color:<?php echo $primary_color; ?>; }
		.primary-color-border { border-color:<?php echo $primary_color; ?>; }
		.menu-item.menu-highlight > a { background-color:<?php echo $primary_color; ?>; }
		.tp-caption.primary_color_background { background:<?php echo $primary_color; ?>; }
		.tp-caption.primary_color_text{ color:<?php echo $primary_color; ?>; }
		.widget_nav_menu a .menu-icon { color:<?php echo $primary_color; ?>; }
		
		.button, .button:link, .button:visited, input[type=submit] { background-color:<?php echo $primary_color; ?>; }
		.button:hover, input[type=submit]:hover { background-color:<?php echo $primary_color; ?>; }
		::selection  { color:#fff; background-color:<?php echo $primary_color; ?>; }
		::-moz-selection { color:#fff; background-color:<?php echo $primary_color; ?>; }
		
		<?php endif; ?>
		
		<?php if ($secondary_color != ''): ?>
		.secondary-color { color:<?php echo $secondary_color; ?>; }
		.secondary-color-bg { background-color:<?php echo $secondary_color; ?>; }
		.secondary-color-border { border-color:<?php echo $secondary_color; ?>; }
		.tp-caption.secondary_color_background { background:<?php echo $secondary_color; ?>; }
		.tp-caption.secondary_color_text{ color:<?php echo $secondary_color; ?>; }		
		<?php endif; ?>		
	</style>
<?php
}


//Enqueue Google fonts
add_action('wp_head', 'cpotheme_styling_fonts', 20);
function cpotheme_styling_fonts()
{
    cpotheme_fonts(apply_filters('cpotheme_font_headings', cpotheme_get_option('type_headings')));
    cpotheme_fonts(apply_filters('cpotheme_font_menu', cpotheme_get_option('type_nav')));
    cpotheme_fonts(apply_filters('cpotheme_font_body', cpotheme_get_option('type_body')), cpotheme_get_option('type_body_variants'));
}


// Registers all widget areas
add_action('widgets_init', 'cpotheme_init_sidebar');
function cpotheme_init_sidebar()
{
    register_sidebar(array('name' => __('Default Widgets', 'cpotheme'),
    'id' => 'primary-widgets',
    'description' => __('Sidebar shown in all standard pages by default.', 'cpotheme'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title heading">',
    'after_title' => '</div>'));
    
    register_sidebar(array('name' => __('Secondary Widgets', 'cpotheme'),
    'id' => 'secondary-widgets',
    'description' => __('Shown in pages with more than one sidebar.', 'cpotheme'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title heading">',
    'after_title' => '</div>'));
    
    $footer_columns = apply_filters('cpotheme_subfooter_columns', cpotheme_get_option('layout_subfooter_columns'));
    if ($footer_columns == '') {
        $footer_columns = 3;
    }
    for ($count = 1; $count <= $footer_columns; $count++) {
        register_sidebar(array(
        'id' => 'footer-widgets-'.$count,
        'name' => __('Footer Widgets', 'cpotheme').' '.$count,
        'description' => __('Shown in the footer area.', 'cpotheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title heading">',
        'after_title' => '</div>'));
    }
}


//Registers all menu areas
add_action('widgets_init', 'cpotheme_init_menu');
function cpotheme_init_menu()
{
    register_nav_menus(array('top_menu' => __('Top Menu', 'cpotheme')));
    register_nav_menus(array('main_menu' => __('Main Menu', 'cpotheme')));
    register_nav_menus(array('footer_menu' => __('Footer Menu', 'cpotheme')));
}

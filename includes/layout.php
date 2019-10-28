<?php
add_action('wp_head', 'cpotheme_styling_custom', 19);
function cpotheme_styling_custom(){
	
	//Background styling
	$primary_color = cpotheme_get_option('primary_color');
	?>
	<style type="text/css">
		
		
		<?php if($primary_color != ''): ?>
		<?php $faded_color = cpotheme_alter_brightness($primary_color, -50); ?>
		.menu-main .current_page_ancestor > a,
		.menu-main .current-menu-item > a { color:<?php echo $primary_color; ?>; }
		.pagination .current { background-color:<?php echo $primary_color; ?>; }
		<?php endif; ?>
    </style>
	<?php
}
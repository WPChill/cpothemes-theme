<?php $sidebar_config = cpotheme_get_sidebar_position(); ?>
<?php if($sidebar_config != 'none'): ?>

<aside id="sidebar" class="sidebar sidebar-primary">
	<?php get_template_part('element', 'user'); ?> 
	<div class="menu-dashboard">
		<?php $post_ancestor = 182; ?>
		
		<?php $parent_post = get_post($post_ancestor); ?>
		<a class="menu-item" href="<?php echo get_permalink($parent_post->ID); ?>">
			<div class="menu-image">
				<?php echo get_the_post_thumbnail($parent_post->ID); ?>
			</div>
			<h4 class="menu-title"><?php echo $parent_post->post_title; ?></h4>
			<div class="menu-description"><?php echo $parent_post->post_excerpt; ?></div>
		</a>
		
		<?php $page_list = get_pages('sort_column=menu_order&sort_order=ASC&child_of='.$post_ancestor); ?>
		<?php foreach($page_list as $current_page): ?>
		<a class="menu-item" href="<?php echo get_permalink($current_page->ID); ?>">
			<div class="menu-image">
				<?php echo get_the_post_thumbnail($current_page->ID); ?>
			</div>
			<h4 class="menu-title"><?php echo $current_page->post_title; ?></h4>
			<div class="menu-description"><?php echo $current_page->post_excerpt; ?></div>
		</a>
		<?php endforeach; ?>
	</div>
	<?php dynamic_sidebar('primary-widgets'); ?>
</aside>

<?php if(in_array($sidebar_config, array('double', 'double-left', 'double-right'))): ?>
<aside id="sidebar-secondary" class="sidebar sidebar-secondary">
	<?php dynamic_sidebar('secondary-widgets'); ?>
</aside>
<?php endif; ?>

<?php endif; ?>
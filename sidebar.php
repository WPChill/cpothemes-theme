<?php $sidebar_config = cpotheme_get_sidebar_position(); ?>
<?php if($sidebar_config != 'none' && $sidebar_config != 'narrow'): ?>

<aside id="sidebar" class="sidebar sidebar-primary">
	<?php dynamic_sidebar('primary-widgets'); ?>
</aside>

<?php if(in_array($sidebar_config, array('double', 'double-left', 'double-right'))): ?>
<aside id="sidebar-secondary" class="sidebar sidebar-secondary">
	<?php dynamic_sidebar('secondary-widgets'); ?>
</aside>
<?php endif; ?>

<?php endif; ?>
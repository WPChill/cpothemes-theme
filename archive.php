<?php get_header(); ?>

<?php get_template_part('element', 'page-header'); ?>
	
<div id="main" class="main">
	<div class="container">		
		<section id="content" class="content content-wide">
			<?php do_action('cpotheme_before_content'); ?>
			
			<ul class="menu-portfolio">
				<li>
					<a href="http://www.cpothemes.com/blog">Blog</a>
				</li>
				<?php wp_list_categories("taxonomy=category&title_li="); ?>
			</ul>
			
			<?php if(have_posts()): ?>
			<?php cpotheme_grid(null, 'element', 'blog', 3, array('class' => 'column-narrow')); ?>
			<?php cpotheme_numbered_pagination(); ?>
			<?php endif; ?>
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>
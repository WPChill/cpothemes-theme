<?php get_header(); ?>

<section id="pagetitle" class="pagetitle">
	<div class="container">
		<h1 class="pagetitle-title">
			<?php echo single_tag_title('', true); ?>
		</h1>
		<div class="pagetitle-subtitle">
			<?php echo tag_description(); ?>
		</div>
	</div>
</section>
	
<div id="main" class="main">
	<div class="container">		
		<section id="content" class="content">
			<?php do_action('cpotheme_before_content'); ?>			
			<ul class="menu-portfolio">
				<li>
					<a href="<?php echo cpotheme_get_option('url_themes'); ?>"><?php _e('All', 'cpotheme'); ?></a>
				</li>
				<?php wp_list_categories("taxonomy=cpo_theme_category&title_li="); ?>
			</ul>
			<?php if(have_posts()): $feature_count = 0; ?>
			<div id="themes" class="themes">
				<?php while(have_posts()): the_post(); ?>
				<?php if($feature_count % 3 == 0 && $feature_count != 0) echo '<div class="col-divide"></div>'; $feature_count++; ?>
				<div class="column col3<?php if($feature_count % 3 == 0) echo ' col-last'; ?>">
					<?php get_template_part('element', 'theme'); ?>
				</div>
				<?php if($feature_count % 9 == 0 && $feature_count != 0) get_template_part('element', 'ad'); ?>
				<?php endwhile; ?>
				<div class='clear'></div>
			</div>
			<?php endif; ?>
			
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>

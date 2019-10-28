<?php get_header(); ?>

<section id="pagetitle" class="pagetitle">
	<div class="container">
		<h1 class="pagetitle-title heading"><?php echo single_tag_title('', true); ?></h1>
		<div class="pagetitle-subtitle"><?php _e('A comprehensive collection of guides for our WordPress themes.', 'cpotheme'); ?></div>			
	</div>
</section>

<div id="main" class="main">
	<div class="container">		
		<section id="content" class="content">
			<?php do_action('cpotheme_before_content'); ?>
			
			<a class="button-back button button-small" href="<?php echo cpotheme_get_option('url_docs'); ?>"><span class="icon-angle-double-left"></span> <?php _e('Go Back'); ?></a>
			
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
				<div class="support-icon"></div>
				<div class="support-body">
					<div class="support-title">
						<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Go to %s', 'cpotheme'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a> <?php cpotheme_edit(); ?>
					</div>
					<div class="support-content">
						<?php if(has_excerpt()) the_excerpt(); ?>
					</div>
				</div>
				<div class="clear"></div>
			</article>
			<?php endwhile; ?>
			<?php cpotheme_numbered_pagination(); ?>
			<?php endif; ?>
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>
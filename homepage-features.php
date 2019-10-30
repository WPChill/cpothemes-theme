<?php $query = new WP_Query( 'post_type=cpo_feature&posts_per_page=-1&order=ASC&orderby=menu_order' ); ?>
<?php
if ( $query->posts ) :
	$feature_count = 0;
	?>
		<div id="features" class="features">
			<div class="container">
				<h2 class="section-heading"><?php echo esc_html__( 'Premium-Grade Features', 'cpotheme' ); ?></h2>
				<div class="section-subheading"><?php echo esc_html__( 'Swiftly create any kind of website with ease.', 'cpotheme' ); ?></div>
			<?php cpotheme_grid( $query->posts, 'element', 'feature', 2 ); ?>
			</div>
		</div>
	<?php endif; ?>

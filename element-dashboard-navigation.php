<ul class="menu-dashboard">
	<?php if($post->post_parent == 0): ?>
	<?php $current_post = get_post($post->ID); ?>
	<li class="page_item page_title current_page_item"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $current_post->post_title; ?></a></li>
	<?php wp_list_pages("title_li=&child_of=".$post->ID."&parent=".$post->ID); ?>
	<?php else: ?>
	<?php $parent_post = get_post($post->post_parent); ?>
	<li class="page_item page_title"><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo $parent_post->post_title; ?></a></li>
	<?php wp_list_pages("title_li=&child_of=".$post->post_parent."&parent=".$post->post_parent); ?>
	<?php endif; ?>
</ul>
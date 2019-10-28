<?php if(!(is_page() && !comments_open())): ?>
<div id="comments" class="comments">
	<?php if(cpotheme_comments_protected()) return; ?>
	
	<?php if(have_comments()): ?>
	<?php cpotheme_comments_title(); ?>
	<ol class="comments-list">
		<?php wp_list_comments('type=comment&callback=cpotheme_comment'); ?>
	</ol>
	<?php cpotheme_comments_pagination(); ?>
    <?php endif; ?>
	
</div>

<?php comment_form(); ?>

<?php endif; ?>
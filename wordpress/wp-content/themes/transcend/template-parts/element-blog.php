<article <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
	<?php if(has_post_thumbnail()): ?>
	<div class="post-image">
		<?php cpotheme_postpage_image(); ?>
	</div>
	<?php endif; ?>	
	<div class="post-body<?php if(has_post_thumbnail()) echo ' post-body-image'; ?>">
		<?php cpotheme_postpage_title(); ?>
		
		<div class="post-byline">
			<?php cpotheme_postpage_date(); ?>
			<?php cpotheme_postpage_author(); ?>
			<?php cpotheme_postpage_categories(); ?>
			<?php cpotheme_postpage_comments(); ?>
			<?php cpotheme_edit(); ?>
		</div>
		
		<div class="post-content">
			<?php cpotheme_postpage_content(); ?>
		</div>
		<?php if(is_singular('post')) cpotheme_postpage_tags(); ?>
		<?php cpotheme_postpage_readmore(); ?>
	</div>
	<div class="clear"></div>
</article>
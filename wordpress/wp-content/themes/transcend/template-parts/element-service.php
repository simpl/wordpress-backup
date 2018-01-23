<div class="service">
	<a class="service-image secondary-color-bg" href="<?php the_permalink(); ?>">
		<?php cpotheme_icon(get_post_meta(get_the_ID(), 'service_icon', true), 'service-icon'); ?>
		<?php the_post_thumbnail('service', array('title' => '')); ?>
	</a>
	<div class="service-overlay"></div>
	<div class="service-content">
		<h3 class="service-title">
			<a class="service-image" href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
		<?php if(has_excerpt()): ?>
		<div class="service-description">
			<?php the_excerpt(); ?>
		</div>
		<?php endif; ?>
		<?php cpotheme_edit(); ?>
	</div>
</div>
<?php $query = new WP_Query('post_type=cpo_portfolio&order=ASC&orderby=menu_order&meta_key=portfolio_featured&meta_value=1&posts_per_page=-1'); ?>
<?php if($query->posts): ?>
<div id="portfolio" class="portfolio portfolio-home">
	<?php cpotheme_block('home_portfolio', 'portfolio-heading primary-color-bg dark', 'container'); ?>
	<?php $columns = $query->post_count; if($columns == 0 || $columns > 7) $columns = 7; ?>
	<?php cpotheme_grid($query->posts, 'element', 'portfolio', $columns, array('class' => 'column-fit')); ?>
</div>
<?php endif; ?>
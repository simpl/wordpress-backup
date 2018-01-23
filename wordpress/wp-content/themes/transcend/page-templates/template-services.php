<?php /* Template Name: Services */ ?>
<?php get_header(); ?>

<?php get_template_part('template-parts/element', 'page-header'); ?>

<div id="main" class="main">
	<div class="container">
		<section id="content" class="content">
			<?php do_action('cpotheme_before_content'); ?>
			
			<?php if(have_posts()) while(have_posts()): the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			</div>
			<?php endwhile; ?>
			
			<?php $columns = cpotheme_get_option('services_columns'); ?>
			<?php $query = new WP_Query('post_type=cpo_service&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>
			<?php if($query->posts): ?>
			<section id="services" class="services">
				<?php cpotheme_grid($query->posts, 'element', 'service', $columns); ?>
			</section>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>
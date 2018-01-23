<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Structural
 */

if ( ! is_dynamic_sidebar( ) ) {
	return;
}
?>

		<div class="one-third column">
			<?php dynamic_sidebar('footer'); ?>
		</div>

		<div class="one-third column">
			<?php dynamic_sidebar('footer-2'); ?>
		</div>

		<div class="one-third column">
			<?php dynamic_sidebar('footer-3'); ?>
		</div>

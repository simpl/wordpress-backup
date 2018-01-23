/**
 * Customizer custom js
 */

jQuery(document).ready(function() {
   jQuery('.wp-full-overlay-sidebar-content').prepend('<div class="samurai-ads"> <a href="https://samuraithemes.com/themes/samurai-plus-clean-and-minimalist-blog-theme/" class="button" target="_blank">{pro}</a></div>'.replace('{pro}',samurai_customizer_js_obj.pro));
});
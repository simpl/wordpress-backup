(function($){
    $('.posts-navigation ').addClass('post-navigation');
	$(function(){
		$('.flexslider').flexslider();   
	});
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$('body').addClass( 'has-header-video' );
	});

})(jQuery);

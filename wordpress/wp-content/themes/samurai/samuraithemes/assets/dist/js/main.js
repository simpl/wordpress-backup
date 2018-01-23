( function( $ ) {
	jQuery(document).ready(function () {

		new WOW().init();
		
		jQuery('.main-navigation').meanmenu({
			meanMenuContainer: '.menu-container',
			meanScreenWidth: "768",
			meanRevealPosition: "right",
		});
	});
} ) ( jQuery );
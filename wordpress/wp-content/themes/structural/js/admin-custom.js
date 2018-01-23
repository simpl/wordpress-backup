(function( $ ) {
	$(function() {
		if( $.fn.iconpicker ) {
			$('.faip').iconpicker(); 
	    }
	    $('.iconpicker-element').on('iconpickerSelected', function() {
			$(this).trigger('change');
		});
	});

})( jQuery );

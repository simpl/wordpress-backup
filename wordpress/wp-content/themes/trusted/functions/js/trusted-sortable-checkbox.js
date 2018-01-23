jQuery( document ).ready( function($) {

	/* === Sortable Multi-CheckBoxes === */

	/* Make it sortable. */
	$( 'ul.trusted-multicheck-sortable-list' ).sortable({
		handle: '.trusted-multicheck-sortable-handle',
		axis: 'y',
		update: function( e, ui ){
			$('input.trusted-multicheck-sortable-item').trigger( 'change' );
		}
	});

	/* On changing the value. */
	$( "input.trusted-multicheck-sortable-item" ).on( 'change', function() {

		/* Get the value, and convert to string. */
		this_checkboxes_values = $( this ).parents( 'ul.trusted-multicheck-sortable-list' ).find( 'input.trusted-multicheck-sortable-item' ).map( function() {
			var active = '0';
			if( $(this).prop("checked") ){
				var active = '1';
			}
			return this.name + ':' + active;
		}).get().join( ',' );

		/* Add the value to hidden input. */
		$( this ).parents( 'ul.trusted-multicheck-sortable-list' ).find( 'input.trusted-multicheck-sortable' ).val( this_checkboxes_values ).trigger( 'change' );

	});

	/* === Multi-CheckBoxes === */

	/* On changing the value. */
	$( "input.trusted-multicheck-item" ).on( 'change', function() {

		/* Get the value (only the "checked" item), and convert to comma separated string. */
		this_checkboxes_values = $( this ).parents( 'ul.trusted-multicheck-list' ).find( 'input.trusted-multicheck-item:checked' ).map( function() {
			return this.name;
		}).get().join( ',' );

		/* Add the value to hidden input. */
		$( this ).parents( 'ul.trusted-multicheck-list' ).find( 'input.trusted-multicheck' ).val( this_checkboxes_values ).trigger( 'change' );

	});
});
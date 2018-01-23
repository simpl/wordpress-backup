/**
 * Customizer Set Child Theme Settings
 *
 */
( function( $ ) {
    
    $( window ).load( function() {
        
        var api = wp.customize;
        var control = api.control.instance( 'avant-header-layout' );
        control.setting.set( 'avant-header-layout-three' );
        
    } );
    
} )( jQuery );

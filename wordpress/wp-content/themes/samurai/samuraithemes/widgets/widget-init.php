<?php

if ( ! function_exists( 'samurai_load_home_widgets' ) ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function samurai_load_home_widgets() {

        // Highlight Post.
        register_widget( 'Samurai_Featured_Post' );

        // Author Widget.
        register_widget( 'Samurai_Author_Widget' );
		
		// Social Widget.
        register_widget( 'Samurai_Social_Widget' );

    }

endif;

add_action( 'widgets_init', 'samurai_load_home_widgets' );

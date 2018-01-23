<?php
/**
 * Custom widgets.
 *
 * @package Samurai
 */


if ( ! class_exists( 'Samurai_Author_Widget' ) ) :

	/**
	 * Author widget class.
	 *
	 * @since 1.0.0
	 */
	class Samurai_Author_Widget extends WP_Widget {

	    function __construct() {
	    	$opts = array(
				'classname'   => '',
				'description' => esc_html__( 'Displays Author Information. Place it in sidebar.', 'samurai' ),
    		);

			parent::__construct( 'samurai-author-widget', esc_html__( 'Samurai: Author Info', 'samurai' ), $opts );
	    }


	    function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $page_id    = !empty( $instance['page'] ) ? $instance['page'] : '';

            $arguments = array(
                'post_type'             => 'page',
                'page_id'               => absint( $page_id ),
                'posts_per_page'        => 1,
                'ignore_sticky_posts'   => true
            );

            echo $args['before_widget'];

            echo $args['before_title'];
            echo esc_html( $title );
            echo $args['after_title'];

            $query = new WP_Query( $arguments );
            if( $query->have_posts() ) :
                while( $query->have_posts() ) :
                    $query->the_post();
                    if( has_post_thumbnail() ) :
            ?>
                        <div class="about_author_featured_iamge">
                            <?php the_post_thumbnail( 'samurai-thumbnail-2', array( 'class' => 'img-responsive' ) ); ?>
                        </div>
                    <?php
                    endif;
                    ?>
                    <div class="about_author_tagline">
                        <?php
                            the_content();
                        ?>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;

            echo $args['after_widget'];

	    }

	    function update( $new_instance, $old_instance ) {
	        $instance = $old_instance;

            $instance[ 'title' ]    = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'page' ] = absint( $new_instance[ 'page' ] );

	        return $instance;
	    }

	    function form( $instance ) {

	        $instance = wp_parse_args( (array) $instance, array(
                'title'         => '',
                'page'          => '',
	        ) );
	        ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                    <strong><?php esc_html_e( 'Title: ', 'samurai' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "title" ) ) ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'page' ) ); ?>">
                    <strong><?php esc_html_e( 'Page:', 'samurai' ); ?></strong>
                </label>
                <?php
                    wp_dropdown_pages( array(
                            'id'               => $this->get_field_id( "page" ),
                            'class'            => 'widefat',
                            'name'             => $this->get_field_name( "page" ),
                            'selected'         => $instance["page"],
                            'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'samurai' ),
                        )
                    );
                ?>
            </p>           
	        <?php
        }

	}

endif;

if( ! class_exists( 'Samurai_Social_Widget' ) ) :
    /**
     * Social widget class.
     *
     * @since 1.0.0
     */
    class Samurai_Social_Widget extends WP_Widget {
        function __construct() {
            $opts = array(
                'classname'   => '',
                'description' => esc_html__( 'Displays Social Links. Place it in sidebar.', 'samurai' ),
            );

            parent::__construct( 'samurai-social-widget', esc_html__( 'Samurai: Social Widget', 'samurai' ), $opts );
        }


        function widget( $args, $instance ) {

            $title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            $facebook       = !empty( $instance['facebook'] ) ? $instance['facebook'] : '';
            $twitter        = !empty( $instance['twitter'] ) ? $instance['twitter'] : '';
            $google_plus    = !empty( $instance['google_plus'] ) ? $instance['google_plus'] : '';
            $instagram      = !empty( $instance['instagram'] ) ? $instance['instagram'] : '';
            $pinterest      = !empty( $instance['pinterest'] ) ? $instance['pinterest'] : '';
            $snapchat       = !empty( $instance['snapchat'] ) ? $instance['snapchat'] : '';
            $vk             = !empty( $instance['vk'] ) ? $instance['vk'] : '';

            echo $args['before_widget'];

            echo $args['before_title'];
            echo esc_html( $title );
            echo $args['after_title'];
            ?>
            <div class="widget_social_inner animated wow fadeInUp">
                <ul class="widget_social_icons_box">
                    <?php
                        if( !empty( $facebook ) ) :
                    ?>
                        <li class="facebook_box"><a href="<?php echo esc_attr( esc_url( $facebook ) ); ?>"><?php esc_html_e( 'Facebook', 'samurai'); ?><span><?php esc_html_e( 'Follow', 'samurai'); ?></span></a></li>
                    <?php
                        endif;
                        if( !empty( $twitter ) ) :
                    ?>
                        <li class="twitter_box"><a href="<?php echo esc_attr( esc_url( $twitter ) ); ?>"><?php esc_html_e( 'Twitter', 'samurai'); ?><span><?php esc_html_e( 'Follow', 'samurai'); ?></span></a></li>
                    <?php
                        endif;
                        if( !empty( $google_plus ) ) :
                    ?>
                        <li class="googleplus_box"><a href="<?php echo esc_attr( esc_url( $google_plus ) ); ?>"><?php esc_html_e( 'Google Plus', 'samurai'); ?><span><?php esc_html_e( 'Follow', 'samurai'); ?></span></a></li>
                    <?php
                        endif;
                        if( !empty( $instagram ) ) :
                    ?>
                        <li class="instagram_box"><a href="<?php echo esc_attr( esc_url( $instagram ) ); ?>"><?php esc_html_e( 'Instagram', 'samurai'); ?><span><?php esc_html_e( 'Follow', 'samurai'); ?></span></a></li>
                    <?php
                        endif;if( !empty( $pinterest ) ) :
                    ?>
                        <li class="pinterest_box"><a href="<?php echo esc_attr( esc_url( $pinterest ) ); ?>"><?php esc_html_e( 'Pinterest', 'samurai'); ?><span><?php esc_html_e( 'Follow', 'samurai'); ?></span></a></li>
                    <?php
                        endif;
                        if( !empty( $snapchat ) ) :
                    ?>
                        <li class="snapchat_box"><a href="<?php echo esc_attr( esc_url( $snapchat ) ); ?>"><?php esc_html_e( 'Snapchat', 'samurai'); ?><span><?php esc_html_e( 'Follow', 'samurai'); ?></span></a></li>
                    <?php
                        endif;
                        if( !empty( $vk ) ) :
                    ?>
                        <li class="vk_box"><a href="<?php echo esc_attr( esc_url( $vk ) ); ?>"><?php esc_html_e( 'VK', 'samurai'); ?><span><?php esc_html_e( 'Follow', 'samurai'); ?></span></a></li>
                    <?php
                        endif;
                    ?>
                </ul>
            </div>
            <?php
            echo $args['after_widget'];

        }

        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance[ 'title' ]        = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'facebook' ]     = esc_url_raw( $new_instance[ 'facebook' ] );
            $instance[ 'twitter' ]      = esc_url_raw( $new_instance[ 'twitter' ] );
            $instance[ 'google_plus' ]  = esc_url_raw( $new_instance[ 'google_plus' ] );
            $instance[ 'instagram' ]    = esc_url_raw( $new_instance[ 'instagram' ] );
            $instance[ 'pinterest' ]    = esc_url_raw( $new_instance[ 'pinterest' ] );
            $instance[ 'snapchat' ]     = esc_url_raw( $new_instance[ 'snapchat' ] );
            $instance[ 'vk' ]           = esc_url_raw( $new_instance[ 'vk' ] );

            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array(
                'title'         => '',
                'facebook'      => '',
                'twitter'       => '',
                'google_plus'   => '',
                'instagram'     => '',
                'pinterest'     => '',
                'snapchat'      => '',
                'vk'            => '',

            ) );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                    <strong><?php esc_html_e( 'Title: ', 'samurai' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>">
                    <strong><?php esc_html_e( 'Facebook Link:', 'samurai' ); ?></strong>
                </label>
                <input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>">
                    <strong><?php esc_html_e( 'Twitter Link:', 'samurai' ); ?></strong>
                </label>
                <input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>">
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>">
                    <strong><?php esc_html_e( 'Google Plus Link:', 'samurai' ); ?></strong>
                </label>
                <input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google_plus' ) ); ?>" value="<?php echo esc_attr( $instance['google_plus'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>">
                    <strong><?php esc_html_e( 'Instagram Link:', 'samurai' ); ?></strong>
                </label>
                <input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>">
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>">
                    <strong><?php esc_html_e( 'Pinterest Link:', 'samurai' ); ?></strong>
                </label>
                <input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" value="<?php echo esc_attr( $instance['pinterest'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'snapchat' ) ); ?>">
                    <strong><?php esc_html_e( 'Snapchat Link:', 'samurai' ); ?></strong>
                </label>
                <input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'snapchat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'snapchat' ) ); ?>" value="<?php echo esc_attr( $instance['snapchat'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>">
                    <strong><?php esc_html_e( 'VK Link:', 'samurai' ); ?></strong>
                </label>
                <input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" value="<?php echo esc_attr( $instance['vk'] ); ?>">
            </p>           
            <?php
        }
    }

endif;
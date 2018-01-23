<?php
/**
 * Custom widgets.
 *
 * @package Samurai
 */

add_action( 'widgets_init', 'samurai_load_home_widgets' );


if ( ! class_exists( 'Samurai_Featured_Post' ) ) :

	/**
	 * Highlight Post widget class.
	 *
	 * @since 1.0.0
	 */
	class Samurai_Featured_Post extends WP_Widget {

	    function __construct() {
	    	$opts = array(
				'classname'   => '',
				'description' => esc_html__( 'Displays Featured Post in Home Page. Place it in Home Widget Area Top.', 'samurai' ),
    		);

			parent::__construct( 'samurai-featured-post', esc_html__( 'Samurai: Featured Post', 'samurai' ), $opts );
	    }


	    function widget( $args, $instance ) {

            $cat_id    = !empty( $instance['cat'] ) ? $instance['cat'] : '';

            $args = array(
                'post_type'             => 'post',
                'cat'                     => absint( $cat_id ),
                'posts_per_page'        => 1,
                'ignore_sticky_posts'   => true
            );

            $query = new WP_Query( $args );
            if( $query->have_posts() ) :
                while( $query->have_posts() ) :
                    $query->the_post();
            ?>
                    <section id="left_featured_content">
                        <div class="left_featured_content_featured_image">
                            <?php
                                if( has_post_thumbnail() ) :
                                    the_post_thumbnail( 'samurai-featured-main', array( 'class'  => 'img-responsive' ) );
                                endif;
                            ?>
                            <div class="content_featured_image_mask">
                            </div>
                            <!-- // content_featured_image_mask -->
                            <div class="left_featured_contents_holder">
                                <div class="left_featured_content_title">
                                    <h2><?php the_title(); ?></h2>
                                </div>
                                <div class="left_featured_content_permalink">
                                    <a href="<?php the_permalink(); ?>">
                                        <span class="read_more_btn">
                                            <?php
                                                esc_html_e( 'Read More', 'samurai' );
                                            ?>
                                        </span>
                                    </a>
                                </div>
                                <!-- // left_featured_content_permalink -->
                            </div>
                            <!-- // left_featured_contents_holder -->
                        </div>
                        <!-- // left_featured_content_featured_image -->
                    </section>
            <?php
                endwhile;
            endif;

	    }

	    function update( $new_instance, $old_instance ) {
	        $instance = $old_instance;

            $instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );

	        return $instance;
	    }

	    function form( $instance ) {

	        $instance = wp_parse_args( (array) $instance, array(
                'cat'           => ''
	        ) );
	        ?>
            <p class="custom-dropdown-posts">
                <label for="<?php echo esc_attr( $this->get_field_name('cat') ); ?>">
                    <strong><?php esc_html_e('Select Category: ', 'samurai'); ?></strong>
                </label>
                <?php
                    $cat_args = array(
                        'orderby'   => 'name',
                        'hide_empty'    => 0,
                        'id'    => $this->get_field_id( 'cat' ),
                        'name'  => $this->get_field_name( 'cat' ),
                        'class' => 'widefat',
                        'taxonomy'  => 'category',
                        'selected'  => absint( $instance[ 'cat' ] ),
                        'show_option_all'   => esc_html__( 'Show Recent Posts', 'samurai' )
                    );
                    wp_dropdown_categories( $cat_args );
                ?>
                <small><?php esc_html_e( 'Only one latest post of the selected category will be displayed', 'samurai' ); ?></small>
            </p>           
	        <?php
	    }
	}

endif;
<?php
/*
 Plugin Name: Owl Slider
 Plugin URI: https://faithcoder.com
 Author: FaithCoder
 Author URI: https:://faithcoder.com
 Version: 1.00
 Description: Simple Slider 
 */

class OwlSlider
{
    public function __construct()
    {
        add_action('init', array($this, 'owl_slider'), 0);
        add_action('wp_enqueue_scripts', array($this, 'owl_slider_scripts'));
        add_shortcode('owl_slider', array($this, 'owl_slider_shortcode'));
    }

    public function owl_slider_shortcode()
    {
    ?>

        <section id="demos">
            <div class="row">
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme">
                        <?php 
                            $slider = new WP_Query(array(
                                'post_type' => 'owl_slider',
                            ));
                        ?>
                        <?php while ($slider->have_posts()) : $slider->the_post(); ?>
                            <div class="item">
                                <h5><?php the_title(); ?></h5>
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                            </div>
                        <?php endwhile ?>
                    </div>

                    <script>
                        jQuery(document).ready(function() {
                            var owl = jQuery('.owl-carousel');
                            owl.owlCarousel({
                                margin: 10,
                                nav: true,
                                loop: true,
                                center: true,
                                //autoWidth:true,
                                responsiveClass:true,
                                responsive: {
                                    0: {
                                        items: 1
                                    },
                                    600: {
                                        items: 3
                                    },
                                    1000: {
                                        items: 4,
                                        nav: true,
                                    }
                                }
                            })
                        })
                    </script>
                </div>
            </div>
        </section>

    <?php
    }

    public function owl_slider_scripts()
    {
        wp_enqueue_style('carousel', plugins_url('/assets/owlcarousel/assets/owl.carousel.min.css', __FILE__));
        wp_enqueue_style('carousel-default-theme', plugins_url('/assets/owlcarousel/assets/owl.theme.default.min.css', __FILE__));
        wp_enqueue_style('theme-doc', plugins_url('assets/css/docs.theme.min.css', __FILE__));

        wp_enqueue_script('owl-carousel', plugins_url('assets/owlcarousel/owl.carousel.js', __FILE__), array('jquery'));
        // wp_enqueue_script('highlight', plugins_url('assets/vendors/highlight.js', __FILE__), array('jquery'));
        // wp_enqueue_script('app', plugins_url('assets/js/app.js', __FILE__), array('jquery'));
    }

    // Register Custom Post Type
    public function owl_slider()
    {
        $labels = array(
            'name'                  => _x('OWL Slider', 'Post Type General Name', 'owl_slider'),
            'singular_name'         => _x('Owl Slider', 'Post Type Singular Name', 'owl_slider'),
            'menu_name'             => __('OWL Slider', 'owl_slider'),
            'name_admin_bar'        => __('Post Type', 'owl_slider'),
            'archives'              => __('Item Archives', 'owl_slider'),
            'attributes'            => __('Item Attributes', 'owl_slider'),
            'parent_item_colon'     => __('Parent Item:', 'owl_slider'),
            'all_items'             => __('All Items', 'owl_slider'),
            'add_new_item'          => __('Add New Item', 'owl_slider'),
            'add_new'               => __('Add New', 'owl_slider'),
            'new_item'              => __('New Item', 'owl_slider'),
            'edit_item'             => __('Edit Item', 'owl_slider'),
            'update_item'           => __('Update Item', 'owl_slider'),
            'view_item'             => __('View Item', 'owl_slider'),
            'view_items'            => __('View Items', 'owl_slider'),
            'search_items'          => __('Search Item', 'owl_slider'),
            'not_found'             => __('Not found', 'owl_slider'),
            'not_found_in_trash'    => __('Not found in Trash', 'owl_slider'),
            'featured_image'        => __('Featured Image', 'owl_slider'),
            'set_featured_image'    => __('Set featured image', 'owl_slider'),
            'remove_featured_image' => __('Remove featured image', 'owl_slider'),
            'use_featured_image'    => __('Use as featured image', 'owl_slider'),
            'insert_into_item'      => __('Insert into item', 'owl_slider'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'owl_slider'),
            'items_list'            => __('Items list', 'owl_slider'),
            'items_list_navigation' => __('Items list navigation', 'owl_slider'),
            'filter_items_list'     => __('Filter items list', 'owl_slider'),
        );
        $args = array(
            'label'                 => __('Owl Slider', 'owl_slider'),
            'description'           => __('Post Type Description', 'owl_slider'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'thumbnail'),
            'taxonomies'            => array('category', 'post_tag'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'menu_icon'             => 'dashicons-admin-collapse',

        );
        register_post_type('owl_slider', $args);
    }
}

new OwlSlider();

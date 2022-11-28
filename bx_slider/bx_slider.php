<?php

/*
Plugin Name: BX Slider  
Plugin URI: https://faithcoder.com
Author: FaithCoder 
Author URI: https://faithcoder.com
Version: 1.1.0
Description: BX Slider 
*/


class BxSlider
{
    public function __construct()
    {
        add_action('init', array($this, 'bx_slider_post'), 0);
        add_action('wp_enqueue_scripts', array($this, 'all_scripts'));
        add_shortcode('bx_slider', array($this, 'bxslider_shortcode'));
    }

    //shortcode frontend
    public function bxslider_shortcode()
    {
?>
        <div class="slider-area">

            <ul class="bxslider">
                <?php
                $slider = new WP_Query(array(
                    'post_type' => 'bx_slider',
                ));
                ?>
                <?php while ($slider->have_posts()) : $slider->the_post(); ?>
                    <li><img src="<?php the_post_thumbnail_url(); ?> " title="<?php the_title(); ?>" /></li>
                <?php endwhile; ?>
            </ul>

        </div>
<?php
    }


    //add styles and scripts 

    public function all_scripts()
    {
        wp_enqueue_style('bxsliderstyle', plugins_url('css/jquery.bxslider.css', __FILE__));
        wp_enqueue_script('bxsliderjs', plugins_url('js/jquery.bxslider.js', __FILE__), array('jquery'));
        wp_enqueue_script('bxslidercustomjs', plugins_url('js/app.js', __FILE__), array('jquery'));
    }
    // Register Custom Post Type
    public function bx_slider_post()
    {

        $labels = array(
            'name'                  => _x('BX Sliders', 'Post Type General Name', 'bx_slider'),
            'singular_name'         => _x('BX Slider', 'Post Type Singular Name', 'bx_slider'),
            'menu_name'             => __('BX Slider', 'bx_slider'),
            'name_admin_bar'        => __('Post Type', 'bx_slider'),
            'archives'              => __('Item Archives', 'bx_slider'),
            'attributes'            => __('Item Attributes', 'bx_slider'),
            'parent_item_colon'     => __('Parent Item:', 'bx_slider'),
            'all_items'             => __('All Items', 'bx_slider'),
            'add_new_item'          => __('Add New Item', 'bx_slider'),
            'add_new'               => __('Add New', 'bx_slider'),
            'new_item'              => __('New Item', 'bx_slider'),
            'edit_item'             => __('Edit Item', 'bx_slider'),
            'update_item'           => __('Update Item', 'bx_slider'),
            'view_item'             => __('View Item', 'bx_slider'),
            'view_items'            => __('View Items', 'bx_slider'),
            'search_items'          => __('Search Item', 'bx_slider'),
            'not_found'             => __('Not found', 'bx_slider'),
            'not_found_in_trash'    => __('Not found in Trash', 'bx_slider'),
            'featured_image'        => __('Featured Image', 'bx_slider'),
            'set_featured_image'    => __('Set featured image', 'bx_slider'),
            'remove_featured_image' => __('Remove featured image', 'bx_slider'),
            'use_featured_image'    => __('Use as featured image', 'bx_slider'),
            'insert_into_item'      => __('Insert into item', 'bx_slider'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'bx_slider'),
            'items_list'            => __('Items list', 'bx_slider'),
            'items_list_navigation' => __('Items list navigation', 'bx_slider'),
            'filter_items_list'     => __('Filter items list', 'bx_slider'),
        );
        $args = array(
            'label'                 => __('BX Slider', 'bx_slider'),
            'description'           => __('Post Type Description', 'bx_slider'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'thumbnail'),
            #'taxonomies'            => array('category', 'post_tag'),
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
        );
        register_post_type('bx_slider', $args);
    }
}

new BxSlider;

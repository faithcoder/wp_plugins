<?php
 /*
 Plugin Name: Owl Slider
 Plugin URI: https://faithcoder.com
 Author: FaithCoder
 Author URI: https:://faithcoder.com
 Version: 1.00
 Description: Simple Slider 
 */

 class OwlSlider {
    public function __construct()
    {
        add_action( 'init', 'owl_slider', 0 );
    }
    // Register Custom Post Type
    public function owl_slider() {

        $labels = array(
            'name'                  => _x( 'OWL Slider', 'Post Type General Name', 'owl_slider' ),
            'singular_name'         => _x( 'Owl Slider', 'Post Type Singular Name', 'owl_slider' ),
            'menu_name'             => __( 'OWL SLIDer', 'owl_slider' ),
            'name_admin_bar'        => __( 'Post Type', 'owl_slider' ),
            'archives'              => __( 'Item Archives', 'owl_slider' ),
            'attributes'            => __( 'Item Attributes', 'owl_slider' ),
            'parent_item_colon'     => __( 'Parent Item:', 'owl_slider' ),
            'all_items'             => __( 'All Items', 'owl_slider' ),
            'add_new_item'          => __( 'Add New Item', 'owl_slider' ),
            'add_new'               => __( 'Add New', 'owl_slider' ),
            'new_item'              => __( 'New Item', 'owl_slider' ),
            'edit_item'             => __( 'Edit Item', 'owl_slider' ),
            'update_item'           => __( 'Update Item', 'owl_slider' ),
            'view_item'             => __( 'View Item', 'owl_slider' ),
            'view_items'            => __( 'View Items', 'owl_slider' ),
            'search_items'          => __( 'Search Item', 'owl_slider' ),
            'not_found'             => __( 'Not found', 'owl_slider' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'owl_slider' ),
            'featured_image'        => __( 'Featured Image', 'owl_slider' ),
            'set_featured_image'    => __( 'Set featured image', 'owl_slider' ),
            'remove_featured_image' => __( 'Remove featured image', 'owl_slider' ),
            'use_featured_image'    => __( 'Use as featured image', 'owl_slider' ),
            'insert_into_item'      => __( 'Insert into item', 'owl_slider' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'owl_slider' ),
            'items_list'            => __( 'Items list', 'owl_slider' ),
            'items_list_navigation' => __( 'Items list navigation', 'owl_slider' ),
            'filter_items_list'     => __( 'Filter items list', 'owl_slider' ),
        );
        $args = array(
            'label'                 => __( 'Owl Slider', 'owl_slider' ),
            'description'           => __( 'Post Type Description', 'owl_slider' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor' ),
            'taxonomies'            => array( 'category', 'post_tag' ),
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
        register_post_type( 'owl_slider', $args );

    }


 }
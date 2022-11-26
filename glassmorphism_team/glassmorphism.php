<?php

/*
Plugin Name: Glassmorphism
Plugin URI: https://faithcoder.com
Author: FaithCoder
Author URI: https://faithcoder.com

*/

class Glassmorphism
{
    //all actions to load first
    public function __construct()
    {
        add_action('init', array($this, 'glassmorphism_custom_post'), 0); //hook for custom post
        add_action('wp_enqueue_scripts', array($this, 'all_scripts')); //hook for adding all style and js files 
        add_shortcode('glassmorphism', array($this, 'glassmorphism_shortcode')); //hook for adding shortcode
        add_action('add_meta_boxes', array($this, 'custom_metabox')); //hook for adding custom metabox
        add_action('save_post', array($this, 'update_metabox')); //hook for saving meta fields data
    }

    //all css and js files are added here
    public function all_scripts()
    {
        wp_enqueue_style('glass', plugins_url('css/style.css', __FILE__));
        wp_enqueue_script('tilt', plugins_url('js/vanilla-tilt.min.js', __FILE__), array('jquery'));
    }

    //adding metabox 
    public function custom_metabox()
    {
        add_meta_box("custom_metabox_social", "Social Links", array($this, "custom_metabox_field"), "glassmorphism_design", "normal", "low");
    }

    //adding metabox fields
    public function custom_metabox_field()
    {
?>
        <style> /* custom css for meta fields */
            .social_label {
                display: block;
            }

            .meta-box-sortables input {
                width: 100% !important;
            }
        </style>

        <p>
            <label for="" class="social_label">Facebook</label>
            <input class="social_input" type="text" name="facebook" id="facebook" placeholder="Insert your Facebook profile link" value="<?php echo get_post_meta(get_the_ID(), 'facebook', true); ?>" />
        </p>
        <p>
            <label for="" class="social_label">Twitter</label>
            <input class="social_input" type="text" name="twitter" id="twitter" placeholder="Insert your Twitter profile link" value="<?php echo get_post_meta(get_the_ID(), 'twitter', true); ?>" />
        </p>
        <p>
            <label for="" class="social_label">Linkedin</label>
            <input class="social_input" type="text" name="linkedin" id="linkedin" placeholder="Insert your LinkedIn profile link" value="<?php echo get_post_meta(get_the_ID(), 'linkedin', true); ?>" />
        </p>
        <p>
            <label for="" class="social_label">Message Me</label>
            <input class="social_input" type="text" name="message" id="message" placeholder="Insert Message me Link" value="<?php echo get_post_meta(get_the_ID(), 'message', true); ?>" />
        </p>
    <?php
    }
    //to save data from meta fields 
    public function update_metabox()
    {
        update_post_meta(get_the_ID(), "facebook", $_POST["facebook"]);
        update_post_meta(get_the_ID(), "twitter", $_POST["twitter"]);
        update_post_meta(get_the_ID(), "linkedin", $_POST["linkedin"]);
        update_post_meta(get_the_ID(), "message", $_POST["message"]);
    }
    //shortcode function to generate custom design 
    public function glassmorphism_shortcode()
    {
    ?>
        <?php

        $card = new WP_Query(array(
            'post_type' => 'glassmorphism_design',
        ));

        ?>
        <?php while ($card->have_posts()) : $card->the_post();

        ?>
            <div class="container">
            <div class="card" data-tilt>
                <img src="<?php the_post_thumbnail_url(); ?> " alt="">
                <h2><?php the_title() ?></h2>
                <p><?php the_content(); ?></p>

                <div class="links">
                    <a href="<?php echo get_post_meta(get_the_ID(), 'facebook', true); ?>">
                        <img src="<?php echo plugins_url('images/facebook.png', __FILE__); ?>" alt="" />
                    </a>
                    <a href="<?php echo get_post_meta(get_the_ID(), 'twitter', true); ?>">
                        <img src="<?php echo plugins_url('images/twitter.png', __FILE__); ?>" alt="" />
                    </a>
                    <a href="<?php echo get_post_meta(get_the_ID(), 'linkedin', true); ?>">
                        <img src="<?php echo plugins_url('images/telegram.png', __FILE__); ?>" alt="" />
                    </a>
                </div>
                <a href="<?php echo get_post_meta(get_the_ID(), 'message', true); ?>" class="btn">message me</a>
            </div>
            </div>
        <?php endwhile; ?>
<?php
    }
    // Register Custom Post Type
    function glassmorphism_custom_post()
    {

        $labels = array(
            'name'                  => _x('Glassmorphism', 'Post Type General Name', 'glassmorphism_design'),
            'singular_name'         => _x('Glassmorphism', 'Post Type Singular Name', 'glassmorphism_design'),
            'menu_name'             => __('Glassmorphism Team', 'glassmorphism_design'),
            'name_admin_bar'        => __('Glassmorphism Team', 'glassmorphism_design'),
            'archives'              => __('Item Archives', 'glassmorphism_design'),
            'attributes'            => __('Item Attributes', 'glassmorphism_design'),
            'parent_item_colon'     => __('Parent Item:', 'glassmorphism_design'),
            'all_items'             => __('All Items', 'glassmorphism_design'),
            'add_new_item'          => __('Add New Item', 'glassmorphism_design'),
            'add_new'               => __('Add New', 'glassmorphism_design'),
            'new_item'              => __('New Item', 'glassmorphism_design'),
            'edit_item'             => __('Edit Item', 'glassmorphism_design'),
            'update_item'           => __('Update Item', 'glassmorphism_design'),
            'view_item'             => __('View Item', 'glassmorphism_design'),
            'view_items'            => __('View Items', 'glassmorphism_design'),
            'search_items'          => __('Search Item', 'glassmorphism_design'),
            'not_found'             => __('Not found', 'glassmorphism_design'),
            'not_found_in_trash'    => __('Not found in Trash', 'glassmorphism_design'),
            'featured_image'        => __('Featured Image', 'glassmorphism_design'),
            'set_featured_image'    => __('Set featured image', 'glassmorphism_design'),
            'remove_featured_image' => __('Remove featured image', 'glassmorphism_design'),
            'use_featured_image'    => __('Use as featured image', 'glassmorphism_design'),
            'insert_into_item'      => __('Insert into item', 'glassmorphism_design'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'glassmorphism_design'),
            'items_list'            => __('Items list', 'glassmorphism_design'),
            'items_list_navigation' => __('Items list navigation', 'glassmorphism_design'),
            'filter_items_list'     => __('Filter items list', 'glassmorphism_design'),
        );
        $args = array(
            'label'                 => __('Glassmorphism', 'glassmorphism_design'),
            'description'           => __('Post Type Description', 'glassmorphism_design'),
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
            'menu_icon'             => 'dashicons-buddicons-buddypress-logo',
        );
        register_post_type('glassmorphism_design', $args);
    }
}

new Glassmorphism;

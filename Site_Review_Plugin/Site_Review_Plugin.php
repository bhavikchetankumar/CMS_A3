<?php

/*
Plugin Name: Site_Review_Plugin
Plugin URI: https://spicesathome.000webhostapp.com

Description: A Site Review Plugin created as a part of CMS Assignment 3
Version: 1.0
Author: Bhavik Shah <www.facebook.com/BhavikShah746>
Author URI: https://www.linkedin.com/in/bhavik-shah-555a5998/

License: No License
*/

defined('ABSPATH') or die("Sorry, Plugin not available");

// Register the Custom Site Review Post Type. 
function init_function() {
 
    $labels = array(
        'name' => _x( 'Review', 'site_review' ),
        'singular_name' => _x( 'Review', 'Site_review' ),
        'add_new' => _x( 'Add New', 'site_review' ),
        'add_new_item' => _x( 'Add New Review', 'site_review' ),
        'edit_item' => _x( 'Edit Review', 'site_review' ),
        'new_item' => _x( 'New Review', 'site_review' ),
        'view_item' => _x( 'View Review', 'site_review' ),
        'search_items' => _x( 'Search Reviews', 'site_review' ),
        'not_found' => _x( 'No reviews found', 'site_review' ),
        'not_found_in_trash' => _x( 'No reviews found in Trash', 'site_review' ),
        'parent_item_colon' => _x( 'Parent Review:', 'site_review' ),
        'menu_name' => _x( 'Reviews', 'site_review' ),
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'Review from customers',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
        'menu_position' => 5,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-format-aside',
        'show_in_nav_menus' => true,
        'taxonomies' => array( 'reviews-' ),
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'has_archive' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
 
    register_post_type( 'site_reviews', $args );
}
add_action( 'init', 'init_function' ); 

//Function to register taxanomies
function reviews_taxonomy() {
    register_taxonomy(
        'reviews',
        'site_review',
        array(
            'hierarchical' => true,
            'label' => 'Reviews',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'reviews',
                'with_front' => false
            )
        )
    );
}

add_action( 'init', 'reviews_taxonomy');


// Function used to automatically create Site Reviews page.
function create_site_review_page()
  {
   //post status and options
    $post = array(
          'comment_status' => 'open',
          'ping_status' =>  'closed' ,
          'post_date' => date('Y-m-d H:i:s'),
          'post_name' => 'site_review',
          'post_status' => 'publish' ,
          'post_title' => 'Site Reviews',
          'post_type' => 'page',
    );

    //insert page and save the id
    $newvalue = wp_insert_post( $post, false );
    
    //save the id in the database
    update_option( 'mrpage', $newvalue );
  }


  // // Activates function if plugin is already activated
register_activation_hook( __FILE__, 'create_site_review_pages');
?>
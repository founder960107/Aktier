<?php
/*
Plugin Name: Custom Post Types
Description: Adds custom post types for articles, news, stock analysis, etc.
Text Domain: article_posttype
Version: 2.0
Author: Founder
*/

// Register Custom Post Type
function custom_post_type() {
    $labels = array(
        'name' => 'Articles',
        'singular_name' => 'Article',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Article',
        'edit_item' => 'Edit Article',
        'new_item' => 'New Article',
        'view_item' => 'View Article',
        'search_items' => 'Search Articles',
        'not_found' => 'No Articles found',
        'not_found_in_trash' => 'No Articles found in Trash',
        'parent_item_colon' => 'Parent Article:',
        'menu_name' => 'Articles',
    );
    $args = array(
        'labels'  => $labels,
        'public' => true,
        'supports' => array('title', 'editor','thumbnail'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'articles'),
    );
    register_post_type( 'article', $args );
}
add_action( 'init', 'custom_post_type' );

function custom_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Categories', 'taxonomy general name', 'article_posttype' ),
        'singular_name'              => _x( 'Category', 'taxonomy singular name', 'article_posttype' ),
        'search_items'               => __( 'Search Categories', 'article_posttype' ),
        'popular_items'              => __( 'Popular Categories', 'article_posttype' ),
        'all_items'                  => __( 'All Categories', 'article_posttype' ),
        'edit_item'                  => __( 'Edit Category', 'article_posttype' ),
        'update_item'                => __( 'Update Category', 'article_posttype' ),
        'add_new_item'               => __( 'Add New Category', 'article_posttype' ),
        'new_item_name'              => __( 'New Category Name', 'article_posttype' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'article_posttype' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'article_posttype' ),
        'choose_from_most_used'      => __( 'Choose from the most used categories', 'article_posttype' ),
        'not_found'                  => __( 'No categories found.', 'article_posttype' ),
        'menu_name'                  => __( 'Categories', 'article_posttype' ),
    );
    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'show_in_rest'          => true, 
        'rewrite'               => array( 'slug' => 'article-category' ),
    );
    register_taxonomy( 'article_category', 'article', $args );
}
add_action( 'init', 'custom_taxonomy' );








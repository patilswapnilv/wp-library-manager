<?php
/*
* Plugin Name: WP Library Manager
* Description: A library manager for WordPress
* Version: 1.1.0
* Author: patilswapnilv
* Author URI: https://www.swapnil.blog/
* License: GPL2
*/

/**
* @category WPLibraryManager
* @package  wp_library_manager
* @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
* @link     https://github.com/patilswapnilv/WP-Library-Manager
*/

//* Create Custom Post Type
function md_register_books_post_type() {
$labels = array(
    'name' => 'Books',
    'singular_name' => 'Book',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Book',
    'edit_item' => 'Edit Book',
    'new_item' => 'New Book',
    'view_item' => 'View Book',
    'search_items' => 'Search Books',
    'not_found' =>  'No Books found',
    'not_found_in_trash' => 'No Books found in trash',
    'parent_item_colon' => '',
    'menu_name' => 'Library'
);
$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => '5',
    'supports'           => array( 'title', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
    'taxonomies'         => array( 'book_category', 'author','publisher' ),
);

register_post_type( 'Books', $args );
}
add_action( 'init', 'md_register_books_post_type' );

//* Custom Post Type Meta Boxes
/**
 * Get the bootstrap!
 */
if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
  require_once  __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
  require_once  __DIR__ . '/CMB2/init.php';
}

add_action( 'cmb2_admin_init', 'cmb2_custom_post_type_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cmb2_custom_post_type_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_md_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'custom_post_type_info',
        'title'         => __( 'Custom Post Type Info', 'cmb2' ),
        'object_types'  => array( 'custom-post-type', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Text Box', 'cmb2' ),
        'desc'       => __( 'Sample text box.', 'cmb2' ),
        'id'         => $prefix . 'test_text_box',
        'type'       => 'text_small',
    ) );

    $cmb->add_field( array(
        'name'    => 'Test WYSIWYG',
        'id'      => $prefix . 'test_wysiwyg',
        'type'    => 'wysiwyg',
        'options' => array(),
    ) );

    $cmb->add_field( array(
        'name'    => 'Test File Upload',
        'desc'    => 'Upload a file.',
        'id'      => $prefix . 'test_file_upload',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
    ) );

//* For more field types and information about the CMB2 metaboxes please visit https://github.com/WebDevStudios/cmb2/wiki

}

//* Custom Post Type Styles

add_action( 'wp_enqueue_scripts', 'md_custom_post_type_styles' );
function md_custom_post_type_styles() {
    wp_enqueue_style('main-style', plugins_url('css/style.css', __FILE__ ) );
}

//* Custom Post Type Scripts

add_action( 'wp_enqueue_scripts', 'md_custom_post_type_scripts' );
function md_custom_post_type_scripts() {
    wp_enqueue_script( 'global-js', plugins_url('js/global.js', __FILE__ ), array( 'jquery' ), '1.0.0' );
}

<?php
/**
* Plugin Name: Livestream Plugin
* Plugin URI: https://ondigitals.com
* Description: Plugin for livestream KLD.
* Version: 0.1
* Author:Danh - Ondigitals
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register livestream Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_livestream_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/livestream.php' );

	$widgets_manager->register( new \Elementor_livestream_Widget() );

}
add_action( 'elementor/widgets/register', 'register_livestream_widget' );


// Tạo custome Post Livestream
function custome_post_livestream() {
  $labels = array(
      'name'               => 'Livestream',
      'singular_name'      => 'Livestream',
      'menu_name'          => 'Livestream',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New Livestream',
      'edit'               => 'Edit',
      'edit_item'          => 'Edit Livestream',
      'new_item'           => 'New Livestream',
      'view'               => 'View',
      'view_item'          => 'View Livestream',
      'search_items'       => 'Search Livestream',
      'not_found'          => 'No Livestream found',
      'not_found_in_trash' => 'No Livestream found in Trash',
      'parent'             => 'Parent Livestream'
  );

  $args = array(
      'labels'              => $labels,
      'public'              => true,
      'has_archive'         => true,
      'publicly_queryable'  => true,
      'query_var'           => true,
      'rewrite'             => array( 'slug' => 'livestream' ),
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'menu_icon'           => 'dashicons-video-alt2', // Icon class name for TV icon
      'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
      'taxonomies'          => array( 'category', 'post_tag' )
  );

  register_post_type( 'livestream', $args );
}
add_action( 'init', 'custome_post_livestream' );

// Register js and CSS
function my_plugin_enqueue_scripts() {
  // Enqueue CSS file
  wp_enqueue_style( 'my-plugin-style', plugin_dir_url( __FILE__ ) . 'css/livestreamStyle.css' );

  // Enqueue JavaScript file
  wp_enqueue_script( 'my-plugin-script', plugin_dir_url( __FILE__ ) . 'js/livestreamKLD.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_plugin_enqueue_scripts' );
?>
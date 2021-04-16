<?php

/**
 * Support
 */
add_theme_support('menus');
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');


/**
 * WP NavMenu Locations
 */
function wp_custom_nav_menu()
{
  register_nav_menus([
    'primary' => __('Primary', 'murillo'),
    'secondary' => __('Secondary', 'murillo'),
    'footer' => __('Footer', 'murillo')
  ]);
}
add_action('init', 'wp_custom_nav_menu');


/**
 * JPG quality filter
 */
add_filter('jpeg_quality', function ($arg) {
  return 100;
});


/**
 * Custom WP Admin Menu
 */
function admin_menu_cleanup()
{
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'admin_menu_cleanup');


/**
 * Custom WP Footer
 */
function remove_footer()
{
  add_filter('admin_footer_text', function () {
    return 'Made with &hearts; by <a href="https://aitormurillo.com/" rel="nofollow noreferrer noopener" target="blank">Aitor Murillo</a>';
  }, 11);
  add_filter('update_footer', '__return_false', 11);
}
add_action('admin_init', 'remove_footer');


/**
 * Disable Categories & Tags from Post
 */
function disable_tags()
{
  unregister_taxonomy_for_object_type('post_tag', 'post');
  unregister_taxonomy_for_object_type('category', 'post');
}
add_action('init', 'disable_tags');


/**
 * Custom post type
 */
function create_custom_post_type()
{
  register_post_type(
    'project',
    array(
      'labels' => array(
        'name'          => __("Projects", 'murillo'),
        'singular_name' => __("Project", 'murillo')
      ),
      'hierarchical'    => 0,
      'supports'        => array('title', 'editor', 'thumbnail'),
      'public'          => true,
      'has_archive'     => true,
      'show_in_rest'    => true,
      'rewrite'         => array('slug' => 'project'),
    )
  );
}
add_action('init', 'create_custom_post_type');

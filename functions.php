<?php


function resources() {
  $VERSION = "9";
  wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Bree+Serif|Ruda:400,700');
  wp_enqueue_style('normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css');

  wp_enqueue_script('jquery');
  wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery']);
	wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');

  wp_enqueue_script('scripts', get_template_directory_uri() . '/scripts.js', ['jquery'], $VERSION, true);
  wp_enqueue_style('style', get_stylesheet_uri(), [], $VERSION);
}

add_action('wp_enqueue_scripts', 'resources');

function remove_menu () {
  remove_menu_page('edit-comments.php');
}


// Theme setup
function setup() {

  register_nav_menus(array(
    'primary' => __( 'Primary Menu'),
    'footer' => __( 'Footer Menu'),
  ));

  register_post_type('team', [
    'labels' => [
      'name' => __('Team'),
      'edit_item' => __( 'Team'),
      'add_new_item' => __( 'Team'),
      'menu_name' => __('Teams'),
    ],
    'supports' => ['title', 'author'],
    'public' => true,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-groups',
    'show_ui' => true,
    'capability_type' => 'post',
    'rewrite' => array(
      'slug' => 'team'
    ),
    ]);

  register_post_type('person', [
    'labels' => [
      'name' => __('Person'),
      'edit_item' => __( 'Person'),
      'add_new_item' => __( 'Person'),
      'menu_name' => __('People'),
    ],
    'supports' => ['title', 'author'],
    'public' => true,
    'menu_icon' => 'dashicons-id',
    'show_in_menu' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'rewrite' => array(
      'slug' => 'person'
    ),
  ]);

  register_post_type('project', [
    'labels' => [
      'name' => __('Project'),
      'edit_item' => __( 'Project'),
      'add_new_item' => __( 'Project'),
      'menu_name' => __('Projects'),
    ],
    'supports' => ['title', 'author'],
    'public' => true,
    'menu_icon' => 'dashicons-carrot',
    'show_in_menu' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'rewrite' => array(
      'slug' => 'project'
    ),
  ]);

  // Add featured image support
  add_image_size('tiny', 50, 50);
  add_image_size('polaroid', 400, 634, true);
  add_image_size('logo', 500, 500);
  add_image_size('fixedheight', 3000, 300);
  add_image_size('panorama', 16 * 40, 9 * 40, true);
  add_image_size('big', 1200, 1200);
}

add_action('after_setup_theme', 'setup');
add_action('admin_menu', 'remove_menu');

?>

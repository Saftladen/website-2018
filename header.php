
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0" />
  <title><?php bloginfo('name'); ?></title>
  <meta name="description" content="<?php bloginfo( 'description' ) ?>" />
  <?php wp_head(); ?>
</head>

<?php
$post = get_post(get_option('page_on_front'));
setup_postdata($post);
?>

<body <?php body_class(); ?>>
  <header class="main-header">
    <a href="<?php echo home_url(); ?>" class="main-header-brand-link">
      <img
        class="main-header-image"
        src="<?php echo get_field('top_image', $post)['sizes']['tiny']; ?>"
        alt="<?php echo get_field('top_image', $post)['alt'] ?>"
      />
    </a>
    <a href="<?php echo home_url(); ?>" class="main-header-title">
      <span>S</span><span>a</span><span>f</span><span>t</span><span>l</span><span>a</span><span>d</span><span>e</span><span>n</span>
    </a>
    <div class="main-header-social">
      <?php get_template_part('partials/social-links'); ?>
    </div>
  </header><!-- /site-header -->
  <div class="content-container">

  <?php wp_reset_postdata(); ?>

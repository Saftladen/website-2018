<div class="polaroid is-team">
  <a href="<?php echo get_permalink(get_the_ID()) ?>" class="polaroid-img-container">
    <?php $logo_id = get_field('logo', false, false); ?>
    <?php if ( $logo_id ) : ?>
      <img class="polaroid-img" loading="lazy" decoding="async"
        src="<?php echo saft_image_src($logo_id, 'fixedheight')[0]; ?>"
        alt="<?php the_title() ?>"
      >
    <?php else: ?>
      <img class="polaroid-img" loading="lazy" decoding="async"
        src="<?php echo get_template_directory_uri(); ?>/images/person_unisex.jpg"
        alt="<?php the_title() ?>"
      >
    <?php endif; ?>
  </a>

  <div class="polaroid-body">
    <a href="<?php echo get_permalink(get_the_ID()) ?>" class="polaroid-link">
      <h3><?php the_title() ?></h3>
    </a>
    <?php get_template_part('partials/social-links'); ?>
  </div>
</div>

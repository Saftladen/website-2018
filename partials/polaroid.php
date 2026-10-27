<div class="polaroid">
  <a href="<?php echo get_permalink(get_the_ID()) ?>" class="polaroid-img-container">
    <?php if ( get_field('image') ) : ?>
      <img class="polaroid-img" loading="lazy" decoding="async"
        src="<?php echo get_field('image')['sizes']['polaroid']; ?>"
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
    <div class="polaroid-position"><?php echo get_field('position'); ?></div>
    <?php if (get_field('team')): ?>
      <div class="polaroid-team">
        at <a href="<?php echo get_permalink(get_field('team')->ID); ?>"><?php echo get_field('team')->post_title; ?></a>
      </div>
    <?php endif ?>
    <?php get_template_part('partials/social-links'); ?>
  </div>
</div>

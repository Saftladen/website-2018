<div class="project">
  <div class="project-inner">
    <div class="project-media">
      <?php while( have_rows('media') ) : the_row(); ?>
        <div class="project-media-item">
          <?php if (get_sub_field('type') == 'image') : ?>
            <img
              class="project-media-image"
              src="<?php echo get_sub_field('image')['sizes']['panorama']; ?>"
              alt="<?php echo get_sub_field('image')['alt'] ?>"
            />
          <?php else: ?>
            <div class="l-aspect-ratio-16-9">
              <?php
              $iframe = get_sub_field('video');
              preg_match('/src="(.+?)"/', $iframe, $matches);
              $src = $matches[1];
              $new_src = add_query_arg(['color' => 'white', 'rel' => 0, 'showinfo' => 0], $src);
              // data-src: scripts.js sets the real src once the iframe scrolls or slides into view
              echo str_replace('src="' . $src . '"', 'data-src="' . esc_attr($new_src) . '"', $iframe);
              ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>


    <img class="project-img"
      src="<?php echo get_field('image')['sizes']['panorama']; ?>"
      alt="<?php echo get_field('image')['alt'] ?>"
    >
    <div class="project-body">
      <h3><?php the_title() ?></h3>
      <?php if (get_post_type() === 'team'): ?>
        <div class="project-position">Studio</div>
      <?php else: ?>
        <div class="project-position"><?php echo get_field('position'); ?></div>
      <?php endif ?>
      <?php get_template_part('partials/social-links'); ?>
      <div class="project-description"><?php echo get_field('description'); ?></div>
      <div class="project-bottom-col">
        <?php if (get_field('creator') && !get_query_var('is_entity_page')) : ?>
          <div class="project-creator">
            by
            <?php $i=0; foreach (get_field('creator') as $creator): $i += 1;?>
            <?php if ($i > 1) : ?>&<?php endif; ?>
            <a href="<?php echo get_permalink($creator->ID); ?>">
              <?php echo $creator->post_title; ?>
            </a>
            <?php endforeach ?>
          </div>
        <?php endif; ?>

        <div class="project-published">
        <?php if (get_field('still_in_production') == true): ?>
          in production
        <?php else: ?>
          published
          <b><?php echo get_field('publish_year') ?></b>
        <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</div>

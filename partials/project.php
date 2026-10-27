<div class="project">
  <div class="project-inner">
    <div class="project-media">
      <?php while( have_rows('media') ) : the_row(); ?>
        <div class="project-media-item">
          <?php if (get_sub_field('type') == 'image') : ?>
            <?php
              $image_id = get_sub_field('image', false);
              $image = saft_image_src($image_id, 'panorama');
            ?>
            <img
              class="project-media-image"
              src="<?php echo $image[0]; ?>"
              width="<?php echo $image[1]; ?>"
              height="<?php echo $image[2]; ?>"
              alt="<?php echo saft_image_alt($image_id) ?>"
              loading="lazy"
              decoding="async"
            />
          <?php else: ?>
            <div class="l-aspect-ratio-16-9">
              <?php
              $iframe = saft_oembed(get_sub_field('video', false));
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


    <?php $image_id = get_field('image', false, false); ?>
    <img class="project-img"
      src="<?php echo saft_image_src($image_id, 'panorama')[0]; ?>"
      alt="<?php echo saft_image_alt($image_id) ?>"
      loading="lazy"
      decoding="async"
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
        <?php
          // get_post('') would return the current global post, so empty ids are dropped first.
          $creator_ids = array_filter((array) get_field('creator', false, false));
          $creators = array_values(array_filter(array_map('get_post', $creator_ids)));
        ?>
        <?php if ($creators && !get_query_var('is_entity_page')) : ?>
          <div class="project-creator">
            by
            <?php foreach ($creators as $i => $creator): ?>
            <?php if ($i > 0) : ?>&<?php endif; ?>
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

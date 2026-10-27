<?php get_header();?>

<?php while (have_posts()) : the_post();?>

<?php $top_image_id = get_field('top_image', false, false); ?>
<div class="home_top-container">
  <img
    class="home_top-image"
    src="<?php echo saft_image_src($top_image_id, 'big')[0]; ?>"
    alt="<?php echo saft_image_alt($top_image_id) ?>"
    fetchpriority="high"
  />
</div>
<div class="home_intro wp-content">
  <?php echo get_field('intro_text'); ?>
</div>
<div class="home_news">
  <a class="home_news-link l-link" href="/news/">See all news</a>
</div>

<div class="home_members" id="teams">
  <h2>Studios</h2>
  <div class="polaroid-list">
    <?php
      $team_ids = saft_repeater_values(get_the_ID(), 'teams', 'team');
      saft_prime_posts($team_ids);
      saft_prime_posts(array_map(function ($id) { return get_post_meta($id, 'logo', true); }, $team_ids));
      shuffle($team_ids);
    ?>
    <?php foreach ($team_ids as $team_id): ?>
    <?php $post = get_post($team_id); if (!$post || $post->post_status === 'trash') continue; setup_postdata($post); ?>
      <?php get_template_part('partials/team'); ?>
    <?php endforeach ?>
    <?php wp_reset_postdata(); ?>
  </div>
</div>

<div class="home_projects" id="projects">
  <h2>What we make</h2>
  <div class="project-list">
    <?php
      $projects = get_posts([
        'numberposts' => -1,
        'post_type'   => 'project',
        'suppress_filters' => 0,
        'orderby' => 'rand'
      ]);
      $related_ids = [];
      foreach ($projects as $project) {
        $related_ids[] = get_post_meta($project->ID, 'image', true);
        $related_ids = array_merge(
          $related_ids,
          saft_repeater_values($project->ID, 'media', 'image'),
          (array) get_post_meta($project->ID, 'creator', true)
        );
      }
      saft_prime_posts($related_ids);
      ?>
    <?php foreach ($projects as $post): setup_postdata($post);?>
      <?php get_template_part('partials/project'); ?>
    <?php endforeach ?>
    <?php wp_reset_postdata(); ?>
  </div>
  <div class="home_project-more">
    <button type="button" class="l-btn js-project-more" data-other="See less">Show all projects</button>
  </div>
</div>

<div class="home_newsletter">
  <h2>Sign up to our newsletter</h2>
  <a href="http://eepurl.com/b9D0dv" target="_blank" class="l-btn">Subscribe</a>
</div>

<div class="home_faq">
  <h2>FAQ</h2>
  <?php while( have_rows('faq') ) : the_row(); ?>
    <div class="home_faq-entry">
      <h3><?php the_sub_field('question'); ?></h3>
      <div class="home_faq-answer wp-content">
        <?php echo get_sub_field('answer'); ?>
      </div>
    </div>
  <?php endwhile; ?>
</div>

<h2 class="home_map-title">Where are we?</h2>
<div class="home_map" id="map">
  <?php get_template_part('partials/map'); ?>
</div>
<div class="home_map-description wp-content"><?php echo get_field('location_description'); ?></div>


<!-- <div class="home_twitter">
  <h2>Latest Impressions</h2>
  <p class="home_twitter-intro">Sourced from our <a href="https://twitter.com/saftladenberlin" target="_blank" class="l-link">twitter feed</a></p>
  <script src="https://snapwidget.com/js/snapwidget.js"></script>
  <iframe src="https://snapwidget.com/embed/311243" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>
</div> -->
<?php endwhile; ?>
<?php get_footer(); ?>

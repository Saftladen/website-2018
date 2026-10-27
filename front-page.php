<?php get_header();?>

<?php while (have_posts()) : the_post();?>

<div class="home_top-container">
  <img
    class="home_top-image"
    src="<?php echo get_field('top_image')['sizes']['big']; ?>"
    alt="<?php echo get_field('top_image')['alt'] ?>"
    fetchpriority="high"
  />
</div>
<div class="home_intro wp-content">
  <?php echo get_field('intro_text'); ?>
</div>
<div class="home_news">
  <?php
     $recent = new WP_Query([
      'posts_per_page'=>1,
      'order'=>'DESC',
      'orderby'=>'date'
     ]);
  ?>
  <!-- <?php while ($recent->have_posts()) : $recent->the_post(); ?>
    <div class="home_news-entry with-title">
      <div class="home_news-title-area">
        <h2>Freshly squeezed</h2>
      </div>
      <div class="home_news-inner">
        <div class="home_news-date"><?php the_date() ?></div>
        <h3><?php the_title(); ?></h3>
        <div class="home_news-content wp-content"><?php the_excerpt(); ?></div>
        <a class="home_news-readmore l-link" href="<?php the_permalink(); ?>">Read more</a>
      </div>
    </div>
  <?php endwhile ?> -->
  <?php wp_reset_postdata(); ?>
  <a class="home_news-link l-link" href="/news/">See all news</a>
</div>
<!-- <div class="home_members" id="people">
  <h2>Members</h2>
  <div class="polaroid-list">
    <?php
      $members = get_field('entities');
      shuffle($members)
    ?>
    <?php foreach ($members as $member): ?>
    <?php $post = $member['entity']; setup_postdata($post); ?>
      <?php get_template_part('partials/polaroid'); ?>
    <?php endforeach ?>
    <?php wp_reset_postdata(); ?>
  </div>
</div> -->

<div class="home_members" id="teams">
  <h2>Studios</h2>
  <div class="polaroid-list">
    <?php
      $teams = get_field('teams');
      shuffle($teams)
    ?>
    <?php foreach ($teams as $team): ?>
    <?php $post = $team['team']; setup_postdata($post); ?>
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

<?php
$post = get_post(get_option('page_on_front'));
setup_postdata($post);
?>

</div>
  <footer class="main-footer">
    <div class="main-footer-inner">
      <nav class="main-footer_nav">
        <?php wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'menu_class' => 'main-footer_nav-menu', 'depth' => 1]); ?>
      </nav>
      <div class="main-footer-social">
      <?php get_template_part('partials/social-links'); ?>
      </div>
    </div>
  </footer>
  <?php wp_reset_postdata(); ?>
  <?php wp_footer(); ?>
</body>
</html>

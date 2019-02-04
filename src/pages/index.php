<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

<div class="wrap">
  <main class="main-section">
    <div class="main-section__articles">
      <?php get_template_part('includes/main/best/best'); ?>
      <?php get_template_part('includes/main/last/last'); ?>
    </div>
    <aside class="main-section__popular">
      <?php get_template_part('includes/main/popular/popular'); ?>
    </aside>
  </main>
</div>

<?php get_footer(); ?>

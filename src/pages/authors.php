<?php
/*
Template Name: Authors
*/
?>
<?php get_header();?>
<div class="wrap">
  <main class="main-section main-section--block">
    <h1 class="main-section__title"><?php pll_e('Our authors') ?></h1>
    <?php get_template_part('includes/filter-authors/filter-authors'); ?>
    <?php get_template_part('includes/authors/authors'); ?>
  </main>
</div>
<?php get_footer(); ?>

<?php
/*
Template Name: Digests
*/
?>
<?php get_header();?>
<?php
if(have_posts()) : while(have_posts()) : the_post();?>
<div class="wrap">
  <main class="main-section main-section--block">
    <h1 class="main-section__title"><?php the_title(); ?></h1>
    <div class="main-section__descr">
        <?php echo get_the_content(); ?>
    </div>
    <?php endwhile;?>
    <?php get_template_part('includes/filter-digests/filter-digests'); ?>
    <?php get_template_part('includes/digests/digests'); ?>
  </main>
</div>
<?php endif; ?>
<?php get_footer(); ?>

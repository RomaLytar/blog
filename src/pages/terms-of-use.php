<?php
/*
Template Name: Terms-of-use
*/
?>
<?php get_header();?>
<div class="wrap">
    <?php
    if(have_posts()) : while(have_posts()) : the_post();?>
      <main class="main-section main-section--block">
        <h1 class="main-section__title"><?php the_title(); ?></h1>
        <?php get_template_part('includes/contract/contract'); ?>
      </main>
    <?php endwhile;?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>

<?php
/*
Template Name: Projekt
*/
?>
<?php get_header();?>
<div class="wrap">
    <?php if(have_posts()) :
      while(have_posts()) : the_post();?>
        <main class="main-section main-section--block">
          <h1 class="main-section__title"><?php the_title(); ?></h1>
          <?php get_template_part('includes/projekt/projekt'); ?>
      <?php endwhile;?>
    <?php endif; ?>

    <div class="main-section__projekt">
      <p class="main-section__title-small main-section__title-small--gold">если у вас есть пожелания по развитию театрального блога</p>
      <p class="main-section__title-small main-section__title-small--lowercase">напишите нам</p>
    </div>
    <h2 class="main-section__title">Отправить пожелание</h2>
    <div class="main-section__form main-section__form--marg-bot">
      <?php get_template_part('includes/form/form-write-us'); ?>
    </div>
  </main>
</div>
<?php get_footer(); ?>

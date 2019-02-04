<?php
/*
Template Name: Registration
*/
?>
<?php get_header();?>
<div class="wrap">
  <main class="main-section main-section--block">
    <h1 class="main-section__title main-section__title--small-marg">Регистрация</h1>
    <div class="main-section__descr">
      <p class="main-section__descr-form">Если вы у же зарегестрированны, воспользуйтесь</p>
      <p class="main-section__link"><a href="#" data-popup-link="authorization">формой входа</a></p>
    </div>
    <div class="main-section__form">
      <?php get_template_part('includes/form/form-reg'); ?>
    </div>
  </main>
</div>
<?php get_footer(); ?>

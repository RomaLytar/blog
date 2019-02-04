<?php
/*
Template Name: Password-recovery
*/
?>
<?php get_header();?>
<div class="wrap">
  <main class="main-section main-section--block">
    <h1 class="main-section__title main-section__title--small-marg">Восстановление пароля</h1>
    <div class="main-section__descr main-section__descr--user">
      <p>Рома Ромочка Роман</p>
      <p>Рома@Ромочка.Роман</p>
    </div>
    <div class="main-section__form main-section__form--marg-bot">
      <?php get_template_part('includes/form/form-password-recovery'); ?>
    </div>
  </main>
</div>
<?php get_footer(); ?>

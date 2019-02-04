<?php
/*
Template Name: Password-forgot
*/
?>
<?php get_header();?>
<div class="wrap">
  <main class="main-section main-section--block">
    <h1 class="main-section__title main-section__title--small-marg">Забыли пароль?</h1>
    <div class="main-section__descr main-section__descr--form">
      <p>Введите адрес электронной почты, указанный при регистрации и нажмите "Отправить".</p>
      <p>На указанный адрес будет отправлено письмо с защищенной ссылкой. Перейдите по этой ссылке для восстановления пароля.</p>
    </div>
    <div class="main-section__form main-section__form--marg-bot">
      <?php get_template_part('includes/form/form-password-forgot'); ?>
    </div>
  </main>
</div>
<?php get_footer(); ?>

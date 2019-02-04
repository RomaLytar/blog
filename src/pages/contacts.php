<?php
/*
Template Name: Contacts
*/
?>
<?php get_header(); ?>

<?php get_template_part('includes/promo/promo-contacts'); ?>
<?php get_template_part('includes/contacts/contacts'); ?>
<?php get_template_part('includes/map/map'); ?>

<div class="footer">
  <?php get_template_part('includes/popup/popup-contact'); ?>
  <?php get_template_part('includes/footer/footer-content'); ?>
</div>

<?php get_footer(); ?>

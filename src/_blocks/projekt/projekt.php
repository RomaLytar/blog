<?php $block_one = get_post_meta($post->ID, 'wpcf-block-one', true); ?>
<?php $block_contact = get_post_meta($post->ID, 'wpcf-to-contact-us', true); ?>
<section class="projekt">
  <div class="projekt__text">
    <?php echo get_the_content(); ?>
  </div>
</section>


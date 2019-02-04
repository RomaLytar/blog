<!-- пока е используется -->

<section class="popup" data-popup="contact">
  <div class="popup__inner">
    <div class="popup__wrap">
      <button type="button" class="popup__close" data-popup-close>
        Close
        <svg width="24" height="24" fill="#000000">
          <use xlink:href="<?php bloginfo('template_url'); ?>/img/svg/symbols.svg#icon-cross" />
        </svg>
      </button>
      <h2 class="popup__title"><?php pll_e('Asc_question'); ?></h2>
      <p class="popup__descr"><?php pll_e('Replay_you'); ?></p>
      <?php get_template_part('includes/form/form-book'); ?>
    </div>
  </div>
</section>

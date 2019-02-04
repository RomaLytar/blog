<section class="popup" data-popup="popup-search">
  <div class="popup__inner">
    <div class="popup__wrap popup__wrap--search">
      <button type="button" class="popup__close" data-popup-close>
        Close
        <svg width="18" height="18" fill="#000000">
          <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-cross" />
        </svg>
      </button>
      <h2 class="popup__title popup__title--big-marg">Поиск</h2>
      <?php get_template_part('includes/form/form-search'); ?>
    </div>
  </div>
</section>

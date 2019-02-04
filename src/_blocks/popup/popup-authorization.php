<section class="popup" data-popup="authorization">
  <div class="popup__inner">
    <div class="popup__wrap">
      <button type="button" class="popup__close" data-popup-close>
        Close
        <svg width="18" height="18" fill="#000000">
          <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-cross" />
        </svg>
      </button>
      <h2 class="popup__title">Вход в систему</h2>
      <p class="popup__subtitle">Введите ваши данные и нажмите "Войти"</p>
      <?php get_template_part('includes/form/form-authorization'); ?>
      <p class="popup__link">
        <span>Не зарегистрированы?</span>
        <a href="/registration">Зарегистрируйтесь</a>
      </p>
    </div>
  </div>
</section>

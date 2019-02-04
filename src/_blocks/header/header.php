<header class="header">
  <div class="header__promo" style="background-image:url(/wp-content/themes/theatreblog/img/header/header-bg.jpg);">
    <div class="wrap">
      <h1 class="header__promo-title">Смыслы</h1>
      <p class="header__promo-subtitle">Культурный блог Схід Опера</p>
    </div>
  </div>
    <?php rating_user_update(); ?>
  <div class="header__logo">
    <div class="wrap">
      <ul class="header__user">
        <li class="header__user-item">
          <a href="#" class="header__user-link">Войти
            <span class="header__icon">
              <svg width="10" height="12" fill="#6e6e6e">
                <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-user"></use>
              </svg>
            </span>
          </a>
        </li>
        <li class="header__user-item">
          <a href="#" class="header__user-link" data-popup-link="popup-search">Поиск
            <span class="header__icon">
              <svg width="10" height="12" fill="#6e6e6e">
                <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-search"></use>
              </svg>
            </span>
          </a>
        </li>

        <li class="header__user-item header__user-item--lang" data-lang>

          <div class="visually-hidden" data-wp-lang>
            <?php pll_the_languages(array('dropdown'=>1));  ?>
          </div>
          <a href="#" class="header__user-link" data-toggle-link>
            <span data-lang-current>Рус</span>
            <span class="header__icon header__icon--lang">
              <svg width="10" height="12" fill="#6e6e6e">
                <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-arrow-right"></use>
              </svg>
            </span>
          </a>
          <ul class="header__lang-list" data-toggle-list>
          </ul>
        </li>
      </ul>
      <figure class="header__logo-img">
        <a <?= ($_SERVER['REQUEST_URI'] == '/')
            || ($_SERVER['REQUEST_URI'] == '/en/home/')
            || ($_SERVER['REQUEST_URI'] == '/ru/glavhaja/')
            ? ''
            : 'href = ' . home_url() . '' ?>
        >
          <img src="/wp-content/themes/theatreblog/img/logo.svg" alt="Логотип">
        </a>
      </figure>
    </div>
  </div>
  <div class="menu">
    <div class="wrap">
        <?php  wp_nav_menu(array(
            'theme_location'  => 'top_menu',
            'menu'            => '',
            'container_id'    => '',
            'menu_id'         => '',
            'container'       => 'ul',
            'container_class'       => '',
            'menu_class'      => 'menu__list',
            'walker' => new Custom_Walker_Nav_Menu()
        ));
        ?>
    </div>
  </div>
</header>

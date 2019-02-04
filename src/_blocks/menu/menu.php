<nav class="menu" data-menu>
  <button type="button" class="menu__toggle" data-menu-btn>
    Menu
    <span class="menu__toggle-line menu__toggle-line--1"></span>
    <span class="menu__toggle-line menu__toggle-line--2"></span>
    <span class="menu__toggle-line menu__toggle-line--3"></span>
  </button>
    <div class="menu__list-wrap">
  <?php wp_nav_menu(array(
    'theme_location'  => 'top_menu',
    'menu'            => 'div',
    'container'       => false,
    'menu_class'      => 'menu__list',
    'menu_id'         => '',
    'walker' => new Custom_Walker_Nav_Menu()
  ));
  ?>
    </div>
    <?php  ?>

</nav>

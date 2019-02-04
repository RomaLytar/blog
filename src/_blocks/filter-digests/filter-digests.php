<section class="filter" data-filter>
    <?php
    $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
    ?>
  <ul class="filter__list">
    <li class="filter__item" data-filter-item="type">
      <button class="filter__name" type="button" data-filter-name>
        <span>Все</span>
        <svg width="15" height="15" fill="#333">
          <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-arrow-right"/>
        </svg>
      </button>
        <ul class="filter__item-list" data-filter-list>
            <?php
            $tax = 'period';
            $args = array(
                'taxonomy' => $tax,
                'hide_empty' => false,
            );
            $terms = get_terms( $args );
            foreach ($terms as $term): ?>
                <li><a href="<?php $uri_parts?>?cat=<?php echo $term->slug ?>"
                       <?php if($_GET['cat'] == $term->name): ?>data-active<?php endif; ?>>
                        <?php echo $term->name;?>
                    </a>
                </li>
            <?php endforeach;?>
<!-- Активной ссылке добавлять атрибут data-active. У всех остальных удалять -->
        </ul>
    </li>
  </ul>
</section>

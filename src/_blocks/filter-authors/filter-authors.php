<section class="filter-authors" data-filter>
    <?php
    $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
    ?>
  <ul class="filter-authors__list">
    <li class="filter-authors__item">
      <a href="<?php $uri_parts?>?order=rating_user" class="filter-authors__item-link"><?php pll_e('By popularity')?></a>
    </li>
    <li class="filter-authors__item">
        <a href="<?php $uri_parts?>?order=display_name" class="filter-authors__item-link"><?php pll_e('Alphabetically') ?></a>
    </li>
    <li class="filter-authors__item" data-filter-item="type">
      <button class="filter-authors__name" type="button" data-filter-name>
        <span><?php pll_e('Authors choice'); ?></span>
        <svg width="15" height="15" fill="#333">
          <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-arrow-right"/>
        </svg>
      </button>
        <ul class="filter-authors__item-list" data-filter-list>
            <?php
            $args = array(
                'role__in' => array('administrator', 'author', 'editor'),
                'orderby' => 'display_name',
                'order' => 'ASC',
            );
            $authors_list = get_users( $args );
            foreach($authors_list as $author){ ?>
                <a href="<?php get_bloginfo('url')?>/?author=<?php echo $author->ID;?>">
                    <?php $name_en =  get_the_author_meta('name_lang_en', $author->ID); ?>
                    <?php $name_ru =  get_the_author_meta('name_lang_ru', $author->ID); ?>
                    <?php $curent_lang = pll_current_language(); ?>
                    <?php if(pll_current_language() == 'uk'){ ?>
                    <li><?php the_author_meta('display_name', $author->ID); ?></li>
                    <?php } elseif(pll_current_language() == 'ru' || pll_current_language() == 'en'){ ?>
                        <li><?php the_author_meta('name_lang_'.pll_current_language(), $author->ID); ?></li>
                    <?php } ?>
                    <?php if($curent_lang == 'en' && $name_en == '' || $curent_lang == 'ru' && $name_ru == ''){ ?>
                        <li><?php the_author_meta('display_name', $author->ID);?> </li>
                    <?php } ?>
                </a>
            <?php }
            ?>
        </ul>
    </li>
  </ul>
</section>

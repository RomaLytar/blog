<section class="popular" data-popular>
  <h2 class="popular__title"><?php pll_e('Popular articles') ?></h2>
  <div class="popular__tabs" data-popular-btns>
    <button class="popular__btn active" data-popular-btn="reed"><?php pll_e('Readable') ?></button>
    <button class="popular__btn" data-popular-btn="koment"><?php pll_e('Commented') ?></button>
  </div>
  <div class="popular__inner active" data-popular-block="reed">
      <?php
      $args = array(
          'post_type' => 'articles',
          'meta_key' => 'post_views_count',
          'orderby' => 'meta_value_num',
          'order'    => 'DESC',
          'type' => 'NUMERIC',
          'posts_per_page' => 8,
      );
      $query = new WP_Query( $args );
      // Цикл
      if ( $query->have_posts() ) {
          while ( $query->have_posts() ) {
              $query->the_post(); ?>
              <div class="popular__item">
                  <div class="article-small">
                      <picture class="article-small__img">
                        <a href="<?php the_permalink(); ?>" class="popular__img-link" title="<?php pll_e('Read'); ?>">
                          <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        </a>
                      </picture>
                      <div class="article-small__descr">
                          <div class="article-small__text">
                              <a href="<?php the_permalink(); ?>" class="popular__img-link" title="<?php pll_e('Read'); ?>">
                                  <p><?php the_title(); ?></p>
                              </a>
                          </div>
                          <p class="article-small__author">
                            <?php $id_authot = get_the_author_meta('ID'); ?>
                            <a href="<?php echo get_author_posts_url($id_authot) ?>" class="popular__img-link" title="<?php echo get_the_author_meta('first_name'); ?> <?php echo get_the_author_meta('user_lastname') ?>">
                              <?php echo get_the_author_meta('first_name'); ?>
                              <?php echo get_the_author_meta('user_lastname') ?>
                            </a>
                          </p>
                      </div>
                  </div>
              </div>
              <?php
          }
      } else {
          // Постов не найдено
      }
      // Возвращаем оригинальные данные поста. Сбрасываем $post.
      wp_reset_postdata();
      ?>
  </div>
  <div class="popular__inner" data-popular-block="koment">
      <?php
      $args = array(
          'post_type' => 'articles',
          'orderby' => 'comment_count',
          'order'    => 'DESC',
          'posts_per_page' => 8,
      );
      $query = new WP_Query( $args );
      // Цикл
      if ( $query->have_posts() ) {
          while ( $query->have_posts() ) {
              $query->the_post(); ?>
              <div class="popular__item">
                  <a href="<?php the_permalink(); ?>" class="popular__link">
                      <div class="article-small">
                          <picture class="article-small__img">
                              <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                          </picture>
                          <div class="article-small__descr">
                              <div class="article-small__text">
                                  <p><?php the_title(); ?></p>
                              </div>
                              <p class="article-small__author">
                                  <?php echo get_the_author_meta('first_name'); ?>
                                  <?php echo get_the_author_meta('user_lastname') ?>
                              </p>
                          </div>
                      </div>
                  </a>
              </div>
              <?php
          }
      } else {
          // Постов не найдено
      }
      // Возвращаем оригинальные данные поста. Сбрасываем $post.
      wp_reset_postdata();
      ?>
  </div>
</section>

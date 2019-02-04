
<section class="best" data-best-articles>
  <h2 class="best__title"><?php  pll_e('Top Articles'); ?></h2>
  <div class="best__inner" data-best-article-slider>
      <?php
      $args = array(
          'post_type' => 'articles',
          'meta_key' => 'post_views_count',
          'orderby' => 'meta_value_num',
          'order'    => 'DESC',
          'type' => 'NUMERIC',
          'posts_per_page' => 3,
      );
      $query = new WP_Query( $args );
      // Цикл
      if ( $query->have_posts() ) {
          while ( $query->have_posts() ) {
              $query->the_post(); ?>
              <div class="article" data-slider-item>
                  <div class="article__wrap">
                      <figure class="article__img">
                        <a href="<?php the_permalink(); ?>" class="article__img-link" title="<?php pll_e('Read'); ?>">
                          <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        </a>
                      </figure>
                      <div class="article__descr">
                          <h3 class="article__title">
                              <a href="<?php the_permalink(); ?>" class="article__title-link" title="<?php pll_e('Read'); ?>">
                                <?php the_title(); ?>
                              </a>
                          </h3>
                          <p class="article__create">
                              <?php $id_authot = get_the_author_meta('ID'); ?>
                              <a href="<?php echo get_author_posts_url($id_authot) ?>" class="article__create-link" title="<?php echo get_the_author_meta('first_name'); ?> <?php echo get_the_author_meta('user_lastname') ?>">
                                <span class="article__create-author">
                                    <?php echo get_the_author_meta('first_name'); ?>
                                    <?php echo get_the_author_meta('user_lastname') ?>
                                </span>
                              </a>
                              <span class="article__create-time"><?php echo get_the_date('j F  Y | g:i'); ?></span>
                              <span class="article__create-type"><?php pll_e('Section') ?>:
                                  <?php
                                  $cur_terms = get_the_terms( $post->ID, 'taxonomy' );
                                  if( is_array( $cur_terms ) ){
                                      foreach( $cur_terms as $cur_term ){
                                          echo $cur_term->name;
                                          echo ' ';
                                      }
                                  }
                                  ?>
                              </span>
                          </p>
                          <div class="article__text-block">
                              <div class="article__text">
                                  <p>
                                      <?php $content = (get_the_content()); ?>
                                      <?php echo mb_strimwidth($content, 0,150, '...'); ?>
                                  </p>
                              </div>
                              <a href="<?php the_permalink(); ?>" class="btn-link"><?php pll_e('Read'); ?></a>
                          </div>
                          <div class="article-info">
                              <p class="article-info__stat">
                              <span class="article-info__item" title="Понравилось">23
                                <span class="article-info__icon">
                                  <svg width="12" height="12" fill="#cba957">
                                    <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-thumb-up"></use>
                                  </svg>
                                </span>
                              </span>
                                  <span class="article-info__item" title="Поделились"><?php comments_number('0', '1', '%'); ?>
                                      <span class="article-info__icon">
                                      <svg width="12" height="12" fill="#cba957">
                                        <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-speech"></use>
                                      </svg>
                                    </span>
                                  </span>
                                  <span class="article-info__item" title="Просмотров"><?php echo getPostViews(get_the_ID()); ?>
                                      <span class="article-info__icon">
                                      <svg width="12" height="12" fill="#cba957">
                                        <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-eye"></use>
                                      </svg>
                                    </span>
                                  </span>
                              </p>
                              <p class="article-info__tags">
                                  <?php
                                  $i = 1;
                                  $cur_tags = get_the_terms( $post->ID, 'tags' );
                                  if( is_array( $cur_tags ) ){
                                      foreach( $cur_tags as $cur_tag ){?>
                                          <span class="article-info__tag"><?php echo $cur_tag->name ?>
                                              <?php if($i == 1): ?>
                                                  <span class="article-info__icon">
                                                 <svg width="12" height="12" fill="#cba957">
                                                     <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-label"></use>
                                                 </svg>
                                             </span>
                                              <?php endif; ?>
                                        </span>
                                          <?php
                                          $i++;
                                      }
                                  }
                                  ?>
                              </p>
                          </div>
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
  <div class="best__control">
    <div class="best__slides">
      <span data-counter>1</span><span>/</span><span data-sum>3</span>
    </div>
    <div class="best__buttons" data-best-slider-buttons>
      <button class="best__btn btn-slider best__btn--prev" id="best-slider-btn-prev">
          Prev
          <svg width="30" height="30" fill="#000000">
              <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-arrow-right"/>
          </svg>
      </button>
      <button class="best__btn btn-slider best__btn--next" id="best-slider-btn-next">
          Next
          <svg width="30" height="30" fill="#000000">
              <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-arrow-right"/>
          </svg>
      </button>
    </div>
  </div>
</section>

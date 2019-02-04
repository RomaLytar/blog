
<section class="article-author">
  <div class="article-author__inner">
      <?php get_header(); ?>
      <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
              <?php setPostViews(get_the_ID()); ?>
              <div class="article">
                  <div class="article__wrap">
                      <figure class="article__img">
                          <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                      </figure>
                      <div class="article__descr">
                          <h3 class="article__title"><?php the_title(); ?></h3>
                          <p class="article__create">
                              <span class="article__create-author article__create-author--link"> Автор:
                                  <?php $id_authot = get_the_author_meta('ID'); ?>
                                <a href="<?php echo get_author_posts_url($id_authot) ?>" class="article__create-link">
                                  <?php echo get_the_author_meta('first_name'); ?>
                                  <?php echo get_the_author_meta('user_lastname') ?>
                                </a>
                              </span>
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
                              <span class="article__create-time"><?php pll_e('This article is available at') ?>:
                                  <?php $translation = pll_get_post_translations($post->ID); ?>
                                  <?php $key = (array_keys($translation)); ?>
                                  <?php $count = (count($key)); ?>
                                  <?php for ($i = 0; $i < $count; $i++)
                                  {
                                          $options = '';
                                          $options = pll__($key[$i]);
                                          $html[] = $options;
                                  } ;?>
                                  <?php  echo rtrim(implode(', ', $html), ','); ?></span>
                            </p>

                          <div class="article-info">
                              <p class="article-info__stat">
                                  <span class="article-info__item" title="Понравилось">                                      <!-- LikeBtn.com BEGIN -->
                                    23
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
                  <div class="article__body">
                  <?php the_content(); ?>
                  </div>
              </div>
              <?php endwhile; ?>
      <?php endif; ?>
      <?php get_template_part('includes/share/share'); ?>
  </div>
</section>

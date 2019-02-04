<section class="articles-author-all">
  <h2 class="articles-author-all__title"><?php pll_e('Last articles') ?></h2>
    <?php
    if(have_posts())
        { while(have_posts())   { the_post(); ?>
        <div class="article-middle">
            <div class="article-middle__iitem">
                <h3 class="article-middle__title">
                    <a href="<?php the_permalink(); ?>" class="article-middle__title-link" title="<?php pll_e('Read'); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <p class="article-middle__create">
                    <span class="article-middle__create-time"><?php echo get_the_date('j F  Y | g:i'); ?></span>
                    <span class="article-middle__create-type"><?php pll_e('Section') ?>:
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
                <div class="article-middle__text-block">
                    <div class="article-middle__text">
                        <p>
                            <?php $content = (get_the_content()); ?>
                            <?php echo mb_strimwidth($content, 0,200, '...'); ?>
                        </p>
                        <a href="<?php the_permalink(); ?> " class="btn-link"><?php pll_e('Read'); ?></a>
                    </div>
                </div>
                <div class="article-info">
                    <figure class="article-info__img">
                        <?php $id_authot = get_the_author_meta('ID'); ?>
                        <?php global $post;
                         $url = get_avatar_url( $post, "size=126&default=mystery");
                        ?>
                        <a href="<?php echo get_author_posts_url($id_authot) ?>" class="article-info__author-link" title="<?php echo get_the_author_meta('first_name'); ?> <?php echo get_the_author_meta('user_lastname') ?>">

                          <img alt="<?php the_title(); ?>" src="<?php echo get_the_post_thumbnail_url(); ?>">
                        </a>
                    </figure>
                    <div class="article-info__inner">
                        <p class="article-info__author">
                            <a href="<?php echo get_author_posts_url($id_authot) ?>" class="article-info__author-link" title="<?php echo get_the_author_meta('first_name'); ?> <?php echo get_the_author_meta('user_lastname') ?>">
                                <?php echo get_the_author_meta('first_name'); ?>
                                <?php echo get_the_author_meta('user_lastname') ?>
                            </a>
                        </p>
                        <p class="article-info__stat">
                              <span class="article-info__item">23
                                <span class="article-info__icon">
                                  <svg width="12" height="12" fill="#cba957">
                                    <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-thumb-up"></use>
                                  </svg>
                                </span>
                              </span>
                            <span class="article-info__item"><?php comments_number('0', '1', '%'); ?>
                                <span class="article-info__icon">
                                  <svg width="12" height="12" fill="#cba957">
                                    <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-speech"></use>
                                  </svg>
                                </span>
                            </span>
                            <span class="article-info__item"><?php echo getPostViews(get_the_ID()); ?>
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

<!-- пагинация -->
<?php get_template_part('includes/pagination/pagination_author'); ?>
</section>

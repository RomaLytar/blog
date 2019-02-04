<section class="digests">
  <ul class="digests__list">
      <?php $category_name = $_GET['cat']; ?>
      <?php
      $args = array(
          'post_type' => 'digest',
          'order'    => 'DESC',
          'period' => $category_name,
          'posts_per_page' => -1,
      );
      $query = new WP_Query( $args );
      // Цикл
      if ( $query->have_posts() ) {
      while ( $query->have_posts() ) {
      $query->the_post(); ?>
          <?php $pdf = get_post_meta($post->ID, 'wpcf-pdf', true); ?>
          <li class="digests__item">
              <a href="<?php echo $pdf; ?>" class="digests__link"><?php the_title(); ?></a>
              <span>
                  <?php echo get_the_content(); ?>
              </span>
          </li>
          <?php
        }
      } else {
          // Постов не найдено
      }
      // Возвращаем оригинальные данные поста. Сбрасываем $post.
      wp_reset_postdata();
      ?>
  </ul>
</section>

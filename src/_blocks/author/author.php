<?php
// Установка переменной текущего автора $curauth
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<section class="author">
  <figure class="author__img">
      <?php $url = get_avatar_url($curauth->id, "size=278&default=mystery"); ?>
       <img alt="<?php the_author(); ?>" src="<?php echo $url ?>">
  </figure>
  <div class="author__descr">
            <h2 class="author__name">
                <?php echo $curauth->display_name; ?>
            </h2>
            <p class="author__stat"><?php pll_e('Director'); ?>
                <?php echo(count_user_posts_by_type($count = $curauth->id )); ?>
                <?php pll_e('Article_author'); ?>
            </p>
    <p class="author__place"><?php the_author_meta('country_city', $curauth->id ); ?></p>
    <div class="author__text">
      <p><?php echo $curauth->user_description; ?> </p>
    </div>
  </div>
</section>

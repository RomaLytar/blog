<section class="pagination">
    <?php
    $category_name = $_GET['cat'];
    $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $qury = query_posts(array ('paged' => $page,
        'post_type' => 'articles',
        'posts_per_page' => 6,
        'taxonomy' => $category_name
        ));
    if(have_posts()){ while(have_posts()){ the_post();
        wp_blog_pagination();
    }}
    else echo '';
    ?>
</section>


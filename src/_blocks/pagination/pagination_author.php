<section class="pagination">
    <?php
    if(have_posts()) : while(have_posts()) : the_post();
        wp_blog_pagination();?>
    <?php endwhile;
    endif; ?>
</section>


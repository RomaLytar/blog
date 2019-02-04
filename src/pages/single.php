<?php
/*
Template Name: article-author
*/
?>
<?php get_header(); ?>

    <div class="wrap">
        <main class="main-section">
            <div class="main-section__articles">
                <?php get_template_part('includes/article-author/article-author'); ?>
                <?php get_template_part('includes/post/post-form/post-form'); ?>
                <?php comments_template(); ?>
            </div>
            <aside class="main-section__popular">
                <?php get_template_part('includes/main/popular/popular'); ?>
            </aside>
        </main>
    </div>

<?php get_footer(); ?>
<?php get_header(); ?>

<div class="wrap">
    <main class="main-section">
        <div class="main-section__articles">
            <?php get_template_part('includes/articles-all/articles-cat'); ?>
        </div>
        <aside class="main-section__popular">
            <?php get_template_part('includes/main/popular/popular'); ?>
        </aside>
    </main>
</div>

<?php get_footer(); ?>


<!-- Роме: Активному пункту меню для элемента списка menu__item добавить класс active -->

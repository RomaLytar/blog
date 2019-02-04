<?php
/*СПИСОК АВТОРОВ*/
function contributors()
{
    $get_rating = $_GET['order'];
    if ($get_rating == 'rating_user') {
        $args = array(
            'role__in' => array('administrator', 'author', 'editor'),
            //      'orderby'      => 'display_name',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => $get_rating,
                    'type' => 'numeric',
                ),
            )
        );
    } else {
        $args = array(
            'role__in' => array('administrator', 'author', 'editor'),
            'orderby' => 'display_name',
            'order' => 'ASC',
        );
    }
    global $wpdb;
    $sumArray = array();
    add_action('pre_user_query', 'temp_replace');
    function temp_replace($query){
        $query->query_from = str_replace("post_type = 'post'", "post_type = 'articles'", $query->query_from );
    };
    $authors = get_users( $args );
    remove_action('pre_user_query', 'temp_replace');
    foreach($authors as $author) {
        $id_post_user = $wpdb->get_results("SELECT ID FROM $wpdb->posts 
                                      WHERE post_status = 'publish' AND post_author = $author->ID
                                      AND post_type='articles'");
        $counts = '';
        $html = array();
        foreach ($id_post_user as $v){
            $counts = ($v->ID);
            $html[] = $counts;
        }
        $counts_id =  rtrim(implode(',', $html));
        $likes = $wpdb->get_results("SELECT META_VALUE 
                            FROM $wpdb->postmeta 
                            WHERE meta_key = '_liked' 
                            AND post_id IN  ($counts_id)");
        $sumArray = array();
        foreach ($likes as $k => $like){
            foreach ($like as $id=>$v){
                $sumArray[$id]+=$v;
            }
        }
        ?>
        <li class="authors__item">
                  <a href="<?php get_bloginfo('url')?>/?author=<?php echo $author->ID;?>" class="authors__img-link" title="Перейти на страницу автора">
                    <figure class="authors__img">
                        <?php echo get_avatar($author->ID, 400);?>
                    </figure>
                  </a>
            <?php $id_authot = get_the_author_meta('ID'); ?>
                  <h3 class="authors__title">
                        <a href="<?php get_bloginfo('url')?>/?author=<?php echo $author->ID;?>" class="authors__title-link">
                            <?php $name_en =  get_the_author_meta('name_lang_en', $author->ID); ?>
                            <?php $name_ru =  get_the_author_meta('name_lang_ru', $author->ID); ?>
                            <?php $curent_lang = pll_current_language(); ?>
                            <?php if(pll_current_language() == 'uk'){ ?>
                                <?php the_author_meta('display_name', $author->ID);?>
                            <?php }
                                elseif(pll_current_language() == 'ru' || pll_current_language() == 'en'){
                                      the_author_meta('name_lang_'.pll_current_language(), $author->ID);
                                }
                                if($curent_lang == 'en' && $name_en == '' || $curent_lang == 'ru' && $name_ru == ''){
                                    the_author_meta('display_name', $author->ID);
                                }
                          ?>
                        </a>
                  </h3>
                  <?php $position_ru = get_the_author_meta('position_user_ru', $author->ID); ?>
                  <?php $position_en = get_the_author_meta('position_user_en', $author->ID); ?>
                        <?php if(pll_current_language() == 'uk'){ ?>
                            <p class="authors__place"><?php the_author_meta('position_user', $author->ID); ?></p>
                        <?php
                        } elseif(pll_current_language() == 'ru' || pll_current_language() == 'en'){ ?>
                            <p class="authors__place"><?php the_author_meta('position_user_'.pll_current_language(), $author->ID); ?></p>
                        <?php } ?>
                        <?php if($curent_lang == 'en' && $position_en == '' || $curent_lang == 'ru' && $position_ru == ''){ ?>
                            <p class="authors__place"><?php the_author_meta('position_user', $author->ID); ?></p>
                        <?php } ?>
                  <p class="authors__rait"><?php pll_e('Rating'); ?> <span><?php foreach($sumArray as $value) echo $value; ?></span></p>
        </li>
    <?php }
}

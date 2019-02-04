<?php
//рейтинг у пользователя.
function rating_user_update(){
    global $wpdb;
    $args = array(
        'role__in'     => array( 'administrator', 'author', 'editor'),
    );
    $authors = get_users( $args );
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
        <?php foreach($sumArray as $value)?>
        <?php $wpdb->get_results("UPDATE wp_usermeta
                    SET meta_value = $value
                    WHERE user_id = $author->ID
                    AND meta_key = 'rating_user'")  ?>
    <?php }
}
<?php
/* Отключаем админ панель для всех пользователей. */
show_admin_bar(false);

add_theme_support( 'post-thumbnails' );


//langht
include ('mod/lang.php');
//setting
include ('mod/setting.php');
//customer_post
include ('mod/customer_post.php');
//Customer walker nav menu
include ('mod/Custom_Walker_Nav_Menu.php');
//pagination
include ('mod/wp_blog_pagination.php');
//list comments
include ('mod/list_comments.php');
//list authors
include ('mod/list_authors.php');
//rating author
include ('mod/rating_author.php');
//registration form
// include ('mod/regist_form.php');





//подключение меню
register_nav_menus(array(
  'top_menu' => 'Меню хедер',
  'top_len' => 'Языковое меню',
  'footer_menu' => 'Меню футер'
));


/**
 * выводим количество просмотров статьи
 */


//кол-во просмотров
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
// setPostViews(get_the_ID()); в шаблоне сингл
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//author info
add_filter('user_contactmethods', 'ved_user_contactmethods');
function ved_user_contactmethods($user_contactmethods){
    $user_contactmethods['position_user'] = pll__('Position');
    $user_contactmethods['position_user_ru'] = pll__('Position ru');
    $user_contactmethods['position_user_en'] = pll__('Position en');
    $user_contactmethods['country_city'] = pll__('Country city');
    $user_contactmethods['country_city_ru'] = pll__('Country city ru');
    $user_contactmethods['country_city_en'] = pll__('Country city en');
    $user_contactmethods['name_lang_ru'] = pll__('Name ru');
    $user_contactmethods['name_lang_en'] = pll__('Name en');
    $user_contactmethods['rating_user'] = pll__('User rating');
    //вывод the_author_meta['country_city'];

    return $user_contactmethods;
}

//кол-во статей автора
function count_user_posts_by_type($userid, $post_type='articles') {
    global $wpdb;
    $where = get_posts_by_author_sql( $post_type, TRUE, $userid );
    $count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts $where" );
    return apply_filters('get_usernumposts', $count, $userid);
}
//пагинация на странице атора.
function author_cpt_filter($query) {
    if ( !is_admin() && $query->is_main_query() ) {
        if ($query->is_author()) {
            $query->set('post_type', array('articles'));
            $query->set('post_per_page', 6);
        }
    }
}
add_action('pre_get_posts','author_cpt_filter');

//виджет
function register_my_widgets(){
    register_sidebar( array(
        'name' => "Правая боковая панель сайта",
        'id' => 'right-sidebar',
        'description' => 'Эти виджеты будут показаны в правой колонке сайта',
        'before_title' => '<h1>',
        'after_title' => '</h1>'
    ) );
}
add_action( 'widgets_init', 'register_my_widgets' );

//рейтинг автора
function rating_user_posts_by_type($userid, $post_type='articles') {
    global $wpdb;
    $where = get_posts_by_author_sql( $post_type, TRUE, $userid );
    $count = $wpdb->get_var( "SELECT * FROM $wpdb->posts $where " );
    return apply_filters('get_usernumposts', $count, $userid);
}

//registration

// Enable the user with no privileges to run ajax_register() in AJAX
add_action( 'wp_ajax_ajaxregister', 'ajax_register' );
add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register' );



function ajax_register(){

    check_ajax_referer( 'ajax-register-nonce', 'security' );

    $info = array();
    $info['user_nicename'] = $info['nickname'] = $info['display_name'] =  $info['user_login'] = sanitize_user($_POST['username']) ;
    $info['user_pass'] = sanitize_text_field($_POST['password']);
    $info['user_email'] = sanitize_email( $_POST['email']);
    $info['first_name'] = sanitize_user($_POST['first_name']);
    $info['last_name'] = sanitize_user($_POST['last_name']);

    // Register the user
    $user_register = wp_insert_user( $info );
    if ( is_wp_error($user_register) ){
        $error  = $user_register->get_error_codes()	;

        if(in_array('empty_user_login', $error))
            echo json_encode(array('loggedin'=>false, 'message'=>__($user_register->get_error_message('empty_user_login'))));
        elseif(in_array('existing_user_login',$error))
            echo json_encode(array('loggedin'=>false, 'message'=>__('This username is already registered.')));
        elseif(in_array('existing_user_email',$error))
            echo json_encode(array('loggedin'=>false, 'message'=>__('This email address is already registered.')));
    } else {
        return true;
    }
    die();
}

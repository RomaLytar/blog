<?php
/**
 * Статьи
 */
add_action('init', 'articles');
function articles(){
    register_post_type('articles', array(
        'public' => true,
        'supports' => array ('title','editor','author','thumbnail','excerpt','comments','custom-fields', 'trackbacks'),
        'menu_position' => 7,
        'menu_icon' => 'dashicons-id',
        'show_in_rest' => true,
        'rest_base'             => 'articles',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'labels' => array(
            'name' => pll__('Articles'),
            'all_items' => pll__('All articles'),
            'add_new' => pll__('Add a articles'),
            'add_new_item' => pll__('Add articles'),
            'edit_item'  => pll__('Edit articles'),
            'new_item'           => pll__('New articles'), // текст новой записи
            'view_item'          => pll__('Watch the articles'), // для просмотра записи этого типа.
            'search_items'       => pll__('Search articles'), // для поиска по этим типам записи
            'not_found'          => pll__('No articles added'), // если в результате поиска ничего не было найдено
        ),
    ));
}


/**
 * taxonomy articles
 */
add_action('init', 'taxonomy_articles');
function taxonomy_articles(){
    register_taxonomy('taxonomy', array('articles'), array(
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => pll__('Articles type'),
            'singular_name'     => pll__('Articles type'),
            'search_items'      => pll__('Search Articles'),
            'all_items'         => pll__('All Articles'),
            'view_item '        => pll__('View Articles'),
            'parent_item'       => pll__('Parent articles'),
            'parent_item_colon' => pll__('Parent articles'),
            'edit_item'         => pll__('Edit articles'),
            'update_item'       => pll__('Update articles'),
            'add_new_item'      => pll__('Add New articles'),
            'new_item_name'     => pll__('New articles Name'),
            'menu_name'         => pll__('articles type'),
        ),
        'description'           => '', // описание таксономии
        'public'                => true,
        'publicly_queryable'    => true, // равен аргументу public
        'show_in_nav_menus'     => true, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_in_menu'          => true, // равен аргументу show_ui
        'show_tagcloud'         => true, // равен аргументу show_ui
        'show_in_rest'          => true, // добавить в REST API
        'rest_base'             => 'taxonomy', // $taxonomy
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
        'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        '_builtin'              => false,
        'show_in_quick_edit'    => true, // по умолчанию значение show_ui
    ) );

    register_taxonomy('tags', 'articles',array(
        'hierarchical'  => false,
        'labels'        => array(
            'name'                        => pll__( 'Tags'),
            'singular_name'               => pll__( 'Tag'),
            'search_items'                =>  pll__( 'Search tag'),
            'popular_items'               => pll__( 'Popular tag'),
            'all_items'                   => pll__( 'All tags'),
            'parent_item'                 => null,
            'parent_item_colon'           => null,
            'edit_item'                   => pll__( 'Edit tag'),
            'update_item'                 => pll__( 'Update tag'),
            'add_new_item'                => pll__( 'Add New tag'),
            'new_item_name'               => pll__( 'New Tag Name'),
            'separate_items_with_commas'  => pll__( 'Separate tags with commas'),
            'add_or_remove_items'         => pll__( 'Add or remove tags'),
            'choose_from_most_used'       => pll__( 'Choose from the most used tags'),
            'menu_name'                   => pll__( 'Tags'),
        ),
        'show_ui'       => true,
        'query_var'     => true,
        //'rewrite'       => array( 'slug' => 'the_writer' ), // свой слаг в URL
    ));
}

/**
 * digest post type
 */
add_action('init', 'digest');
function digest(){
    register_post_type('digest', array(
        'public' => true,
        'supports' => array ('title','editor','author','thumbnail','excerpt','comments','custom-fields', 'trackbacks'),
        'menu_position' => 7,
        'menu_icon' => 'dashicons-backup',
        'show_in_rest' => true,
        'rest_base'             => 'digest',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'labels' => array(
            'name' => pll__('Digest'),
            'all_items' => pll__('All digest'),
            'add_new' => pll__('Add a digest'),
            'add_new_item' => pll__('Add digest'),
            'edit_item'  => pll__('Edit digest'),
            'new_item'           => pll__('New digest'), // текст новой записи
            'view_item'          => pll__('Watch the digest'), // для просмотра записи этого типа.
            'search_items'       => pll__('Search digest'), // для поиска по этим типам записи
            'not_found'          => pll__('No digest added'), // если в результате поиска ничего не было найдено
        ),
    ));
}
/**
 * end digest
 */

/**
 * register digest tax
 */
add_action('init', 'taxonomy_period');
function taxonomy_period()
{
    register_taxonomy('period', array('digest'), array(
        'label' => '', // определяется параметром $labels->name
        'labels' => array(
            'name' => pll__('Period'),
            'singular_name' => pll__('Period'),
            'search_items' => pll__('Search period'),
            'all_items' => pll__('All period'),
            'view_item ' => pll__('View period'),
            'parent_item' => pll__('Parent period'),
            'parent_item_colon' => pll__('Parent period'),
            'edit_item' => pll__('Edit period'),
            'update_item' => pll__('Update period'),
            'add_new_item' => pll__('Add new period'),
            'new_item_name' => pll__('New period name'),
            'menu_name' => pll__('Period'),
        ),
        'description' => '', // описание таксономии
        'public' => true,
        'publicly_queryable' => true, // равен аргументу public
        'show_in_nav_menus' => true, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_in_menu' => true, // равен аргументу show_ui
        'show_tagcloud' => true, // равен аргументу show_ui
        'show_in_rest' => true, // добавить в REST API
        'rest_base' => 'period', // $taxonomy
        'hierarchical' => true,
        'update_count_callback' => '',
        'rewrite' => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities' => array(),
        'meta_box_cb' => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        '_builtin' => false,
        'show_in_quick_edit' => true, // по умолчанию значение show_ui
    ));
}

/**
 * end register digest tax
 */
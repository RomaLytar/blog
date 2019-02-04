<?php
/**
$prosmotr = get_post_meta(get_the_ID(), 'kol_view',true);
$prosmotr++;
update_post_meta(get_the_ID(), 'kol_view', $prosmotr);
 */
/**
 * Включаем возможность загрузки SVG через админ панель
 */
function my_myme_types($mime_types){
	$mime_types['svg'] = 'image/svg+xml'; // поддержка SVG
	return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);

## удаляет сообщение о новой версии WordPress у всех пользователей кроме администратора
if( is_admin() && ! current_user_can('manage_options') ){
	add_action('init', function(){  remove_action( 'init', 'wp_version_check' );  }, 2 );
	add_filter('pre_option_update_core', '__return_null');
}

##  отменим показ выбранного термина наверху в checkbox списке терминов
add_filter( 'wp_terms_checklist_args', 'set_checked_ontop_default', 10 );
function set_checked_ontop_default( $args ) {
	// изменим параметр по умолчанию на false
	if( ! isset($args['checked_ontop']) )
		$args['checked_ontop'] = false;

	return $args;
}

## Удаление табов "Все рубрики" и "Часто используемые" из метабоксов рубрик (таксономий) на странице редактирования записи.
add_action('admin_print_footer_scripts', 'hide_tax_metabox_tabs_admin_styles', 99);
function hide_tax_metabox_tabs_admin_styles(){
	$cs = get_current_screen();
	if( $cs->base !== 'post' || empty($cs->post_type) ) return; // не страница редактирования записи
	?>
	<style>
		.postbox div.tabs-panel{ max-height:1200px; border:0; }
		.category-tabs{ display:none; }
	</style>
	<?php
}

## Добавляет миниатюры записи в таблицу записей в админке
if(1){
	add_action('init', 'add_post_thumbs_in_post_list_table', 20 );
	function add_post_thumbs_in_post_list_table(){
		// проверим какие записи поддерживают миниатюры
		$supports = get_theme_support('post-thumbnails');

		// $ptype_names = array('post','page'); // указывает типы для которых нужна колонка отдельно

		// Определяем типы записей автоматически
		if( ! isset($ptype_names) ){
			if( $supports === true ){
				$ptype_names = get_post_types(array( 'public'=>true ), 'names');
				$ptype_names = array_diff( $ptype_names, array('attachment') );
			}
			// для отдельных типов записей
			elseif( is_array($supports) ){
				$ptype_names = $supports[0];
			}
		}

		// добавляем фильтры для всех найденных типов записей
		foreach( $ptype_names as $ptype ){
			add_filter( "manage_{$ptype}_posts_columns", 'add_thumb_column' );
			add_action( "manage_{$ptype}_posts_custom_column", 'add_thumb_value', 10, 2 );
		}
	}

	// добавим колонку
	function add_thumb_column( $columns ){
		// подправим ширину колонки через css
		add_action('admin_notices', function(){
			echo '
			<style>
				.column-thumbnail{ width:80px; text-align:center; }
			</style>';
		});

		$num = 1; // после какой по счету колонки вставлять новые

		$new_columns = array( 'thumbnail' => __('Thumbnail') );

		return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
	}

	// заполним колонку
	function add_thumb_value( $colname, $post_id ){
		if( 'thumbnail' == $colname ){
			$width  = $height = 45;

			// миниатюра
			if( $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true ) ){
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			// из галереи...
			elseif( $attachments = get_children( array(
				'post_parent'    => $post_id,
				'post_mime_type' => 'image',
				'post_type'      => 'attachment',
				'numberposts'    => 1,
				'order'          => 'DESC',
			) ) ){
				$attach = array_shift( $attachments );
				$thumb = wp_get_attachment_image( $attach->ID, array($width, $height), true );
			}

			echo empty($thumb) ? ' ' : $thumb;
		}
	}
}

/*
 * Опции
 */
function my_more_options()
{
    add_settings_field('phone', pll__('Company phone'), 'display_phone', 'general');
    register_setting('general', 'phone');
    add_settings_field('address', pll__('Company address'), 'display_address', 'general');
    register_setting('general', 'my_address');

    // Social links
    add_settings_field('instagram', 'Instagram', 'display_inst', 'general');
    register_setting('general', 'my_instagram');
    add_settings_field('facebook', 'Facebook', 'display_facebook', 'general');
    register_setting('general', 'my_facebook');
    add_settings_field('twitter', 'Twitter', 'display_twitter', 'general');
    register_setting('general', 'my_twitter');
    add_settings_field('youtude', 'YouTude', 'display_youtude', 'general');
    register_setting('general', 'my_youtude');
}

add_action('admin_init', 'my_more_options');

function display_phone(){
    echo "<input type='text' class='regular-text' name='phone' value='" . esc_attr(get_option('phone')) . "'>";
}
function display_address(){
    echo "<input type='text' class='regular-text' name='my_address' value='" . pll__(esc_attr(get_option('my_address'))) . "'>";
}
function display_inst(){
    echo "<input type='text' class='regular-text' name='my_instagram' value='" . esc_attr(get_option('my_instagram')) . "'>";
}

function display_facebook(){
    echo "<input type='text' class='regular-text' name='my_facebook' value='" . esc_attr(get_option('my_facebook')) . "'>";
}

function display_twitter(){
    echo "<input type='text' class='regular-text' name='my_twitter' value='" . esc_attr(get_option('my_twitter')) . "'>";
}
function display_youtude(){
    echo "<input type='text' class='regular-text' name='my_youtude' value='" . esc_attr(get_option('my_youtude')) . "'>";
}

//Меню в футере
function clean_custom_menus() {
    $menu_name = 'footer_menu'; // specify custom menu name
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = "\t\t\t\t". '<ul class="footer__menu-list">' ."\n";
        foreach ((array) $menu_items as $key => $menu_item) {
            $title = $menu_item->title;
            $url = $menu_item->url;
            $menu_list .= "\t\t\t\t\t". '<li class="footer__menu-item"><a href="'. $url .'" class="footer__menu-link">'. $title .'</a></li>' ."\n";
        }
        $menu_list .= "\t\t\t\t". '</ul>' ."\n";
    } else {
    }
    echo $menu_list;
}


<?php

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        $html = "";
        if($depth == 0) {
            $html .= "\n<li";

            if($args->walker->has_children) {
                $html .= ' class="menu__item" data-toggle';
            }

            if(!$args->walker->has_children) {
                $html .= ' class="menu__item"';
            }

            $html .= "><a ";

            if($args->walker->has_children) {
                $item->url = preg_replace('/##/', '', $item->url);
                $html .= ' href="' . $item->url . '"';
                $html .= 'class="menu__item-submenu" data-toggle-link';
            }
            if(!$args->walker->has_children) {
                $html .= ' href="' . $item->url . '"';
            }
            $html .= '>%s';

            if($args->walker->has_children) {
                $html .= '<span class="menu__icon">
                              <svg width="14" height="14" fill="#fff">
                                <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-arrow-right"></use>
                              </svg>
                           </span>';
            }

            $html .= '</a>';

            if($args->walker->has_children) {
                $html .= '<ul class="menu__submenu" data-toggle-list>';
            }

            $output .= sprintf($html,$item->title);

        }
        elseif($depth == 1) {
            $output .= '<li class="menu__submenu-item"><a href="'.$item->url.'">'.$item->title.'</a></li>';
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = array()) {

        if($depth == 0) {
        }
        elseif($depth == 1) {
            $output .= '</li>';
        }
    }

    public function start_lvl(&$output, $depth = 0, $args = array()) {
        if($depth == 0) {

        }
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        if($depth == 0) {
            $output .= '</ul>';
        }
    }

}

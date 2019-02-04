<?php
// wp pagination
function wp_blog_pagination( $args = array() ) {

$defaults = array(
'range'           => 4,
'custom_query'    => FALSE,
'previous_string' => pll__( 'Previous', 'text-domain' ),
'next_string'     => pll__( 'Next', 'text-domain' ),
'before_output'   => '<ul class="pagination__list">',
        'after_output'    => '</ul>'
);

    $args = wp_parse_args(
    $args,
    apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
    );

    $args['range'] = (int) $args['range'] - 1;
    if ( !$args['custom_query'] )
        $args['custom_query'] = @$GLOBALS['wp_query'];
        $count = (int) $args['custom_query']->max_num_pages;
        $page  = intval( get_query_var( 'paged' ) );
        $ceil  = ceil( $args['range'] / 2 );

    if ( $count <= 1 )
        return FALSE;

    if ( !$page )
        $page = 1;

if ( $count > $args['range'] ) {
    if ( $page <= $args['range'] ) {
    $min = 1;
    $max = $args['range'] + 1;
    }
    elseif ( $page >= ($count - $ceil) ) {
        $min = $count - $args['range'];
        $max = $count;
        }
        elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
        } else {
        $min = 1;
        $max = $count;
        }

$echo = '';
$previous = intval($page) - 1;
$previous = esc_attr( get_pagenum_link($previous) );
if ( $previous && (1 != $page) )
$echo .= '<li class="pagination__item">
                <a href="' . $previous . '" title="' . __( 'previous', 'text-domain') . '">
                  <svg width="10" height="10" fill="#999999">
                    <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-arrow-right" />
                  </svg>
                </a>
          </li>';


    if ( !empty($min) && !empty($max) ) {
        for( $i = $min; $i <= $max; $i++ ) {
            if ($page == $i) {
            $echo .= '<li class="pagination__item" data-active><a class="pagination__link">' . str_pad( (int)$i, 1, '0', STR_PAD_LEFT ) . '</a></li>';
            } else {
                $echo .= sprintf( '<li class="pagination__item"><a href="%s" class="pagination__link">%2d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
            }
        }
    }
        $next = intval($page) + 1;
        $next = esc_attr( get_pagenum_link($next) );
        if ($next && ($count != $page) )
        $echo .= '<li class="pagination__item">
                    <a href="' . $next . '" class="pagination__link" title="' . __( 'next', 'text-domain') . '">
                        <svg width="10" height="10" fill="#999999">
                            <use xlink:href="/wp-content/themes/theatreblog/img/svg/symbols.svg#icon-arrow-right" />
                        </svg>
                    </a>
                  </li>';

        if ( isset($echo) )
        echo $args['before_output'] . $echo . $args['after_output'];
        }
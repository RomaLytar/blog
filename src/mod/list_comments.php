<?php
function blog_theatre_list_comments($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?>
    <?php comment_class( empty( $args['has_children'] ) ? 'post-comment__item' : 'parent post-comment__item' ); ?> id="comment-<?php comment_ID() ?>">
    <?php
    if ( 'div' != $args['style'] ) { ?><?php
    } ?>
        <div class="comment__author">
            <figure class="comment__author-avatar"><?php
            if ( $args['avatar_size'] != 0 ) {
                echo get_avatar( $comment, $args['avatar_size'] ); 
            } 
            ?>
            </figure>
                <div class="comment__author-info">
                    <?php
                    printf( __( '<p class="comment__author-name">%s</p>' ), comment_author_link() );
                    ?>
                <p class="comment__author-date">
                    <span><?php
                    printf(
                            __('%1$s | %2$s'),
                            get_comment_date('j F Y'),
                            get_comment_time()
                        ); ?>
                    </span>
                </p>
                </div>
        </div>
    <?php
    if ( $comment->comment_approved == '0' ) { ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php
    } ?>
    <div class="comment__body">
        <div class="comment__text">
        <?php comment_text(); ?>
        </div>
        <button class="comment__add"><?php
            comment_reply_link(
                array_merge(
                    $args,
                    array(
                        'reply_text' => pll__('Reply'),
                        'add_below' => $add_below,
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth']
                    )
                )
            ); ?>
        </button>
    </div>
    <?php
    if ( 'div' != $args['style'] ) : ?>
    <?php
    endif;
}



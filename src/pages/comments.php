<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Blog thatre
 * @since Blog thatre 1.0
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>
<?php // You can start editing here -- including this comment! ?>

<?php if ( have_comments() ) : ?>
    <section class="post-comment">
        <h2 class="post-comment__title">Коментарии читателей</h2>
        <ul class="post-comment__list">
            <?php
            wp_list_comments(
                array(
                    'callback' => 'blog_theatre_list_comments',
                    'style'    => 'ul',
                    'short_ping' => true,
                    'avatar_size' => 54,
                    'max_depth' => 5,
                )
            );
            ?>
        </ul>
    </section>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below" class="navigation" role="navigation">
            <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'blog' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'blog' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'blog' ) ); ?></div>
        </nav>
    <?php endif; // check for comment navigation ?>

    <?php
    /* If there are no comments and comments are closed, let's leave a note.
     * But we only want the note on posts and pages that had comments in the first place.
     */
    if ( ! comments_open() && get_comments_number() ) :
        ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'blog' ); ?></p>
    <?php endif; ?>

<?php endif; // have_comments() ?>
<!--//--><?php //get_template_part('includes/post/post-comment/post-comment'); ?>

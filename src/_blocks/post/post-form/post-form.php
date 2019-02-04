<?php if ( is_user_logged_in() ) : ?>
    <section class="post-form">
        <h2 class="post-form__title"><?php pll_e('Leave feedback'); ?></h2>

        <?php
        $args = array(
            'fields' => array(
                'author' => '',
                'email' => '',
                'url' => ''
            ),
            'comment_notes_before' => '',
            'comment_field' => '<textarea  name="comment" id="comment" cols="30" rows="10" required></textarea>',
            'class_form' => 'post-form__form',
            'class_submit' => 'btn',
            'label_submit' => pll__('Post'),
            'submit_field' => '%1$s %2$s',
            'title_reply' => '',

        );
        comment_form($args);

        ?>
    </section>
<?php else: ?>
    <section class="post-form">
        <a href="#" class="post-form__autorizate-link"><?php pll_e('Login to leave a comment') ?></a>
    </section>
<?php endif; ?>
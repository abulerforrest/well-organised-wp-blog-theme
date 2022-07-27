<?php
/**
 * The template for the comment form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */

// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) {
echo '<div class="wobt-comment-form-wrapper">';
    comment_form(
        array(
            'comment_field' => '<textarea placeholder="' . wobt_get_text('comments_textarea_placeholder') . '" id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>',
            'logged_in_as' => '<p class="logged-in-as"><a href="' . get_site_url() . '/wp-admin/profile.php" aria-label="' . wobt_get_text('comments_logged_in_as') . ' ' . get_bloginfo( 'name' ) . '. ' . wobt_get_text('comments_edit_profile') . '.' . '">' . wobt_get_text('comments_logged_in_as') . ' ' . get_bloginfo( 'name' ) . '</a>. <button class="button is-info wobt-button"><span class="icon is-small" style="color: #fff;"><i class="mdi mdi-exit-to-app mdi-18px"></i></span><a href="' . get_site_url() . '/wp-login.php?action=logout">' . wobt_get_text('comments_log_out') . '</a></button> <span class="required-field-message" aria-hidden="true">' . wobt_get_text('comments_mandatory_fields') . ' <span class="required" aria-hidden="true">*</span></span></p>',
            'fields' => array(
            'author' => '<p class="comment-form-author"><input placeholder="' .  wobt_get_text('comments_name') . '" id="author" name="author" type="text" value="" size="30" maxlength="245" required="required"></p>',
            'email' => '<p class="comment-form-email"><input placeholder="' .  wobt_get_text('comments_email') . '" id="email" name="email" type="text" value="" size="30" maxlength="100" required="required"></p>',
            'url' => '<p class="comment-form-url"><input placeholder="' .  wobt_get_text('comments_social') . '" id="url" name="url" type="text" value="" size="30" maxlength="200"></p>',
            'cookies' => '<p class="wobt-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"><label for="wp-comment-cookies-consent" class="checkbox">' . wobt_get_text('comments_remember_me') . '</label></p>',
        ),
        'title_reply' => wobt_get_text('comments_leave_reply'),
        'comment_notes_before' => '<p>' . wobt_get_text('comments_no_registering') . '</p>',
        'comment_notes_after' => '',
        'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s button is-light wobt-button-comment" value="' . wobt_get_text('comments_publish_comment') .'" />',
    ));
    echo '</div>';
}
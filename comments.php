<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
    return;
}
// Fetch only the approved comments
$args = array(
    'status' => 'approve',
    'post_id' => get_the_ID()
);

// The comment Query
$comments_query = new WP_Comment_Query;
$comments = $comments_query->query( $args );

// Comment Loop
if ( $comments ) {
    echo '<div class="wobt-comments-container">';
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    if (isset($queries["nonce"]) && wp_verify_nonce($queries["nonce"], 'wobt_comment_reply_nonce') === 1) {
        if (isset($queries["msg"]) && $queries["msg"] === "thank-you-for-submitting-awaiting") {
            echo '
        <div class="box">
            ' . wobt_get_text('comments_awaiting_approval') . '
        </div>
        ';
        } else if (isset($queries["msg"]) && $queries["msg"] === "thank-you-for-submitting") {
            echo '
        <div class="box">
            ' . wobt_get_text('comments_thanks') . '
        </div>
        ';
        }
    }
    wp_list_comments('callback=wobt_comment', $comments);
} else {
    echo '
    <div style="margin-top: 15px;">
    ' . wobt_get_text('comments_missing_comments') . '
    </box>';
}
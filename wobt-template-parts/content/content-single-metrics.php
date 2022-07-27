<?php
/**
 * Template part for displaying single post metrics (tags, comments, likes)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */

$tags_count =  count(wp_get_post_terms(get_the_ID()));

echo '<div class="wobt-metrics-container">';
echo '<div class="wobt-single-post-tags-list-container">';
echo '<span class="icon is-medium wobt-icon"><span class="mdi mdi-tag-multiple-outline mdi-24px"></span> </span>';
if ($tags_count > 0) {
    echo '<span class="wobt-single-post-tags-list">' . get_the_tag_list() . '</span>';
} else {
    echo '<span class="wobt-single-post-tags-list">' . wobt_get_text('single_no_tags') . '</span>';
}
echo '</div>';

if (comments_open()) {
    echo '<div class="wobt-single-post-comments-container">';
    echo '<span class="icon is-medium wobt-icon"><span class="mdi mdi-comment-text-outline mdi-24px"></span> </span>';
    $append_comments_text = get_comments_number() == 1 ? wobt_get_text('single_comment') : wobt_get_text('single_comments');
    echo '<span class="wobt-single-post-comments"><a href="' . get_the_permalink() . '#comments">' . get_comments_number() . ' ' . $append_comments_text . '</a>';
    echo '&nbsp;| <a href=' . get_comments_link() . '>' . wobt_get_text('comments_leave_reply') . '</a></span>';
    echo '</div>';
}

$post_likes = get_post_meta(get_the_ID(), 'wobt_post_likes_count') ? get_post_meta(get_the_ID(), 'wobt_post_likes_count')[0]['likes'] : 0;
echo '<div class="wobt-single-post-likes-container">';
echo    '<span class="icon is-medium wobt-icon heart"><span class="mdi mdi-heart mdi-24px"></span> </span>';
$append_likes_text = $post_likes === 1 ? wobt_get_text('single_like')  : wobt_get_text('single_likes');
echo '<span class="wobt-single-post-likes">' . $post_likes . ' ' . $append_likes_text . '</span>';
echo '</div>';
echo '</div>';
<?php
/**
 * Displays the post status (single)
 *
 * @package Well Organised WP Blog Theme
 */

?>

<div class="wobt-single-status-container">
    <span><?php echo wobt_get_text('single_latest_update'); ?>: <?php echo the_modified_date(); ?></span>
</div>
<?php
$nonce = wp_create_nonce("wobt_like_nonce");
$l = admin_url('admin-ajax.php?action=wobt_post_like&post_id='. get_the_ID() .'&nonce='.$nonce);
echo '<div class="wobt-single-post-likes-container">';
echo '<a class="user_like" data-nonce="' . $nonce . '" data-post_id="' . get_the_ID() . '" href="' . $l . '">';
    echo    '<span class="icon is-medium wobt-icon like"><span class="mdi mdi-thumb-up-outline mdi-24px"></span> </span>';
    echo '</a>';
    /* $txt = is_page() ? wobt_get_text('single_this_page') : wobt_get_text('single_this_post'); */
    /* echo '<span class="wobt-single-post-likes">' . $txt . '</span>'; */
    echo '</div>';
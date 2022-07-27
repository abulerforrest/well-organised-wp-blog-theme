<?php
/*
 * functions.php - wobt backbone
 *
 */
require_once(dirname(__FILE__) .'/globals.php');
require_once(dirname(__FILE__) .'/text-domain.php');

// call actions, filters, hooks
add_theme_support( 'post-thumbnails' );
add_action( 'wp_enqueue_scripts', 'wobt_assets' );
add_action( 'add_meta_boxes', 'wobt_add_custom_box' );
add_action( 'save_post', 'wobt_save_post_function', 10, 3 );
add_action( 'comment_post', 'wobt_show_message_function', 10, 3 );
// allow for non logged in users as well with nopriv*
add_action( 'wp_ajax_wobt_post_like', 'wobt_add_post_like', 10, 3 );
add_action( 'wp_ajax_nopriv_wobt_post_like', 'wobt_add_post_like', 10, 3 );
// allow for non logged in users as well with nopriv*
add_action( 'wp_ajax_wobt_comment_like', 'wobt_add_comment_like', 10, 3 );
add_action( 'wp_ajax_nopriv_wobt_comment_like', 'wobt_add_comment_like', 10, 3 );
add_action( 'init', 'wobt_register_menus' );
add_filter( 'comment_reply_link', 'wobt_comment_reply_link' );

// backbone
function wobt_assets() {
    // css
    wp_register_style( 'wobt-bulma','https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css' );
    wp_enqueue_style( 'wobt-bulma' );
    wp_register_style( 'wobt-bulma-tooltip','https://cdnjs.cloudflare.com/ajax/libs/bulma-tooltip/1.2.0/bulma-tooltip.min.css' );
    wp_enqueue_style( 'wobt-bulma-tooltip' );
    wp_register_style( 'wobt-material-design-icons','https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css' );
    wp_enqueue_style( 'wobt-material-design-icons' );
    wp_register_style( 'wobt-css',get_template_directory_uri() . '/assets/css/wobt-theme.min.css' );
    wp_enqueue_style( 'wobt-css' );
    // js
    wp_register_script( 'wobt-js-scripts', get_template_directory_uri() . '/assets/js/wobt-scripts.min.js', array( 'jquery' ) , __FILE__  );
    wp_enqueue_script( 'wobt-js-scripts' );
}

/* register menus */
function wobt_register_menus() {
    register_nav_menus(
        array(
            'wobt-main-menu' => __( wobt_get_text('menu_label_main') ),
            'wobt-footer-menu' => __( wobt_get_text('menu_label_footer') ),
        )
    );
}

/* WOBT add custom settings meta box */
function wobt_add_custom_box() {
    $screens = [ 'page' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'wobt_box_id',
            wobt_get_text('admin_page_settings_label'),
            'wobt_custom_box_html',
            $screen
        );
    }
}
/* WOBT custom meta box html */
function wobt_custom_box_html() {
    $saved_value = get_post_meta( get_the_ID(), 'wobt_page_bg', true );

    if (empty($saved_value)) {
       $saved_value = WOBT_MAIN_BG_COLOR;
    }

    echo wobt_get_text('admin_page_bg_color') . " <input type='color' class='input' id='wobt-page-bgcolor' name='wobt-page-bgcolor' value='$saved_value' />";
}
/* update post meta on save */
function wobt_save_post_function( $post_id, $post_object, $update ) {
    // *currently only for "pages" not regular posts
    if ( is_admin() && $post_object->post_type === 'page' ) {
        update_post_meta(
                $post_id, 'wobt_page_bg', $_POST['wobt-page-bgcolor'] ?? ''
        );
    }
}

// callback for parsing comment
function wobt_comment($comment, $args, $depth) {
    $avatar_url = get_avatar_url($comment->comment_author_email);
    $is_comment_reply = $depth > 1;

    echo $is_comment_reply ? '<div class="wobt-is-reply-label wobt-comment-depth-' . $depth . '"><span class="tag">' . wobt_get_text('comments_reply_label') . '</span></div>' : '';
    echo '<div class="wobt-comment-wrapper wobt-comment-depth-' . $depth . '">';
    echo '
            <div class="wobt-comment-avatar-container">
                <figure class="image is-48x48">
                <a href="' . $comment->comment_author_url .'" target="_blank">
                    <img class="is-rounded" src="' . $avatar_url . '" alt="author-avatar">
                    </a>
                </figure>
            </div>
            <div class="wobt-comment-bubble-wrapper">
                <div class="wobt-comment-bubble-container">
                    <div class="wobt-comment-status-container">';
                        $by = $is_comment_reply ? ' ' . wobt_get_text('comments_replied') . ':' : ' ' . wobt_get_text('comments_commented') . ':';
        ?>
        <?php printf(__('<div>@<cite class="fn">%s</cite><span class="wobt-said">' .  $by  .  '</span></div>'), get_comment_author_link()); ?>
        <div>
            <?php printf(__('%1$s at %2$s'), get_comment_date(),get_comment_time()) ?><?php edit_comment_link(__('(Edit)'),'  ','') ?>
        </div>
        <?php
        if ($comment->comment_approved == '0') {
            echo '<em>' . wobt_get_text('comments_awaiting_moderation') . '</em>';
        }
        echo '</div>
            <div>
                '. $comment->comment_content .'
            </div>
        </div>';
    if ($args['max_depth'] != $depth) {
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);

        if (isset($queries["nonce"]) && wp_verify_nonce($queries["nonce"], 'wobt_comment_nonce') === 1) {
            if (isset($queries["msg"]) && $queries["msg"] === "you-have-already-liked" && isset($queries["comment_id"]) && $queries["comment_id"] === $comment->comment_ID) {
                echo '
            <div class="box">
                ' . wobt_get_text('comments_already_liked') . '
            </div>
            ';
            } else if (isset($queries["msg"]) && $queries["msg"] === "comment-like-success" && isset($queries["comment_id"]) && $queries["comment_id"] === $comment->comment_ID) {
                echo '
            <div class="box">
                ' . wobt_get_text('comments_like_thanks') . '
            </div>';
            }
        }
        $comment_likes = get_comment_meta($comment->comment_ID, 'wobt_comment_likes_count') ? get_comment_meta($comment->comment_ID, 'wobt_comment_likes_count')[0]['likes'] : 0;
        $nonce = wp_create_nonce("wobt_comment_nonce");
        $l = admin_url('admin-ajax.php?action=wobt_comment_like&comment_id='. $comment->comment_ID .'&nonce='.$nonce);
        echo '<div class="wobt-comment-reply-container" id="wobt-comment-' . $comment->comment_ID . '">';
        echo comment_reply_link(array_merge($args, array("depth" => $depth, "max_depth" => $args["max_depth"])));
        echo '<a data-nonce="' . $nonce . '" data-comment_id="' . $comment->comment_ID . '" href="' . $l . '">';
        echo    '<span class="icon is-medium wobt-icon like"><span class="mdi mdi-thumb-up-outline mdi-24px"></span> </span>';
        echo '</a>';
        echo '<span class="wobt-single-post-likes">(' . $comment_likes . ')</span>';
        echo '</div>';
    }
    echo '</div></div>';
}

// custom comment reply link
function wobt_comment_reply_link( $class ) {
    $class = str_replace( "class='comment-reply-link", "class='button wobt-comment-reply-button", $class );
    return $class;
}

// show message box after submitting comment
function wobt_show_message_function( $comment_ID, $comment_approved, $commentdata ) {
    $nonce = wp_create_nonce("wobt_comment_reply_nonce");
    $comment_post_id = $commentdata['comment_post_ID'];
    if ( 1 === $comment_approved ) {
        echo wp_redirect(  get_permalink( $comment_post_id )  . '?msg=thank-you-for-submitting&nonce=' . $nonce . '#comments' );
    } else {
        echo wp_redirect(  get_permalink( $comment_post_id )  . '?msg=thank-you-for-submitting-awaiting&nonce=' . $nonce . '#comments' );
    }
}

// handle add post like
function wobt_add_post_like() {
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    $url  = wp_get_referer();
    $post_id = url_to_postid( $url );

    if (isset($queries["nonce"]) && wp_verify_nonce($queries["nonce"], 'wobt_like_nonce') === 1) {
        $post_likes = get_post_meta($post_id, 'wobt_post_likes') ? get_post_meta($post_id, 'wobt_post_likes') : array();
        $has_liked = false;
        $total_likes_count = 0;
        foreach ($post_likes as $k => $like) {
            $total_likes_count = $k;
            if ( $like['ip'] === $_SERVER['REMOTE_ADDR'] ) {
                $has_liked = true;
            }
        }
        if (!$has_liked) {
            add_post_meta($post_id, 'wobt_post_likes', array(
                'ip' => $_SERVER['REMOTE_ADDR']
            ));
            update_post_meta($post_id, 'wobt_post_likes_count', array(
                'likes' => $total_likes_count + 1,
            ));
            wp_redirect(get_permalink($post_id) . '?msg=like-success&post_id=' . $post_id . '&nonce=' . $queries["nonce"]);
            die();
        }
        wp_redirect(get_permalink($post_id) . '?msg=you-have-already-liked&post_id=' . $post_id . '&nonce=' . $queries["nonce"]);
    }
    die();
}

// handle add comment like
function wobt_add_comment_like() {
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    $url  = wp_get_referer();
    $post_id = url_to_postid( $url );
    $comment_id = $queries['comment_id'];

    if (isset($queries["nonce"]) && wp_verify_nonce($queries["nonce"], 'wobt_comment_nonce') === 1) {
        $comment_likes = get_comment_meta($comment_id, 'wobt_comment_likes') ? get_comment_meta($comment_id, 'wobt_comment_likes') : array();
        $has_liked = false;
        $total_likes_count = 0;
        foreach ($comment_likes as $k => $like) {
            $total_likes_count = $k;
            if ( $like['ip'] === $_SERVER['REMOTE_ADDR'] ) {
                $has_liked = true;
            }
        }
        if (!$has_liked) {
            add_comment_meta($comment_id, 'wobt_comment_likes', array(
                'ip' => $_SERVER['REMOTE_ADDR']
            ));
            update_comment_meta($comment_id, 'wobt_comment_likes_count', array(
                'likes' => $total_likes_count + 1,
            ));
            wp_redirect(get_permalink($post_id) . '?msg=comment-like-success&nonce=' . $queries["nonce"] . '&comment_id=' . $comment_id . '#wobt-comment-' . $comment_id);
            die();
        }
        wp_redirect(get_permalink($post_id) . '?msg=you-have-already-liked&comment_id=' . $comment_id . '&nonce=' . $queries["nonce"] . '#wobt-comment-' . $comment_id);
    }
    die();
}

// custom excerpt
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    return preg_replace('`[[^]]*]`','',$excerpt);
}
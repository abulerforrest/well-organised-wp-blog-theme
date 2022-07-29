<?php
/**
 * Displays the post header
 *
 * @package Well Organised WP Blog Theme
 */

$current_user = wp_get_current_user();
?>
<?php the_title( '<h1 class="title wobt-title">', '</h1>' ); ?>

<?php if ( !is_page() ) : ?>
    <div class="entry-meta">
        <?php
        /* currently disabled
        if ((user_can( $current_user, 'administrator' )) && is_user_logged_in()) { */ ?>
        <?php
        /*
            // Edit post link.
            edit_post_link(
                sprintf(
                    wp_kses(
                        wobt_get_text('single_edit_post'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<button class="button is-info wobt-button"><span class="icon is-small" style="color: #fff;"><i class="mdi mdi-pencil-outline mdi-18px"></i></span>',
                '</button>'
            );
        }
        */
        ?>
    </div><!-- .entry-meta -->
<?php endif; ?>
<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */

get_header();
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="wobt-single-post-wrapper single-post">
            <?php
            // Fetch modal code for previewing single thumbnail
            get_template_part( 'wobt-template-parts/content/content-modal', 'modal' );
            // Start the Loop.
            while ( have_posts() ) :
                get_template_part( 'wobt-template-parts/content/content-single', 'thumbnail' );
                get_template_part('wobt-template-parts/header/entry', 'single-status');
                the_post();
                get_template_part( 'wobt-template-parts/content/content', 'single' );

                get_template_part('wobt-template-parts/content/content', 'single-metrics');

                echo '<hr>';

                if ( is_singular( 'attachment' ) ) {
                    // Parent post navigation.
                    the_post_navigation(
                        array(
                            /* translators: %s: Parent post link. */
                            'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'wellorganisedwpblogtheme' ), '%title' ),
                        )
                    );
                } elseif ( is_singular( 'post' ) ) {
                    // Previous/next post navigation.
                    the_post_navigation(
                        array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . wobt_get_text('single_next_post') . ' &#62;</span> ' .
                                '<span class="screen-reader-text">' . wobt_get_text('single_next_post') . ':</span> <br/>' .
                                '<div class="wobt-post-navigation-container"><span class="post-title title wobt-title">%title</span><i class="mdi mdi-chevron-right mdi-48px"></i></div>',
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">&#60; ' . wobt_get_text('single_prev_post') . '</span> ' .
                                '<span class="screen-reader-text">' . wobt_get_text('single_prev_post') . ':</span> <br/>' .
                                '<div class="wobt-post-navigation-container"><i class="mdi mdi-chevron-left mdi-48px"></i><span class="post-title title wobt-title">%title</span></div>',
                        )
                    );
                }
                get_template_part( 'wobt-template-parts/content/content', 'comments-form' );
                ?>
                <div id="comments">
                    <?php get_template_part( 'wobt-template-parts/content/content', 'single-comments' ); ?>
                </div>
                <?php
            endwhile; // End the loop.
            ?>
                <div class="wobt-read-more-link">
                    <a href="<?php get_site_url(); ?>/" alt="<?php echo wobt_get_text('single_go_back'); ?>" title="<?php echo wobt_get_text('single_go_back'); ?>">
                            <span class="icon is-small">
                                <i class="mdi mdi-arrow-left-thin mdi-18px"></i>
                            </span>
                        <?php echo wobt_get_text('single_go_back2'); ?>
                    </a>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();

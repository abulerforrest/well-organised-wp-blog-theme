<?php
/**
 * The template for a page (Essentially similar to the same as a single page)
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

                    /* TODO: perhaps add some additional content to the page */

                    // Comments if enabled for page
                    get_template_part( 'wobt-template-parts/content/content', 'comments-form' );
                    ?>
                    <div id="comments">
                        <?php get_template_part( 'wobt-template-parts/content/content', 'single-comments' ); ?>
                    </div>
                    <div class="wobt-read-more-link">
                        <a href="<?php get_site_url(); ?>/" alt="<?php echo wobt_get_text('single_go_back'); ?>" title="<?php echo wobt_get_text('single_go_back'); ?>">
                            <span class="icon is-small">
                                <i class="mdi mdi-arrow-left-thin mdi-18px"></i>
                            </span>
                            <?php echo wobt_get_text('single_go_back'); ?>
                        </a>
                    </div>
                <?php
                endwhile; // End the loop.
                ?>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();

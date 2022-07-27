<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being _old_style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */
require_once(dirname(__FILE__) .'/globals.php');
get_header();
?>
<div id="primary" class="wobt-content-area">
    <main id="wobt-main" class="wobt-site-main">
        <div class="columns is-multiline">
            <?php
            $i = 1;
            global $wp_query;
            $found_posts = $wp_query->found_posts ?? 0;
            if ( have_posts() ) {
                // Load posts loop.
                while ( have_posts() ) {
                    the_post();
                    $c = '';
                    if ($i <= 2) {
                        $c = 'is-half';
                    } else if ($i <= 5) {
                        $c = 'is-one-third';
                    }
                    else {
                        $c = 'is-one-quarter';
                    }
                    if ($found_posts === 1) {
                        $c = 'is-full';
                    }

            ?><div class="column <?php echo $c; ?>">
                <div class="wobt-single-post-wrapper">
                    <figure class="image">
                        <a href="<?php the_permalink(); ?>">
                          <?php get_template_part( 'wobt-template-parts/content/content-single', 'thumbnail' ); ?>
                        </a>
                    </figure>
                    <header class="entry-header">
                        <?php get_template_part( 'wobt-template-parts/header/entry', 'list-status' ); ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php get_template_part( 'wobt-template-parts/header/entry', 'header' ); ?>
                        </a>
                    </header>
                    <div class="wobt-body wobt-excerpt">
                        <?php echo excerpt(40); ?>
                    </div>
                    <div class="wobt-read-more-link">
                        <a href="<?php the_permalink(); ?>">
                            <?php echo wobt_get_text('single_read_more'); ?>
                            <span class="icon is-small">
                                <i class="mdi mdi-arrow-right-thin mdi-18px"></i>
                            </span>
                        </a>
                    </div>
                    <?php echo get_template_part('wobt-template-parts/content/content', 'single-metrics'); ?>
                </div>
            </div>
            <?php
                    $i++;
                }
            } else { // No posts
                get_template_part( 'wobt-template-parts/content/content', 'none' );
            }
            ?>
        </div>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */

get_header();
?>
<div id="primary" class="content-area error-404">
    <main id="main" class="wobt-site-main">
        <div class="not-found wobt-404-content">
            <div class="error-404-heading">404</div>
                 <div class="box" style="box-shadow: none; background: none; padding: 0;">
                    <header class="page-header">
                        <?php echo wobt_get_text('search_whoops'); ?>
                    </header><!-- .page-header -->
                     <?php echo wobt_get_text('search_not_found'); ?>
            </div><!-- .page-content -->
        </div><!-- .error-404 -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();

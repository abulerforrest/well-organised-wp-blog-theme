<?php
/**
 * Template part for displaying a single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */
?>
<div class='wobt-body'>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php get_template_part( 'wobt-template-parts/header/entry', 'header' ); ?>
        </header>
        <div class="entry-content content">
            <?php
            the_content(
                get_the_title()
            );
            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'wellorganisedwpblogtheme' ),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">

        </footer><!-- .entry-footer -->

        <?php if ( ! is_singular( 'attachment' ) ) : ?>
            <?php get_template_part( 'wobt-template-parts/post/author', 'bio' ); ?>
        <?php endif; ?>

    </article><!-- #post-<?php the_ID(); ?> -->
</div>
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Well Organised WP Blog Theme
 */

?>

</div><!-- #content -->
<footer id="colophon" class="wobt-footer">
    <?php get_template_part( 'wobt-template-parts/footer/footer', 'widgets' ); ?>
        <div class="wobt-footer-horizontal-menu-container">
            <span>
                <?php $blog_info = get_bloginfo( 'name' ); ?>
                <?php if ( ! empty( $blog_info ) ) : ?>
                    <a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                <?php endif; ?>
            </span>
            <span>|</span>
            <?php if ( has_nav_menu( 'wobt-footer-menu' ) ) : ?>
            <span>
                <nav class="wobt-footer-horizontal-menu" aria-label="<?php esc_attr_e( wobt_get_text('menu_label_footer'), 'wellorganisedwpblogtheme' ); ?>">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'wobt-footer-menu',
                        'depth'          => 1
                    )
                );
                ?>
                </nav><!-- .footer-navigation -->
            </span>
            <?php endif; ?>
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
    </body>
</html>
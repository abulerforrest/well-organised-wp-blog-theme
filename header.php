<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Well Organised WP Blog Theme
 */
require_once(dirname(__FILE__) .'/text-domain.php');

$template_dir = get_template_directory_uri();
$menus =  wp_get_nav_menus(array(
    'taxonomy'   => 'nav_menu',
    'hide_empty' => false,
    'orderby'    => 'name',
));
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <?php wp_head(); ?>
    <title>Well Organised by Emilia Forrest</title>
</head>

<div class="wobt-header">
    <a href="<?php get_site_url(); ?>/">
        <figure class="image wobt-header-img">
            <object data="<?php echo $template_dir; ?>/assets/svg/wo-header-img.svg" width="338" height="64"> </object>
        </figure>
    </a>
</div>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wobt-main" class="wobt-main-wrapper" <?php echo !empty(get_post_meta(get_the_ID(), 'wobt_page_bg')) ? 'style="background: ' . get_post_meta(get_the_ID(), 'wobt_page_bg')[0] . ';"' : ''; ?>>
    <div class="wobt-top-section">
        <div class="wobt-menu-search-row">
            <div class="wobt-menu-search-button-label" id="wobt-menu-search-button-label">
                <?php echo wobt_get_text('header_search'); ?><span class="icon is-small"><i id="wobt-menu-search-icon" class="mdi mdi-magnify mdi-24px"></i></span>
            </div>
            <div id="wobt-search-input-form-wrapper">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="wobt-menu-dropdown-section">
            <div class="wobt-menu-dropdown-wrapper">
            <div class="wobt-menu-dropdown-button-label" id="wobt-menu-dropdown-button-label">
                <?php echo wobt_get_text('header_menu'); ?><span class="icon is-small"><i id="wobt-menu-dropdown-icon" class="mdi mdi-chevron-down mdi-24px"></i></span>
            </div>
            <div class="wobt-dropdown-menu">
                <ul>
                    <?php echo wp_nav_menu( array(
                            'theme_location' => 'wobt-main-menu',
                            'depth'          => 4,
                    ) ); ?>
                </ul>
            </div>

            </div>
        </div>
    </div>

        <div class="wobt-divider-wrapper">
            <div class="wobt-horizontal-divider"></div>
        </div>

    <div id="wobt-content" class="wobt-site-content container">
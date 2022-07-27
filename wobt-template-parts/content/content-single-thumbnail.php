<?php
/**
 * Template part for displaying the single post thumbnail
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */

if (has_post_thumbnail()) : ?>
<div class='wobt-thumbnail-launch' data-target='wobt-modal'>
    <figure class="image is-2by1">
        <?php echo get_the_post_thumbnail(); ?>
    </figure>
</div>
<?php else : ?>
    <figure class="wobt-image-placeholder image is-4by3"></figure>
<?php endif;
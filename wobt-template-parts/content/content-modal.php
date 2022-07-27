<?php
/**
 * The template for the image thumbnail modal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */

?>
<div id="wobt-modal" class="modal">
    <div class="modal-background"></div>

    <div class="modal-content">
        <figure class="image is-4by3">
            <?php echo get_the_post_thumbnail(); ?>
        </figure>
    </div>
    <button class="modal-close is-large" aria-label="close"></button>
</div>
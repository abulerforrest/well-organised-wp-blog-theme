<?php
/**
 * Template part for listing comments for a single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */

    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }

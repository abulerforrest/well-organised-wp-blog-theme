<?php
/**
 * The template part for displaying Author info
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Well Organised WP Blog Theme
 */

// only show author if it's a post
if (is_page()) return;
if ( (bool) get_the_author_meta( 'description' ) ) : ?>
    <div class="container is-max-widescreen wobt-author-container">
        <div class="notification">
            <table class="table">
                <tbody>
                    <tr>
                        <th>
                            <figure class="image is-96x96">
                                <img class="is-rounded wobt-soft-fade-in" src="<?php echo get_avatar_url(get_current_user_id()); ?>">
                            </figure>
                        </th>
                        <td>
                            <div class="wobt-author-bio">
                                <h2 class="wobt-author-title">
                                <span class="wobt-author-heading">
                                    <?php
                                    printf(
                                        wobt_get_text('single_published_by'),
                                        esc_html( get_the_author() )
                                    );
                                    ?>
                                </span>
                                </h2>
                                <p class="wobt-author-description">
                                    <?php the_author_meta( 'description' ); ?>
                                </p><!-- .author-description -->
                                <div class="wobt-read-more-link">
                                    <a class="wobt-author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                        <?php echo wobt_get_text('single_read_more_posts'); ?>
                                        <span class="icon is-small">
                                            <i class="mdi mdi-arrow-right-thin mdi-18px"></i>
                                        </span>
                                    </a>
                                </div>
                            </div><!-- .author-bio -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
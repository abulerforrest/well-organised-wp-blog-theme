<?php
/**
 * Displays the post status (list)
 *
 * @package Well Organised WP Blog Theme
 */
?>

<div class="wobt-single-status-container">
    <span><?php echo get_the_date(); ?></span>
    <span class="wobt-status-divider">&#47;</span>
    <div class="dual">
        <span>
            <?php echo wobt_get_text('single_under'); ?>:
        </span>
         <span>
            <?php
            $categories = get_the_category(get_the_ID());
            foreach( $categories as $category) {
                  $name = $category->name;
                  $category_link = get_category_link( $category->term_id );
                  echo "<li class='wobt-cat-item wobt-cat-item-" . $category->cat_ID . "'>";
                  echo "<a href='$category_link'>$name</a></li>";
                }
            ?>
        </span>
    </div>
    <span class="wobt-status-divider">&#47;</span>
    <div class="dual">
        <span>
            <?php echo wobt_get_text('single_with') . ':';
            $comments_text = get_comments_number() == 1 ? wobt_get_text('single_comment') : wobt_get_text('single_comments');
            ?>
        </span>
        <span>(<?php echo get_comments_number() . ' ' . $comments_text; ?>)</span>
    </div>
</div>
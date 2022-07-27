<?php // Search Query not found
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

$search_query = '';

if (isset($queries["s"]) && $queries["s"] !== '') {
    $search_query = $queries["s"];
}

if ($search_query !== '') {
?>
<div class="wobt-not-found-container">
    <div class="box">
        <p>
            <?php echo wobt_get_text('content_not_found'); ?>
            "<i><?php echo $search_query; ?></i>"
        </p>
    </div>
</div>
<?php
}
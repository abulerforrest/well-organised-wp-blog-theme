<?php
/* wobt - custom search form */
?>
<form role="search" method="get" id="wobt-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="input-group mb-3">
    <div class="wobt-search-input-wrapper columns is-multiline">
        <div class="column">
            <div class="wobt-search-tooltip has-tooltip-active has-tooltip-bottom">
                <div class="wobt-input-group">
                    <input type="search" class="form-control border-0 input is-info wobt-search-input" placeholder="<?php echo wobt_get_text('header_search'); ?>" aria-label="search" name="s" id="wobt-search-input" value="<?php echo esc_attr( get_search_query() ); ?>">
                    <div class="input-group-append">
         <span class="input-group-append p-0">
          <i class="fas fa-search text-muted"></i>
         </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
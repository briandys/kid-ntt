<?php
/**
 * Snippet Entry
 */
function ntt__kid_ntt__tag__snippet_entry() {
    ?>
    <article id="ntt--entry--<?php the_id(); ?>" <?php post_class(); ?> data-name="Entry">
        <?php
        ntt__tag__entry_categories();
        ntt__tag__entry_heading();
        ntt__tag__entry_actions();
        ntt__tag__entry_excerpt_content();
        ntt__tag__entry_banner();
        ?>
    </article>
<?php
}
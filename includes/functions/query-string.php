<?php
/**
 * Add Query String in URL
 */
function ntt__kid_ntt__index_query() {

    global $wp_query;
    $search = ( is_search() && $wp_query->found_posts >= 1 );

    if ( is_home() || is_archive() || $search ) {
        return '?ref=index';
    }
}
add_filter( 'ntt__wp_filter__entry_heading_query', 'ntt__kid_ntt__index_query' );
add_filter( 'ntt__wp_filter__manual_excerpt__search_excerpt_query', 'ntt__kid_ntt__index_query' );
add_filter( 'ntt__wp_filter__view_entry_details_action_query', 'ntt__kid_ntt__index_query' );
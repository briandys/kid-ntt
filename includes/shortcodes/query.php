<?php

function ntt__kid_ntt__wp_shortcode__query( $atts ) {
    
    $atts = array_change_key_case( ( array ) $atts, CASE_LOWER );
 
    // Shortcode Attributes
    $clean_atts = extract( shortcode_atts( array(
        'tag'               => null,
        'tag_heading'       => null,
        'items_per_page'    => 1,
    ), $atts ) );
    
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    
    $args = array(
        'tag'                   => $tag,
        'tag_heading'           => $tag_heading,
        'posts_per_page'        => $items_per_page,
        'paged'                 => $paged,
    );

    $query = new WP_Query( $args );
    $old_query = $GLOBALS['wp_query'];
    $posts = query_posts( $args );
    
    ob_start();
    
    if ( ( $tag !== null ) && have_posts() ) {
        
        $mu = '';
        $mu .= ntt__tag__entry_tag_heading( $tag_heading );

        while ( have_posts() ) {
            
            the_post();
            
            $mu .= ntt__kid_ntt__tag__snippet_entry();
        }
        
        $mu .= ntt__tag__entries_custom_nav( $query->max_num_pages );
        
        $GLOBALS['wp_query'] = $old_query; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        wp_reset_postdata();
    } else {
        $mu = ntt__kid_ntt__tag__content_none();
    }

    $mu = ob_get_clean();

    return $mu;
}

function ntt__kid_ntt__wp_shortcode__query__initialization() {
    add_shortcode( 'ntt_query', 'ntt__kid_ntt__wp_shortcode__query' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__query__initialization' );
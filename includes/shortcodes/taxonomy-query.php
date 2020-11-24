<?php

function ntt__kid_ntt__wp_shortcode__taxonomy_query( $atts ) {
    
    $atts = array_change_key_case( ( array ) $atts, CASE_LOWER );
 
    // Shortcode Attributes
    $clean_atts = extract( shortcode_atts( array(
        'category'              => '',
        'category_heading'      => null,
        'tag'                   => '',
        'tag_heading'           => null,
        'relation'              => null,
        'posts_per_page'        => 1,
        'ignore_sticky_posts'   => 1,
    ), $atts ) );
    
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    
    // Category AND Tag Arguments
    $taxonomy_args = array(
        'category_name'  => $category,
        'tag'            => $tag,
    );
    
    // Category OR Tag Arguments
    if ( $relation === 'or' ) {
        $taxonomy_args = array(
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category,
                ),
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'slug',
                    'terms' => $tag,
                ),
            ),
        );
    }

    // Default Arguments
    $default_args = array(
        'category_heading'      => $category_heading,
        'tag_heading'           => $tag_heading,
        'posts_per_page'        => $posts_per_page,
        'ignore_sticky_posts'   => $ignore_sticky_posts,
        'paged'                 => $paged,
    );
    
    $args = array_merge( $default_args, $taxonomy_args );

    $query = new WP_Query( $args );
    $old_query = $GLOBALS['wp_query'];
    $posts = query_posts( $args );
    
    ob_start();
    
    if ( ( $category !== null || $tag !== null ) && have_posts() ) {

        $entry_category_heading = ntt__tag__entry_category_heading( $category_heading );
        $entry_tag_heading = ntt__tag__entry_tag_heading( $tag_heading );
        
        if ( $category_heading !== '' && $entry_category_heading ) {
            $heading = $entry_category_heading;
        } else if ( $tag_heading !== '' && $entry_tag_heading ) {
            $heading = $entry_tag_heading;
        } else {
            $heading = '';
        }
        
        $mu = '';
        $mu .= $heading;

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

function ntt__kid_ntt__wp_shortcode__taxonomy_query__initialization() {
    add_shortcode( 'ntt_taxonomy_query', 'ntt__kid_ntt__wp_shortcode__taxonomy_query' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__taxonomy_query__initialization' );
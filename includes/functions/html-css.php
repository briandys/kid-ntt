<?php
/**
 * HTML CSS
 */

function ntt_kid_html_css( $classes ) {

    /**
     * Entity Name
     * Ex. If site name is "NTT," CSS class name is "ntt--entity--ntt".
     */
    
    $classes[] = 'ntt--entity--'. sanitize_title( get_bloginfo( 'name' ) );
    
    if ( is_singular() ) {
        global $post;

        /**
         * Entry Type View
         * Ex. If entry type is "post," CSS class name is "ntt--post-view".
         */
    
        $classes[] = 'ntt--'. $post->post_type. '-view';
    }

    /**
     * Compact Search
     */
    $classes[] = 'ntt--search--compact';
    
    /**
     * First Page View
     * For multiple pages
     */
    if ( ! is_paged() ) {
        $classes[] = 'ntt--first-page-view';
    } else {
        $classes[] = 'ntt--subsequent-page-view';
    }

    /**
     * Current User Types
     */
    if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
        $classes[] = 'ntt--current-user--admin';
    }

    /**
     * Entity Name Ability Status
     */
    if ( get_bloginfo( 'name', 'display' ) && get_header_textcolor() !== 'blank' ) {
        $classes[] = 'ntt--entity-name---1';
    } else {
        $classes[] = 'ntt--entity-name---0';
    }

    /**
     * Entity Description Ability Status
     */
    if ( get_bloginfo( 'description', 'display' ) && get_header_textcolor() !== 'blank' ) {
        $classes[] = 'ntt--entity-description--1';
    } else {
        $classes[] = 'ntt--entity-description--0';
    }

    return $classes;
}
add_filter( 'ntt_html_css_wp_filter', 'ntt_kid_html_css' );
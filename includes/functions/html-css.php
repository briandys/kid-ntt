<?php
/**
 * HTML CSS
 */
function ntt_kid_html_css( $classes ) {

    /**
     * Entity Name
     */
    $classes[] = 'entity--'. sanitize_title( get_bloginfo( 'name' ) );
    
    if ( is_singular() ) {
        global $post;

        /**
         * Entry Type View
         */
        $classes[] = $post->post_type. '-view';
    }

    /**
     * Compact Search
     */
    $classes[] = 'ntt--search--compact';
    
    /**
     * First Page
     */
    if ( ! is_paged() ) {
        $classes[] = 'first-page-view';
    } else {
        $classes[] = 'subsequent-page-view';
    }

    /**
     * Current User Types
     */
    if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
        $classes[] = 'current-user--admin';
    }

    /**
     * Entity Primary Name Ability Status
     */
    if ( get_bloginfo( 'name', 'display' ) && get_header_textcolor() !== 'blank' ) {
        $classes[] = 'entity-primary-name--1';
    } else {
        $classes[] = 'entity-primary-name--0';
    }

    /**
     * Entity Primary Description Ability Status
     */
    if ( get_bloginfo( 'description', 'display' ) && get_header_textcolor() !== 'blank' ) {
        $classes[] = 'entity-primary-description--1';
    } else {
        $classes[] = 'entity-primary-description--0';
    }

    return $classes;
}
add_filter( 'ntt_html_css_wp_filter', 'ntt_kid_html_css' );
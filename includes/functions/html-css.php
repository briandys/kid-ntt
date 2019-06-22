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
    
    /**
     * Page Position
     */

    if ( ! is_paged() ) {
        $classes[] = 'ntt--first-page';
    } else {
        $classes[] = 'ntt--subsequent-page';
    }

    /**
     * User Types
     */

    if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
        $classes[] = 'ntt--admin-user';
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
        $classes[] = 'ntt--entity-description---1';
    } else {
        $classes[] = 'ntt--entity-description---0';
    }

    /**
     * Feature: Compact Search
     */
    
    $classes[] = 'ntt--search---compact';

    return $classes;
}
add_filter( 'ntt_html_css_filter', 'ntt_kid_html_css' );
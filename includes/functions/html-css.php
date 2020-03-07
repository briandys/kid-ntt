<?php
/**
 * HTML CSS
 */

function ntt__kid_ntt__function__view__css( $classes ) {

    /**
     * Entity Name
     * Ex. If site name is "NTT," CSS class name is "ntt--entity--ntt".
     */
    
    $classes[] = 'ntt--entity--'. sanitize_title( get_bloginfo( 'name' ) );
    
    /**
     * Page Position
     */

    if ( ! is_paged() ) {
        $classes[] = 'ntt--page---first';
    } else {
        $classes[] = 'ntt--page---subsequent';
    }

    /**
     * User Types
     */

    if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
        $classes[] = 'ntt--user---admin';
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

    return $classes;
}
add_filter( 'ntt_html_css_filter', 'ntt__kid_ntt__function__view__css' );
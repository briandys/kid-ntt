<?php
/**
 * Snaps HTML CSS
 */

function ntt_kid_snaps_html_css( $classes ) {

    $r_snaps = ntt_get_snaps();

    if ( $r_snaps === false ) {
        return array();
    }

    foreach ( $r_snaps as $key => $value ) {
        if ( get_theme_mod( 'ntt_kid_settings_snaps' ) == $key ) {
            $classes[] = 'ntt--'. sanitize_title( $GLOBALS['ntt_child_theme_name'] ). '--'. basename( $value );
        }
    }

    return $classes;
}

/**
 * Snaps Directory
 */

$r_snaps = ntt_get_snaps();

if ( $r_snaps === false ) {
    return array();
}

foreach ( $r_snaps as $key => $value ) {

    if ( get_theme_mod( 'ntt_kid_settings_snaps' ) > 0 ) {

        if ( get_theme_mod( 'ntt_kid_settings_snaps' ) == $key ) {
            
            require( get_stylesheet_directory(). '/includes/snaps/'. basename( $value ). '/functions.php' );
            
            add_filter( 'ntt_html_css_wp_filter', function( $classes ) {
                return ntt_kid_snaps_html_css( $classes );
            } );
        }
    }
}
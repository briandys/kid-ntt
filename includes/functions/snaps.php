<?php
/**
 * Snaps
 */

/**
 * Get Snaps
 */

function ntt_get_snaps() {
    
    $snaps = array();
    $r_snaps = array_filter( glob( get_stylesheet_directory(). '/includes/snaps/*' ), 'is_dir' );

    if ( $r_snaps === false ) {
        return array();
    }

    $snaps[] = esc_html( 'ntt' );
    $snaps[] = esc_html( 'kid-ntt' );

    foreach ( $r_snaps as $snap ) {
        $snaps[] = esc_html( basename( $snap ) );
    }

    return $snaps;
}
add_action( 'wp_head', 'ntt_get_snaps' );

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

    // NTT
    if ( get_theme_mod( 'ntt_kid_settings_snaps' ) == 0 ) {
        
        add_action( 'wp_enqueue_scripts', function() {
            wp_dequeue_style( 'ntt-kid-style' );
            wp_dequeue_script( 'ntt-kid-script' );
        }, 100 );

    // Kid NTT
    } elseif ( get_theme_mod( 'ntt_kid_settings_snaps' ) == 1 ) {
        
        return;
    
    // Snaps
    } elseif ( get_theme_mod( 'ntt_kid_settings_snaps' ) > 1 ) {

        if ( get_theme_mod( 'ntt_kid_settings_snaps' ) == $key ) {
            
            require( get_stylesheet_directory(). '/includes/snaps/'. basename( $value ). '/functions.php' );
            
            add_filter( 'ntt_html_css_filter', function( $classes ) {
                return ntt_kid_snaps_html_css( $classes );
            } );
        }
    }
}
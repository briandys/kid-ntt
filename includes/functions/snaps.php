<?php
/**
 * Snaps
 */

/**
 * Get Snaps
 */
function ntt__kid_ntt__snaps() {
    
    $snaps = array();
    $r_snaps = array_filter( glob( get_stylesheet_directory(). '/includes/snaps/*' ), 'is_dir' );

    if ( $r_snaps === false ) {
        return array();
    }

    $snaps[] = esc_html( 'kid-ntt' ); // Default
    $snaps[] = esc_html( 'ntt' );

    foreach ( $r_snaps as $snap ) {
        $snaps[] = esc_html( basename( $snap ) );
    }

    return $snaps;
}
add_action( 'wp_head', 'ntt__kid_ntt__snaps' );

/**
 * View CSS
 */
function ntt__kid_ntt__snaps_view__css( $classes ) {

    $r_snaps = ntt__kid_ntt__snaps();

    if ( $r_snaps === false ) {
        return array();
    }

    foreach ( $r_snaps as $key => $value ) {
        if ( get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__snaps' ) == $key ) {
            $classes[] = 'ntt--'. sanitize_title( $GLOBALS['ntt__gvar__child_theme__name'] ). '--snaps--'. basename( $value );
        }
    }

    return $classes;
}

/**
 * Snaps Directory
 */
$r_snaps = ntt__kid_ntt__snaps();

if ( $r_snaps === false ) {
    return array();
}

// Kid NTT
if ( get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__snaps' ) == 0 ) {
    return;

// NTT
} elseif ( get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__snaps' ) == 1 ) {
    
    add_action( 'wp_enqueue_scripts', function() {
        wp_dequeue_style( 'ntt-kid-style' );
        wp_dequeue_script( 'ntt-kid-script' );
    }, 11 );

// Snaps
} elseif ( get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__snaps' ) > 1 ) {

    foreach ( $r_snaps as $key => $value ) {

        if ( get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__snaps' ) == $key ) {
        
            if ( file_exists( require( get_stylesheet_directory(). '/includes/snaps/'. basename( $value ). '/functions.php' ) ) ) {
                require( get_stylesheet_directory(). '/includes/snaps/'. basename( $value ). '/functions.php' );
            }
            
            add_filter( 'ntt__wp_filter__view_css', function( $classes ) {
                return ntt__kid_ntt__snaps_view__css( $classes );
            } );
        }
    }
}
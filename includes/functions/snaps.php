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
if ( get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__snaps' ) === 'kid-ntt' ) {
    return;

// NTT
} elseif ( get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__snaps' ) === 'ntt' ) {
    
    add_action( 'wp_enqueue_scripts', function() {
        wp_dequeue_style( 'ntt-kid-style' );
        wp_dequeue_script( 'ntt-kid-script' );
    }, 11 );

// Snaps
} else {

    foreach ( $r_snaps as $snap ) {

        if ( get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__snaps' ) === $snap ) {
        
            $functions_file = get_stylesheet_directory(). '/includes/snaps/'. basename( $snap ). '/functions.php';
            
            if ( file_exists( $functions_file ) ) {
                require( $functions_file );
            }
            
            add_filter( 'ntt__wp_filter__view_css', function( $classes ) {
                return ntt__kid_ntt__snaps_view__css( $classes );
            } );
        }
    }
}

/**
 * Snaps Feature Settings
 * Check if a Snap has a feature set
 */
function ntt__kid_ntt__snaps__features() {

    $settings = array();

    if ( function_exists( 'ntt__kid_ntt__snaps__info' ) ) {

        $features = ntt__kid_ntt__snaps__info()['features'];
        
        if ( $features ) {
            $settings = $features;
        }
    }
    
    return $settings;
}
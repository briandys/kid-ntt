<?php
/**
 * Feature: Screenshot
 * Adds a button to save screenshot of the page.
 * https://html2canvas.hertzen.com
 */
$GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__prefixed_name'] = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__name'];
$GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__version'] = '1.0.0';

/**
 * NTT Feature Validation
 */
function ntt__kid_ntt__feature__screenshot__validation() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_feature', true );
    $theme_mod = get_theme_mod( 'ntt_settings_features' );

    $ntt_f5e_array = array(
        $GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__prefixed_name'],
    );

    if ( strpos_array( $post_meta, $ntt_f5e_array ) || strpos_array( $theme_mod, $ntt_f5e_array ) ) {
        return true;
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__feature__screenshot__styles_scripts() {

    $name = $GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__name'];
    $prefixed_name = $GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__prefixed_name'];
    $version = $GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__version'];
    $theme_version = wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__feature__screenshot__validation() ) {

        wp_enqueue_style( $prefixed_name. '--style', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/style.min.css', array( 'ntt-kid-style' ), $version. '-'. $theme_version );

        wp_enqueue_script( $prefixed_name. '--library-script', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/html2canvas.min.js', array(), $version. '-'. $theme_version, true );

        wp_enqueue_script( $prefixed_name. '--script', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/main.js', array( $prefixed_name. '--library-script' ), $version. '-'. $theme_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__feature__screenshot__styles_scripts', 0 );

// View CSS
function ntt__kid_ntt__feature__screenshot__view__css( $classes ) {
    
    if ( is_singular() && ntt__kid_ntt__feature__screenshot__validation() ) {
        $classes[] = esc_attr( $GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__prefixed_name'] );
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__feature__screenshot__view__css' );

// Entry CSS
function ntt__kid_ntt__feature__screenshot__entry__css( $classes ) {
    
    if ( is_singular() && ntt__kid_ntt__feature__screenshot__validation() ) {
        $classes[] = esc_attr( $GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__prefixed_name']. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__feature__screenshot__entry__css' );
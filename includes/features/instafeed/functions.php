<?php
/**
 * InstaFeed
 * .ntt--f5e--instafeed
 * Display personal Instagram feed
 * http://instafeedjs.com/
 */
$GLOBALS['ntt_kid_f5e_instafeed_css_name'] = 'ntt--f5e--'. $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'];
$GLOBALS['ntt_kid_f5e_instafeed_enqueue_slug'] = 'ntt-kid-f5e--'. $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'];

$GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__prefixed_name'] = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'];
$GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__version'] = '1.0.0';

/**
 * NTT Feature Validation
 */
function ntt__kid_ntt__feature__instafeed__validation() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_features', true );
    $theme_mod = get_theme_mod( 'ntt__wp_customizer__settings__features' );

    $ntt_f5e_array = array(
        $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__prefixed_name'],
    );

    if ( strpos_array( $post_meta, $ntt_f5e_array ) || strpos_array( $theme_mod, $ntt_f5e_array ) ) {
        return true;
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__feature__instafeed__styles_scripts() {

    $name = $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'];
    $prefixed_name = $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__prefixed_name'];
    $version = $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__version'];
    $theme_version = wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__feature__instafeed__validation() ) {

        wp_enqueue_style( $prefixed_name. '--style', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/style.min.css', array( 'ntt-kid-style' ), $version. '-'. $theme_version );

        wp_enqueue_script( $prefixed_name. '--library-script', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/instafeed.min.js', array(), $version. '-'. $theme_version, true );

        wp_enqueue_script( $prefixed_name. '--script', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/main.js', array( $prefixed_name. '--library-script' ), $version. '-'. $theme_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__feature__instafeed__styles_scripts', 0 );

// View CSS
function ntt__kid_ntt__feature__instafeed__view__css( $classes ) {
    
    if ( ntt__kid_ntt__feature__instafeed__validation() ) {
        $classes[] = esc_attr( $GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__prefixed_name'] );
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__feature__instafeed__view__css' );

// Entry CSS
function ntt__kid_ntt__feature__instafeed__entry__css( $classes ) {
    
    if ( is_singular() && ntt__kid_ntt__feature__instafeed__validation() ) {
        $classes[] = esc_attr( $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__prefixed_name']. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__feature__instafeed__entry__css' );
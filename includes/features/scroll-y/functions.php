<?php
/**
 * Scroll Y
 * Adds data attributes to HTML element to track scrolling in the Y-axis, both in pixels and percentage.
 */

$GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__prefixed_name'] = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__name'];
$GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__version'] = '1.0.0';

/**
 * NTT Feature Validation
 * Checks if the feature is in Custom Fields or Customizer > NTT Settings
 */
function ntt__kid_ntt__feature__scroll_y__validation() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_feature', true );
    $theme_mod = get_theme_mod( 'ntt_settings_features' );

    $ntt_f5e_array = array(
        $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__prefixed_name'],
    );

    if ( strpos_array( $post_meta, $ntt_f5e_array ) || strpos_array( $theme_mod, $ntt_f5e_array ) ) {
        return true;
    }
}

/**
 * NTT Feature Validation
 * Checks if the feature is in Custom Fields or Customizer > NTT Settings
 */
function ntt__kid_ntt__feature__scroll_y__snaps_settings_validation() {
    $snaps_feature_settings = join( ' ', ntt__kid_ntt__snaps__feature_settings() );

    $ntt_f5e_array = array(
        $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__name'],
    );

    if ( strpos_array( $snaps_feature_settings, $ntt_f5e_array ) ) {
        return true;
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__feature__scroll_y__styles_scripts() {

    $name = $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__name'];
    $prefixed_name = $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__prefixed_name'];
    $version = $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__version'];
    $theme_version = wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__feature__scroll_y__validation() || ntt__kid_ntt__feature__scroll_y__snaps_settings_validation() ) {

        wp_enqueue_script( $prefixed_name. '--script', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/main.js', array(), $version. '-'. $theme_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__feature__scroll_y__styles_scripts', 0 );

// View CSS
function ntt__kid_ntt__feature__scroll_y__view__css( $classes ) {
    
    if ( ( is_singular() && ntt__kid_ntt__feature__scroll_y__validation() ) || ntt__kid_ntt__feature__scroll_y__snaps_settings_validation() ) {
        $classes[] = esc_attr( $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__prefixed_name'] );
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__feature__scroll_y__view__css' );

// Entry CSS
function ntt__kid_ntt__feature__scroll_y__entry__css( $classes ) {
    
    if ( is_singular() && ntt__kid_ntt__feature__scroll_y__validation() ) {
        $classes[] = esc_attr( $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__prefixed_name']. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__feature__scroll_y__entry__css' );
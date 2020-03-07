<?php
/**
 * Scroll Y
 * .ntt--f5e--scroll-y
 * Adds data attributes to HTML element to track scrolling in the Y-axis, both in pixels and percentage.
 */
$GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__sanitized_name'] = $GLOBALS['ntt__gvar__kid_ntt__feature__sanitized_name_prefix']. $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__slug'];
$GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__version'] = '1.0.0';

/**
 * NTT Feature Validation
 * Checks if the feature is in Custom Fields
 */
function ntt__kid_ntt__feature__scroll_y__validation() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_feature', true );
    $theme_mod = get_theme_mod( 'ntt_settings_features' );

    $ntt_f5e_array = array(
        $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__sanitized_name'],
    );

    if ( strpos_array( $post_meta, $ntt_f5e_array ) || strpos_array( $theme_mod, $ntt_f5e_array ) ) {
        return true;
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__feature__scroll_y__styles_scripts() {

    $name = $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__sanitized_name'];
    $slug = $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__slug'];
    $version = $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__version'];
    $theme_version = wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__feature__scroll_y__validation() ) {

        wp_enqueue_style( $name. '--style', get_stylesheet_directory_uri(). '/includes/features/'. $slug. '/style.min.css', array( 'ntt-kid-style' ), $version. '-'. $theme_version );

        wp_enqueue_script( $name. '--script', get_stylesheet_directory_uri(). '/includes/features/'. $slug. '/main.js', array(), $version. '-'. $theme_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__feature__scroll_y__styles_scripts', 0 );
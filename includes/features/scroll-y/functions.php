<?php
/**
 * Scroll Y
 * .ntt--f5e--scroll-y
 * Adds data attributes to HTML element to track scrolling in the Y-axis, both in pixels and percentage.
 */
$GLOBALS['ntt_kid_f5e_scroll_y_css_name'] = 'ntt--f5e--'. $GLOBALS['ntt_kid_f5e_scroll_y_slug'];
$GLOBALS['ntt_kid_f5e_scroll_y_enqueue_slug'] = 'ntt-kid-f5e--'. $GLOBALS['ntt_kid_f5e_scroll_y_slug'];

/**
 * NTT Feature Validation
 * Checks if the feature is in Custom Fields
 */
function ntt_kid_f5e_scroll_y() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_feature', true );
    $theme_mod = get_theme_mod( 'ntt_settings_features' );

    $ntt_f5e_array = array(
        $GLOBALS['ntt_kid_f5e_scroll_y_css_name'],
    );

    if ( strpos_array( $post_meta, $ntt_f5e_array ) || strpos_array( $theme_mod, $ntt_f5e_array ) ) {
        return true;
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt_kid_f5e_scroll_y_styles_scripts() {

    if ( ntt_kid_f5e_scroll_y() ) {

        wp_enqueue_style( $GLOBALS['ntt_kid_f5e_scroll_y_enqueue_slug']. '-style', get_stylesheet_directory_uri(). '/includes/features/'. $GLOBALS['ntt_kid_f5e_scroll_y_slug']. '/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );

        wp_enqueue_script( $GLOBALS['ntt_kid_f5e_scroll_y_enqueue_slug']. '-script', get_stylesheet_directory_uri(). '/includes/features/'. $GLOBALS['ntt_kid_f5e_scroll_y_slug']. '/main.js', array(), wp_get_theme()->get( 'Version' ), true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt_kid_f5e_scroll_y_styles_scripts', 0 );
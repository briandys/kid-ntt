<?php
/**
 * Functions
 */
$r_funcs = array(
    'fonts',
);

foreach ( $r_funcs as $func ) {
    require( get_stylesheet_directory(). '/includes/functions/'. $func. '.php' );
}

/**
 * Styles, Scripts
 */
function a_stormy_sky_ntt_styles_scripts() {

    $ntt_snaps_name = 'A Stormy Sky';
    $ntt_snaps_name = sanitize_title( $ntt_snaps_name );
    
    wp_enqueue_style( $ntt_snaps_name. '-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/'. $ntt_snaps_name. '/assets/styles/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'a_stormy_sky_ntt_styles_scripts', 0 );

/**
 * Font Families
 */
function a_stormy_sky_ntt_font_families( $font_families ) {
    
    $font_families[] = 'Hind|Open+Sans+Condensed:700';
    
    return $font_families;
}
add_filter( 'ntt_kid_custom_fonts_wp_filter', 'a_stormy_sky_ntt_font_families' );

function ntt_kid_cm_datetime_month_wp_filter() {
    return 'M';
}
add_filter( 'ntt_cm_datetime_month_wp_filter', 'ntt_kid_cm_datetime_month_wp_filter' );

/**
 * HTML CSS
 */
function a_stormy_sky_ntt_html_css( $classes ) {

    $classes[] = 'ntt--entry-datetime--boxy';

    return $classes;
}
add_filter( 'ntt_html_css_wp_filter', 'a_stormy_sky_ntt_html_css' );
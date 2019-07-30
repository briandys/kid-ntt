<?php
/**
 * Functions
 */

$GLOBALS['ntt_snaps_name'] = 'Flea Bargain';
$GLOBALS['ntt_snaps_name_slug'] = sanitize_title( $GLOBALS['ntt_snaps_name'] );

/**
 * Kid NTT Functions
 */

$r_functions = array(
    'fonts',
);

foreach ( $r_functions as $function ) {
    require( get_stylesheet_directory(). '/includes/functions/'. $function. '.php' );
}

/**
 * Styles, Scripts
 */
function mr_universe_ntt_styles_scripts() {

    wp_enqueue_style( $GLOBALS['ntt_snaps_name_slug']. '-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/styles/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'mr_universe_ntt_styles_scripts', 0 );

/**
 * Font Families
 */

add_filter( 'kid_ntt_custom_fonts_filter', function( $font_families ) {
    $font_families[] = 'Hind|Open+Sans+Condensed:700';
    return $font_families;
} );

/**
 * DateTime - Month Format
 */

add_filter( 'ntt_cm_datetime_month_filter', function() {
    return 'M';
} );

/**
 * HTML CSS
 */

add_filter( 'ntt_html_css_filter', function( $classes ) {
    $classes[] = 'ntt--entry-datetime--boxy';
    return $classes;
} );
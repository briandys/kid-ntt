<?php
/**
 * Functions
 */

$GLOBALS['ntt_snaps_name'] = 'Brian Dys';
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

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( $GLOBALS['ntt_snaps_name_slug']. '-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/styles/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );
}, 0 );

/**
 * Font Families
 */

add_filter( 'ntt__kid_ntt__wp_filter__custom_fonts', function( $font_families ) {
    $font_families[] = 'Montserrat:400,800|Work+Sans:400,700&display=swap';
    return $font_families;
} );

/**
 * DateTime - Month Format
 */

add_filter( 'ntt__wp_filter__cm_datetime_month', function() {
    return 'M';
} );

/**
 * HTML CSS
 */

add_filter( 'ntt__wp_filter__view_css', function( $classes ) {
    $classes[] = 'ntt--entry-datetime--boxy';
    return $classes;
} );
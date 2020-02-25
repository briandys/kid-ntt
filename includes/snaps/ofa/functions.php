<?php

$GLOBALS['ntt_snaps_name'] = 'OFA';
$GLOBALS['ntt_snaps_name_slug'] = sanitize_title( $GLOBALS['ntt_snaps_name'] );

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
function ofa_ntt_styles_scripts() {

    wp_enqueue_style( $GLOBALS['ntt_snaps_name_slug']. '-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/styles/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );

    //wp_enqueue_script( $GLOBALS['ntt_snaps_name_slug']. '-ntt-instafeed-script', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/scripts/instafeed.min.js', array( 'ntt-script' ), wp_get_theme()->get( 'Version' ), true );

    wp_enqueue_script( $GLOBALS['ntt_snaps_name_slug']. '-ntt-script', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/scripts/main.js', array( $GLOBALS['ntt_snaps_name_slug']. '-ntt-instafeed-script' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'ofa_ntt_styles_scripts', 0 );

/**
 * Font Families
 */
function ofa_ntt_font_families( $font_families ) {
    
    $font_families[] = 'Playfair+Display:400,700|Work+Sans:400,600&display=swap';
    
    return $font_families;
}
add_filter( 'kid_ntt_custom_fonts_filter', 'ofa_ntt_font_families' );

/**
 * Entry Banner Visuals Featured Image Size
 */
function ofa_ntt_entry_banner_visuals_featured_image_size() {

    if ( is_singular() ) {
        $featured_image_size = 'ntt-large';
    } else {
        $featured_image_size = 'ntt-large';
    }

    return $featured_image_size;
}
add_filter( 'ntt_entry_banner_visuals_featured_image_size_filter', 'ofa_ntt_entry_banner_visuals_featured_image_size' );

function ofa_ntt_cm_datetime_month_filter() {
    return 'M';
}
add_filter( 'ntt_cm_datetime_month_filter', 'ofa_ntt_cm_datetime_month_filter' );
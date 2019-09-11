<?php

$GLOBALS['ntt_snaps_name'] = 'Elevate Everyday Living';
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
function eel_ntt_styles_scripts() {

    wp_enqueue_style( 'eel-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/elevate-everyday-living/assets/styles/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );

    wp_enqueue_script( $GLOBALS['ntt_snaps_name_slug']. '-ntt-instafeed-script', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/scripts/instafeed.min.js', array( 'ntt-script' ), wp_get_theme()->get( 'Version' ), true );

    wp_enqueue_script( $GLOBALS['ntt_snaps_name_slug']. '-ntt-script', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/scripts/main.js', array( $GLOBALS['ntt_snaps_name_slug']. '-ntt-instafeed-script' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'eel_ntt_styles_scripts', 0 );

/**
 * Font Families
 */
function eel_ntt_font_families( $font_families ) {
    
    $font_families[] = 'Playfair+Display:400,700|Work+Sans:400,600&display=swap';
    
    return $font_families;
}
add_filter( 'kid_ntt_custom_fonts_filter', 'eel_ntt_font_families' );

/** 
 * Insert Elements After Entry Name
 */
function eel_ntt_before_entry_name() {
    ntt_entry_categories();
    ntt_entry_breadcrumbs_nav();
}
add_action( 'ntt_before_entry_name_wp_hook', 'eel_ntt_before_entry_name' );

/**
 * Entry Banner Visuals Featured Image Size
 */
function eel_ntt_entry_banner_visuals_featured_image_size() {

    if ( is_singular() ) {
        $featured_image_size = 'ntt-large';
    } else {
        $featured_image_size = 'ntt-large';
    }

    return $featured_image_size;
}
add_filter( 'ntt_entry_banner_visuals_featured_image_size_filter', 'eel_ntt_entry_banner_visuals_featured_image_size' );

function eel_ntt_cm_datetime_month_filter() {
    return 'M';
}
add_filter( 'ntt_cm_datetime_month_filter', 'eel_ntt_cm_datetime_month_filter' );

/**
 * HTML CSS
 */
function eel_ntt_html_css( $classes ) {

    $classes[] = 'ntt--entry-datetime--boxy';

    return $classes;
}
add_filter( 'ntt_html_css_filter', 'eel_ntt_html_css' );
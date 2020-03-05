<?php

$GLOBALS['ntt_snaps_name'] = 'MGB';
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
function mgb_ntt_styles_scripts() {

    wp_enqueue_style( $GLOBALS['ntt_snaps_name_slug']. '-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/styles/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );

    wp_enqueue_script( $GLOBALS['ntt_snaps_name_slug']. '-ntt-instafeed-script', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/scripts/instafeed.min.js', array( 'ntt-script' ), wp_get_theme()->get( 'Version' ), true );

    wp_enqueue_script( $GLOBALS['ntt_snaps_name_slug']. '-ntt-script', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/scripts/main.js', array( $GLOBALS['ntt_snaps_name_slug']. '-ntt-instafeed-script' ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'mgb_ntt_styles_scripts', 0 );

/**
 * Font Families
 */
function mgb_ntt_font_families( $font_families ) {
    
    $font_families[] = 'Open+Sans:400,600,700|Sanchez&display=swap';
    
    return $font_families;
}
add_filter( 'kid_ntt_custom_fonts_filter', 'mgb_ntt_font_families' );

/** 
 * Insert Elements After Entry Name
 */
function mgb_ntt_before_entry_name() {
    ntt__tag__entry_categories();
    ntt__tag__entry_breadcrumbs_nav();
}
add_action( 'ntt__wp_hook__entry_name___before', 'mgb_ntt_before_entry_name' );

/**
 * Entry Banner Visuals Featured Image Size
 */
function mgb_ntt_entry_banner_visuals_featured_image_size() {

    if ( is_singular() ) {
        $featured_image_size = 'ntt-large';
    } else {
        $featured_image_size = 'ntt-large';
    }

    return $featured_image_size;
}
add_filter( 'ntt_entry_banner_visuals_featured_image_size_filter', 'mgb_ntt_entry_banner_visuals_featured_image_size' );

function mgb_ntt_cm_datetime_month_filter() {
    return 'M';
}
add_filter( 'ntt_cm_datetime_month_filter', 'mgb_ntt_cm_datetime_month_filter' );

/**
 * HTML CSS
 */
function mgb_ntt_html_css( $classes ) {

    // $classes[] = 'ntt--entry-datetime--boxy';

    return $classes;
}
add_filter( 'ntt_html_css_filter', 'mgb_ntt_html_css' );
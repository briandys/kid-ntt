<?php

$GLOBALS['ntt_snaps_name'] = 'OFA';
$GLOBALS['ntt_snaps_name_slug'] = sanitize_title( $GLOBALS['ntt_snaps_name'] );
$GLOBALS['ntt__gvar__kid_ntt__snaps__version'] = '1.0.9';

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
function ntt__kid_ntt__snaps__ofa_ntt__function__styles_scripts() {

    wp_enqueue_style( $GLOBALS['ntt_snaps_name_slug']. '-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/styles/style.min.css', array( 'ntt-kid-style' ), $GLOBALS['ntt__gvar__kid_ntt__snaps__version']. '-'. wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__snaps__ofa_ntt__function__styles_scripts', 0 );

/**
 * Font Families
 */
function ntt__kid_ntt__snaps__ofa_ntt__function__custom_fonts( $font_families ) {
    
    $font_families[] = 'Spartan:400,800|Playfair+Display:400,700&display=swap';
    
    return $font_families;
}
add_filter( 'kid_ntt_custom_fonts_filter', 'ntt__kid_ntt__snaps__ofa_ntt__function__custom_fonts' );

add_filter( 'ntt_entry_author_label_filter', function() {
    return __( 'By', 'ntt' );
} );

function ntt__tag__entry_header__structure() {

    ntt__tag__entry_categories();
    ntt__tag__entry_breadcrumbs_nav();
    ntt__tag__entry_heading();
    ntt__tag__entry_actions();
    ntt__tag__entry_banner();
    ntt__tag__entry_primary_meta();
    ntt__tag__comments_actions_snippet();
    
    if ( ( ( is_singular() || is_home() || is_archive() ) && has_excerpt() ) || is_search() ) {
        ntt__tag__entry_secondary_meta__structure();
    }
}

function ntt__tag__entry_primary_meta__structure() {

    ntt__tag__entry_datetime(); 
    ntt__tag__entry_author();  
}
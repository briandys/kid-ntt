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
function ntt__kid_ntt__snaps__ofa_ntt__function__styles_scripts() {

    wp_enqueue_style( $GLOBALS['ntt_snaps_name_slug']. '-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/styles/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );
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
    return 'By';
} );
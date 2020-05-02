<?php

function ntt__kid_ntt__snaps__info() {
    
    $name = 'OFA';

    $info = array(
        'name'      => $name,
        'slug'      => sanitize_title( $name ),
        'version'   => '1.1.1',
    );
    
    return $info;
}

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

    $info = ntt__kid_ntt__snaps__info();

    wp_enqueue_style( $info['slug']. '-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/'. $info['slug']. '/assets/styles/style.min.css', array( 'ntt-style', 'ntt-kid-style' ), $info['version']. '-'. wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__snaps__ofa_ntt__function__styles_scripts', 0 );

/**
 * Font Families
 */
function ntt__kid_ntt__snaps__ofa_ntt__function__custom_fonts( $font_families ) {
    
    $font_families[] = 'Spartan:400,800|Playfair+Display:400,700&display=swap';
    
    return $font_families;
}
add_filter( 'ntt__kid_ntt__wp_filter__custom_fonts', 'ntt__kid_ntt__snaps__ofa_ntt__function__custom_fonts' );

add_filter( 'ntt__wp_filter__entry_author_label', function() {
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
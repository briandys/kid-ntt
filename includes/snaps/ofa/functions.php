<?php
/**
 * Snaps Info
 */
if ( ! function_exists( 'ntt__kid_ntt__snaps__info' ) ) {
    function ntt__kid_ntt__snaps__info() {
    
        $name = 'OFA';
    
        $info = array(
            'name'      => $name,
            'slug'      => sanitize_title( $name ),
            'version'   => '1.1.1',
            'features'  => array(),
        );
        
        return $info;
    }
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
function ntt__kid_ntt__snaps__styles_scripts() {

    $snap = ntt__kid_ntt__snaps__info();
    $slug = $snap['slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__snap__name_prefix']. $slug;    
    $main_style_id = $prefixed_slug. '--style';
    $path = get_stylesheet_directory_uri(). '/includes/snaps/'. $slug. '/assets';
    $version = $snap['version']. '-'. wp_get_theme()->get( 'Version' );

    wp_enqueue_style( $main_style_id, $path. '/styles/main.min.css', array( 'ntt-style', 'ntt-kid-style' ), $version );
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__snaps__styles_scripts', 0 );

/**
 * Font Families
 */
function ntt__kid_ntt__snaps__ofa_ntt__function__custom_fonts( $font_families ) {
    
    $font_families[] = 'Spartan:400,800|Playfair+Display:400,700&display=swap';
    
    return $font_families;
}
add_filter( 'ntt__kid_ntt__wp_filter__custom_fonts', 'ntt__kid_ntt__snaps__ofa_ntt__function__custom_fonts' );

/**
 * Entry Author Label
 */
add_filter( 'ntt__wp_filter__entry_author_label', function() {
    return __( 'By', 'ntt' );
} );

/**
 * Modifying Entry Header Structure
 */
function ntt__tag__entry_header__structure() {

    ntt__tag__entry_categories();
    ntt__tag__entry_breadcrumbs_nav();
    ntt__tag__entry_heading();
    ntt__tag__entry_actions();
    ntt__tag__entry_banner();
    ntt__tag__entry_primary_meta();
    ntt__tag__comments_actions_snippet();
    
    if ( ( ( is_singular() || is_home() || is_archive() ) && has_excerpt() ) || is_search() ) {
        ntt__tag__entry_excerpt_content();
    }
}

/**
 * Modifying Entry Primary Meta Structure
 */
function ntt__tag__entry_primary_meta__structure() {

    ntt__tag__entry_datetime(); 
    ntt__tag__entry_author();  
}
<?php
/**
 * Functions
 * 
 * List of Features Dumped in Mr. Universe NTT Child Theme
 * 
 * Functions Page - a page that displays all categories under the same name "functions"
 * Open Graph - to share entries to Facebook properly
 * Prezo Mode - uses WordPress Custom Fields to activate a CSS class name in HTML
 */

$GLOBALS['ntt_snaps_name'] = 'Mr. Universe';
$GLOBALS['ntt_snaps_name_slug'] = sanitize_title( $GLOBALS['ntt_snaps_name'] );

/**
 * NTT Kid Functions
 */

$r_functions = array(
    //'fonts',
);

foreach ( $r_functions as $function ) {
    require( get_stylesheet_directory(). '/includes/functions/'. $function. '.php' );
}

/**
 * Snap Functions
 */

$r_snap_functions = array(
    'functions-page',
    //'open-graph',
    'html-canvas-mode',
    'prezo-mode',
    'widgets',
);

foreach ( $r_snap_functions as $function ) {
    require( get_stylesheet_directory(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/includes/'. $function. '.php' );
}

/**
 * Styles, Scripts
 */
function mr_universe_ntt_styles_scripts() {

    wp_enqueue_style( $GLOBALS['ntt_snaps_name_slug']. '-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/styles/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );

    wp_enqueue_script( $GLOBALS['ntt_snaps_name_slug']. '-ntt-script', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/scripts/main.js', array( 'jquery', 'ntt-script', ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'mr_universe_ntt_styles_scripts', 0 );

/**
 * Font Families
function mr_universe_ntt_font_families( $font_families ) {
    
    $font_families[] = 'Hind|Open+Sans+Condensed:700';
    
    return $font_families;
}
add_filter( 'ntt_kid_custom_fonts_wp_filter', 'mr_universe_ntt_font_families' );
 */

/**
 * DateTime - Month Format
 */

add_filter( 'ntt_cm_datetime_month_wp_filter', function() {
    return 'M';
} );

/**
 * HTML CSS
 */
function mr_universe_ntt_html_css( $classes ) {

    $classes[] = 'ntt--entry-datetime--boxy';

    return $classes;
}
add_filter( 'ntt_html_css_filter', 'mr_universe_ntt_html_css' );

/**
 * Remove Password-Protected Posts Filter
 * 
 * https://aspengrovestudios.com/how-to-customize-password-protected-pages/
 */

function ntt_kid_remove_password_protected_posts_filter( $where = '' ) {

    if ( ! is_single() && ! current_user_can( 'edit_private_posts' ) && ! is_admin() ) {
        $where .= " AND post_password = ''";
    }
 
    return $where;
}
add_filter( 'posts_where', 'ntt_kid_remove_password_protected_posts_filter' );
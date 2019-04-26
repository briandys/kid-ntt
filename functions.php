<?php
/**
 * Child Theme Settings
 */
$GLOBALS['ntt_kid_name'] = 'Neat Bleach NTT';
$GLOBALS['ntt_kid_url'] = 'http://ntt.briandys.com/';

/**
 * Functions
 */
$r_funcs = array(
    'custom-fields',
    'functions-page',
    'entry-css',
    'html-css',
    //'open-graph',
    'prezo-mode',
    'widgets',
    'wp-customizer',
    'wp-shortcodes',
);

foreach ( $r_funcs as $func ) {
    require( get_stylesheet_directory(). '/includes/functions/'. $func. '.php' );
}

/** 
 * Styles, Scripts
 */
function remove_gutenberg_styles() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'remove_gutenberg_styles', 0 );

function ntt_kid_styles_scripts() {

    wp_enqueue_style( 'wp-block-library' );

    wp_enqueue_style( 'ntt-kid-style', get_stylesheet_directory_uri(). '/assets/styles/ntt-kid.min.css', array( 'ntt-style' ), wp_get_theme()->get( 'Version' ) );
    
    wp_enqueue_script( 'ntt-kid-modernizr', get_stylesheet_directory_uri(). '/assets/scripts/modernizr-custom.js', array(), null, true );

    wp_enqueue_script( 'ntt-kid-script', get_stylesheet_directory_uri(). '/assets/scripts/ntt-kid.js', array( 'jquery', 'ntt-script', ), null, true );
}
add_action( 'wp_enqueue_scripts', 'ntt_kid_styles_scripts', 0 );

/**
 * Maker Tag Name
 */
function ntt_kid_entity_maker_tag_theme_name() {
    return $GLOBALS['ntt_kid_name'];
}
add_filter( 'ntt_entity_maker_tag_theme_name_wp_filter', 'ntt_kid_entity_maker_tag_theme_name' );

/**
 * Maker Tag URL
 */
function ntt_kid_entity_maker_tag_theme_url() {
    return $GLOBALS['ntt_kid_url'];
}
add_filter( 'ntt_entity_maker_tag_theme_url_wp_filter', 'ntt_kid_entity_maker_tag_theme_url' );

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

/**
 * Get Snaps
 */
function ntt_get_snaps() {
    
    $snaps = array();
    $r_snaps = array_filter( glob( get_stylesheet_directory(). '/includes/snaps/*' ), 'is_dir' );

    if ( $r_snaps === false ) {
        return array();
    }

    $snaps[] = __( 'default', 'ntt' );

    foreach ( $r_snaps as $snap ) {
        $snaps[] = basename( $snap );
    }

    return $snaps;
}
add_action( 'wp_head', 'ntt_get_snaps' );
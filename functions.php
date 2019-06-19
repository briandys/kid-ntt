<?php
/**
 * Child Theme Settings
 */

$GLOBALS['ntt_child_theme_name'] = 'Kid NTT';
$GLOBALS['ntt_child_theme_url'] = 'http://briandys.com/ntt/';

/**
 * Functions
 */

$r_funcs = array(
    'entry-css',
    'html-css',
    'snaps',
    'widgets',
    'wp-customizer',
    'wp-custom-fields',
    'wp-shortcodes',
);

foreach ( $r_funcs as $func ) {
    require( get_stylesheet_directory(). '/includes/functions/'. $func. '.php' );
}

/** 
 * Styles, Scripts
 */

function ntt_kid_styles_scripts() {

    wp_enqueue_style( 'ntt-kid-style', get_stylesheet_directory_uri(). '/assets/styles/style.min.css', array( 'ntt-style' ), wp_get_theme()->get( 'Version' ) );

    wp_enqueue_script( 'ntt-kid-script', get_stylesheet_directory_uri(). '/assets/scripts/main.js', array( 'jquery', 'ntt-script', ), null, true );
}
add_action( 'wp_enqueue_scripts', 'ntt_kid_styles_scripts', 10 );

/**
 * Maker Tag Name
 */

function ntt_kid_entity_maker_tag_theme_name() {
    return $GLOBALS['ntt_child_theme_name'];
}
add_filter( 'ntt_entity_maker_tag_theme_name_wp_filter', 'ntt_kid_entity_maker_tag_theme_name' );

/**
 * Maker Tag URL
 */

function ntt_kid_entity_maker_tag_theme_url() {
    return $GLOBALS['ntt_child_theme_url'];
}
add_filter( 'ntt_entity_maker_tag_theme_url_wp_filter', 'ntt_kid_entity_maker_tag_theme_url' );

/**
 * Get Snaps
 */

function ntt_get_snaps() {
    
    $snaps = array();
    $r_snaps = array_filter( glob( get_stylesheet_directory(). '/includes/snaps/*' ), 'is_dir' );

    if ( $r_snaps === false ) {
        return array();
    }

    $snaps[] = esc_html( 'default' );

    foreach ( $r_snaps as $snap ) {
        $snaps[] = esc_html( basename( $snap ) );
    }

    return $snaps;
}
add_action( 'wp_head', 'ntt_get_snaps' );
<?php
/**
 * Functions
 */

/**
 * Child Theme Settings
 */

$GLOBALS['ntt_child_theme_name'] = 'Kid NTT';
$GLOBALS['ntt_child_theme_url'] = '//briandys.com/ntt/';

/**
 * Functions
 */

$r_functions = array(
    // Primary
    'styles-scripts',
    // Secondary
    'comments-css',
    'customizer',
    'custom-fields',
    'entry-css',
    'html-css',
    'shortcodes',
    'snaps',
);

foreach ( $r_functions as $function ) {
    require( get_stylesheet_directory(). '/includes/functions/'. $function. '.php' );
}

/**
 * Maker Tag Name
 */
add_filter( 'ntt_entity_maker_tag_theme_name_filter', function() {
    return $GLOBALS['ntt_child_theme_name'];
} );

/**
 * Maker Tag URL
 */

add_filter( 'ntt_entity_maker_tag_theme_url_filter', function() {
    return $GLOBALS['ntt_child_theme_url'];
} );
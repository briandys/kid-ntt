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

function ntt_entry_header_content() {

    ntt_entry_categories();
    ntt_entry_breadcrumbs_nav();
    ntt_entry_heading();
    ntt_entry_actions();
    
    if ( ( ( is_singular() || is_home() || is_archive() ) && has_excerpt() ) || is_search() ) {
        ntt_entry_summary_content();
    }

    ntt_entry_banner();
    ntt_entry_primary_meta();
    ntt_comments_actions_snippet();
}

function ntt_entry_primary_meta_content() {

    ntt_entry_author();
    ntt_entry_datetime();   
}
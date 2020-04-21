<?php

$GLOBALS['ntt_snaps_name'] = 'Hexetidine';
$GLOBALS['ntt_snaps_name_slug'] = sanitize_title( $GLOBALS['ntt_snaps_name'] );
$GLOBALS['ntt__gvar__kid_ntt__snaps__version'] = '0.0.0';

/**
 * Styles, Scripts
 */
function ntt__kid_ntt__snaps__ofa_ntt__function__styles_scripts() {

    wp_enqueue_style( $GLOBALS['ntt_snaps_name_slug']. '-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/styles/style.min.css', array( 'ntt-kid-style' ), $GLOBALS['ntt__gvar__kid_ntt__snaps__version']. '-'. wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__snaps__ofa_ntt__function__styles_scripts', 0 );

/**
 * Add Month
 */
add_action( 'ntt__wp_hook__entity_logo___before', function() {
    echo '<div class="ntt--hexetidine--current-month">'. date('F Y'). '</div>';
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
        ntt__tag__entry_secondary_meta__structure();
    }
}

/**
 * Modifying Entry Primary Meta Structure
 */
function ntt__tag__entry_primary_meta__structure() {

    ntt__tag__entry_datetime(); 
    ntt__tag__entry_author();  
}
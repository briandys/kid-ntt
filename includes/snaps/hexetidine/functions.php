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
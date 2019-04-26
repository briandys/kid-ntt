<?php
/**
 * WP Customizer
 */
function ntt_kid_wp_customizer( $wp_customize ) {

    /**
     * NTT Kid Settings
     */
    $wp_customize->add_setting( 'ntt_kid_settings_snaps', array(
        'default'           => '0',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ) );

    $wp_customize->add_control( 'ntt_kid_settings_snaps', array(
        'label'     => 'Snaps',
        'section'   => 'ntt_settings',
        'type'      => 'select',
        'choices'   => ntt_get_snaps(),
    ) );
}
add_action( 'customize_register', 'ntt_kid_wp_customizer' );

/**
 * Snaps HTML CSS
 */
function ntt_kid_snaps_html_css( $classes ) {

    $r_snaps = ntt_get_snaps();

    if ( $r_snaps === false ) {
        return array();
    }

    foreach ( $r_snaps as $key => $value ) {
        if ( get_theme_mod( 'ntt_kid_settings_snaps' ) == $key ) {
            $classes[] = sanitize_title( $GLOBALS['ntt_kid_name'] ). '--'. basename( $value );
        }
    }

    return $classes;
}

/**
 * Snaps Directory
 */
$r_snaps = ntt_get_snaps();

if ( $r_snaps === false ) {
    return array();
}

foreach ( $r_snaps as $key => $value ) {

    if ( get_theme_mod( 'ntt_kid_settings_snaps' ) > 0 ) {

        if ( get_theme_mod( 'ntt_kid_settings_snaps' ) == $key ) {
            
            require( get_stylesheet_directory(). '/includes/snaps/'. basename( $value ). '/functions.php' );
            
            add_filter( 'ntt_html_css_wp_filter', function( $classes ) {
                return ntt_kid_snaps_html_css( $classes );
            } );
        }
    }
}
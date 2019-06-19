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
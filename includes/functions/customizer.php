<?php
/**
 * WP Customizer
 */
function ntt_kid_wp_customizer( $wp_customize ) {

    /**
     * Kid NTT Settings
     */
    
    $wp_customize->add_setting( 'ntt_kid_settings_snaps', array(
        'default'           => '0',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ) );

    $wp_customize->add_control( 'ntt_kid_settings_snaps', array(
        'label'     => 'Snaps',
        'section'   => 'ntt__wp_theme__settings',
        'type'      => 'select',
        'choices'   => ntt__kid__function__snaps(),
    ) );
}
add_action( 'customize_register', 'ntt_kid_wp_customizer' );
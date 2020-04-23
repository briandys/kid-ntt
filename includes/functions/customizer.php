<?php
/**
 * WP Customizer
 */
function ntt__kid_ntt__wp_customizer( $wp_customize ) {

    /**
     * Kid NTT Settings
     */
    
    $wp_customize->add_setting( 'ntt__kid_ntt__wp_customizer__snaps__settings', array(
        'default'           => '0',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ) );

    $wp_customize->add_control( 'ntt__kid_ntt__wp_customizer__snaps__settings', array(
        'label'     => 'Snaps',
        'section'   => 'ntt__wp_theme',
        'type'      => 'select',
        'choices'   => ntt__kid_ntt__snaps(),
    ) );
}
add_action( 'customize_register', 'ntt__kid_ntt__wp_customizer' );
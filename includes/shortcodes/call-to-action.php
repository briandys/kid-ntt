<?php
/**
 * NTT Call to Action
 *
 * Usage: [ntt_cta "Click me!" href="#" class="button"]
 *
 */
function ntt__kid_ntt__wp_shortcode__call_to_action( $atts ) {

    $atts = array_change_key_case( ( array ) $atts, CASE_LOWER );

    // Shortcode Attributes
    $clean_atts = extract( shortcode_atts( array(
        'class' => 'button',
        'href'  => '#',
    ), $atts ) );

    if ( ! isset( $atts[0] ) ) {
        return;
    } else {
        $content = $atts[0];
    }

    if ( $class === 'button' ) {
        $mu_s = '<div class="ntt--cta-obj ntt--obj">';
        $mu_e = '</div>';
    } else {
        $mu_s = '';
        $mu_e = '';
    }

    $cta = $mu_s. '<a href="'. esc_attr( $href ). '" class="ntt--cta'. ' '. 'ntt--cta-'. esc_attr( $class ).'">'. esc_html( $content ). '</a>'. $mu_e;

    return $cta;
}

function ntt__kid_ntt__wp_shortcode__call_to_action__initialization() {
    add_shortcode( 'ntt_cta', 'ntt__kid_ntt__wp_shortcode__call_to_action' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__call_to_action__initialization' );
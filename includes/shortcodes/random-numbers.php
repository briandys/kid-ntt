<?php
/**
 * Random Numbers
 * 
 * Generates random numbers
 * Defaults at 2 random digits
 * 
 * Usage: [ntt_rand]
 * Setting at 4 digits: [ntt_rand 4]
 */
function ntt__kid_ntt__wp_shortcode__random_number( $atts ) {
    
    if ( ! isset( $atts[0] ) ) {
        $digits = '2';
    } else {
        $digits = $atts[0];
    }
    
    return substr( mt_rand(), 0, $digits );
}

function ntt__kid_ntt__wp_shortcode__random_number__initialization() {
    add_shortcode( 'ntt_rand', 'ntt__kid_ntt__wp_shortcode__random_number' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__random_number__initialization' );
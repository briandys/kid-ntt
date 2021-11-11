<?php
/**
 * NTT Subtitle
 *
 * Usage: [ntt_subtitle]
 *
 */
function ntt__kid_ntt__wp_shortcode__subtitle() {

    $entry_subtitle_post_meta = get_post_meta( get_the_ID(), 'ntt_entry_subtitle', true );

    if ( $entry_subtitle_post_meta ) {
        $entry_subtitle_mu = '<div class="ntt--entry-subtitle ntt--obj" data-name="Entry Subtitle">';
            $entry_subtitle_mu .= '<span class="ntt--txt">'. esc_html( $entry_subtitle_post_meta ). '</span>';
        $entry_subtitle_mu .= '</div>';
    } else {
        $entry_subtitle_mu = '';
    }

    return $entry_subtitle_mu;
}

function ntt__kid_ntt__wp_shortcode__subtitle__initialization() {
    add_shortcode( 'ntt_subtitle', 'ntt__kid_ntt__wp_shortcode__subtitle' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__subtitle__initialization' );
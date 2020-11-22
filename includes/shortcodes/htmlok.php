<?php
// NTT HTML_OK Shortcode
// [ntt_htmlok name="Name"]Content[/ntt_htmlok]
// https://developer.wordpress.org/plugins/shortcodes/shortcodes-with-parameters/#complete-example

function ntt__kid_ntt__wp_shortcode__htmlok( $atts, $content = null, $tag = '' ) {

    $atts = array_change_key_case( ( array ) $atts, CASE_LOWER );
 
    $atts = shortcode_atts( array(
        'name' => $content,
    ), $atts, $tag );
 
    $mu = '<div id="'. sanitize_title( $atts['name'] ). '" class="cp'. ' '. sanitize_title( $atts['name'] ). ' '. 'ntt-html-ok-shortcode'. '" data-name="'. esc_html( $atts['name'] ). ' CP">';
        $mu .= '<div class="cr'. ' '. sanitize_title( $atts['name'] ). '---cr">';
            $mu .= '<div class="h">' . esc_html__( $atts['name'], 'kid-ntt' ). '</div>';
            $mu .= '<div class="ct'. ' '. sanitize_title( $atts['name'] ). '---ct">';

            if ( ! is_null( $content ) ) {
                $mu .= do_shortcode( $content );
            }

            $mu .= '</div>';
        $mu .= '</div>';
    $mu .= '</div>';
 
    return $mu;
}

function ntt__kid_ntt__wp_shortcode__htmlok__initialization() {
    add_shortcode( 'ntt_htmlok', 'ntt__kid_ntt__wp_shortcode__htmlok' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__htmlok__initialization' );
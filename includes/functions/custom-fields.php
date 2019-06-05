<?php
/**
 * HTML CSS Custom Field
 * Key: ntt_cf_html_css
 * 
 * Adds CSS in HTML Tag
 */
function ntt_kid_custom_field_html_css( $classes ) {
    
    $html_css_post_meta = get_post_meta( get_the_ID(), 'ntt_cf_html_css', true );

    if ( $html_css_post_meta !== '' ) {
        $classes[] = esc_attr( $html_css_post_meta );
    }
    return $classes;
}
add_filter( 'ntt_html_css_wp_filter', 'ntt_kid_custom_field_html_css' );

/**
 * Entry Subtitle Custom Field
 * Key: ntt_cf_entry_subtitle
 * 
 * Adds Entry Subtitle
 */
function ntt_kid_custom_field_entry_subtitle() {
    
    $entry_subtitle_post_meta = get_post_meta( get_the_ID(), 'ntt_cf_entry_subtitle', true );

    if ( $entry_subtitle_post_meta !== '' ) {
        $entry_subtitle_mu = '<div class="entry-subtitle obj">';
            $entry_subtitle_mu .= '<span class="txt">'. esc_html( $entry_subtitle_post_meta ). '</span>';
        $entry_subtitle_mu .= '</div>';
    } else {
        $entry_subtitle_mu = '';
    }

    echo $entry_subtitle_mu;
}
add_action( 'ntt_after_entry_name_wp_hook', 'ntt_kid_custom_field_entry_subtitle', 0 );
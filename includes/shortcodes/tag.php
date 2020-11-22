<?php
/**
 * NTT Tag Shortcode
 *
 * Usage: [ntt_tag "[tag]"]
 *
 */
function ntt__kid_ntt__wp_shortcode__tag( $atts ) {
    
    extract( shortcode_atts( array(
        'post_id' => NULL,
    ), $atts ) );
    
    if ( ! isset( $atts[0] ) ) {
        return;
    }
    
    $field = $atts[0];
    $tag = get_term_by( 'slug', $field, 'post_tag' );
    
    if ( $tag ) {
        $tag_id = $tag->term_id;
        $tag_link = get_tag_link( $tag_id );
        
        $tag_display = '<a class="ntt--entry-tag" href="'. $tag_link. '" rel="tag">'. esc_html( $field ). '</a>';
    } else {
        $tag_display = '<span class="ntt--entry-tag---untagged">'. esc_html( $field ). '</span>';
    }
    
    return $tag_display;
}

function ntt__kid_ntt__wp_shortcode__tag__initialization() {
    add_shortcode( 'ntt_tag', 'ntt__kid_ntt__wp_shortcode__tag' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__tag__initialization' );
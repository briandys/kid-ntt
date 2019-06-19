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
 * Entry Subname Custom Field
 * Key: ntt_cf_entry_subname
 * 
 * Adds Entry Subname
 */
function ntt_kid_custom_field_entry_subname() {
    
    $entry_subname_post_meta = get_post_meta( get_the_ID(), 'ntt_cf_entry_subname', true );

    if ( $entry_subname_post_meta !== '' ) {
        $entry_subname_mu = '<div class="entry-subname obj" data-name="Entry Subname">';
            $entry_subname_mu .= '<span class="txt">'. esc_html( $entry_subname_post_meta ). '</span>';
        $entry_subname_mu .= '</div>';
    } else {
        $entry_subname_mu = '';
    }

    echo $entry_subname_mu;
}
add_action( 'ntt_after_entry_name_wp_hook', 'ntt_kid_custom_field_entry_subname', 0 );

/**
 * Entry Feature Return True
 */
function ntt_kid_cf_entry_feature() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_cf_entry_feature', true );
    $post_meta = trim( preg_replace( '/\s+/', '', $post_meta ) );
    
    return $post_meta;
}

// Entry Feature HTML CSS
function ntt_kid_cf_entry_feature_html_css( $classes ) {

    if ( ntt_kid_cf_entry_feature() ) {
        $classes[] = get_post_meta( get_the_ID(), 'ntt_cf_entry_feature', true );
    }

    return $classes;
}
add_filter( 'post_class', 'ntt_kid_cf_entry_feature_html_css' );

// Entry CSS added to HTML
add_filter( 'ntt_html_css_wp_filter', function( $classes ) {
    return ( is_singular() && ntt_kid_cf_entry_feature() ) ? ntt_kid_cf_entry_feature_html_css( $classes ) : $classes;
} );
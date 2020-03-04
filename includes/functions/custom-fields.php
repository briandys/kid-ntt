<?php
/**
 * HTML CSS Custom Field
 * Key: ntt_html_css
 * Adds CSS in HTML Tag.
 */
function ntt_kid_custom_field_html_css( $classes ) {
    
    $html_css_post_meta = get_post_meta( get_the_ID(), 'ntt_html_css', true );

    if ( $html_css_post_meta !== '' ) {
        $classes[] = esc_attr( $html_css_post_meta );
    }
    return $classes;
}
add_filter( 'ntt_html_css_filter', 'ntt_kid_custom_field_html_css' );

/**
 * Feature Custom Field
 * Key: ntt_feature
 * Any value found in custom field named, ntt_feature, will be added as CSS class names in HTML element.
 */
function ntt_kid_html_css__feature( $classes ) {
    
    $html_css_post_meta = get_post_meta( get_the_ID(), 'ntt_feature', true );

    if ( $html_css_post_meta !== '' ) {
        $classes[] = esc_attr( $html_css_post_meta );
    }
    return $classes;
}
add_filter( 'ntt_html_css_filter', 'ntt_kid_html_css__feature' );

/**
 * Entry Subname Custom Field
 * Adds a sub-title under Entry Name
 * Key: ntt_entry_subname
 * 
 * Adds Entry Subname
 */
function ntt_kid_wp_cf_entry_subname() {
    
    $entry_subname_post_meta = get_post_meta( get_the_ID(), 'ntt_entry_subname', true );

    if ( $entry_subname_post_meta !== '' ) {
        $entry_subname_mu = '<div class="ntt--entry-subname ntt--obj" data-name="Entry Subname">';
            $entry_subname_mu .= '<span class="ntt--txt">'. esc_html( $entry_subname_post_meta ). '</span>';
        $entry_subname_mu .= '</div>';
    } else {
        $entry_subname_mu = '';
    }

    echo $entry_subname_mu;
}
add_action( 'ntt__wp_hook__entry_name___after', 'ntt_kid_wp_cf_entry_subname', 0 );

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
add_filter( 'ntt_html_css_filter', function( $classes ) {
    return ( is_singular() && ntt_kid_cf_entry_feature() ) ? ntt_kid_cf_entry_feature_html_css( $classes ) : $classes;
} );
<?php
/**
 * Feature Custom Field
 * Key: ntt_features
 * Any value found in Custom Field named, ntt_features, will be added as CSS class names in HTML element.
 */
function ntt__kid_ntt__wp_custom_field__feature_view__css( $classes ) {
    
    $html_css_post_meta = get_post_meta( get_the_ID(), 'ntt_features', true );

    if ( $html_css_post_meta !== '' ) {
        $classes[] = esc_attr( $html_css_post_meta );
    }
    return $classes;
}
// add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__wp_custom_field__feature_view__css' );

/**
 * HTML CSS Custom Field
 * Key: ntt_html_css
 * Adds CSS in HTML Tag.
 */
function ntt__kid_ntt__wp_custom_field__css( $classes ) {
    
    $html_css_post_meta = get_post_meta( get_the_ID(), 'ntt_html_css', true );

    if ( $html_css_post_meta !== '' ) {
        $classes[] = esc_attr( $html_css_post_meta );
    }
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__wp_custom_field__css' );

/**
 * Entry Subname Custom Field
 * Adds a sub-title under Entry Name
 * Key: ntt_entry_subname
 * 
 * Adds Entry Subname
 */
function ntt__kid_ntt__wp_custom_field__entry_subname() {
    
    $entry_subname_post_meta = get_post_meta( get_the_ID(), 'ntt_entry_subname', true );

    if ( $entry_subname_post_meta ) {
        $entry_subname_mu = '<div class="ntt--entry-subname ntt--obj" data-name="Entry Subname">';
            $entry_subname_mu .= '<span class="ntt--txt">'. esc_html( $entry_subname_post_meta ). '</span>';
        $entry_subname_mu .= '</div>';
    } else {
        $entry_subname_mu = '';
    }

    echo $entry_subname_mu;
}
add_action( 'ntt__wp_hook__entry_name___after', 'ntt__kid_ntt__wp_custom_field__entry_subname', 0 );

/**
 * Entry Feature Return True
 * Is the custom field ntt_cf_entry_feature has value?
 */
function ntt__kid_ntt__wp_custom_field__entry__feature() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_cf_entry_feature', true );
    $post_meta = trim( preg_replace( '/\s+/', '', $post_meta ) );
    
    return $post_meta;
}

// Entry Feature HTML CSS
function ntt__kid_ntt__wp_custom_field__entry__feature__css( $classes ) {

    if ( ntt__kid_ntt__wp_custom_field__entry__feature() ) {
        $classes[] = get_post_meta( get_the_ID(), 'ntt_cf_entry_feature', true );
    }

    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__wp_custom_field__entry__feature__css' );

// Entry CSS added to HTML
add_filter( 'ntt__wp_filter__view_css', function( $classes ) {
    return ( is_singular() && ntt__kid_ntt__wp_custom_field__entry__feature() ) ? ntt__kid_ntt__wp_custom_field__entry__feature__css( $classes ) : $classes;
} );

/**
 * Entry Banner
*/
function ntt__tag__entry_banner() {

    $post_meta = get_post_meta( get_the_ID(), 'ntt_featured_image', true );

    $entry_banner_mu_s = '<div class="ntt--entry-banner ntt--cp" data-name="Entry Banner">';
    $entry_banner_mu_e = '</div>';

    if ( $post_meta ) {
        
        $markup = $entry_banner_mu_s;
            $markup .= '<figure class="ntt--entry-banner-visuals ntt--obj" data-name="Entry Banner Visuals">';
                $markup .= $post_meta;
            $markup .= '</figure>';
        $markup .= $entry_banner_mu_e;
        
        echo $markup;
    
    } else if ( ! $post_meta && get_the_post_thumbnail() !== '' ) {
    
        echo $entry_banner_mu_s;
        ntt__tag__entry_banner_visuals();
        echo $entry_banner_mu_e;
    
    } else {
        return;
    }
}

/**
 * Entry Banner Visuals
*/
function ntt__kid_ntt__wp_custom_field__entry_banner_visuals() {

    $post_meta = get_post_meta( get_the_ID(), 'ntt_featured_image', true );

    if ( $post_meta ) {
        $markup = '<figure class="ntt--entry-banner-visuals ntt--obj" data-name="Entry Banner Visuals">';
            $markup .= $post_meta;
        $markup .= '</figure>';
    } else {
        $markup = '';
    }

    echo $markup;
}
//add_action( 'ntt__wp_hook__entry_banner___after', 'ntt__kid_ntt__wp_custom_field__entry_banner_visuals' );
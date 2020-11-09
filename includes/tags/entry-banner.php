<?php
/**
 * Entry Banner
 * Featured Image via custom fields
 * Key: [ntt_featured_image]
 * Value: HTML <img>
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

        $markup = apply_filters( 'ntt__kid_ntt__wp_filter__entry_banner_visuals', $markup );
        
        echo $markup;
    
    } else if ( ! $post_meta && get_the_post_thumbnail() !== '' ) {
    
        echo $entry_banner_mu_s;
        ntt__tag__entry_banner_visuals();
        echo $entry_banner_mu_e;
    
    } else {
        return;
    }    
}

// Validation
function ntt__kid_ntt__function__entry_banner_visuals__validation() {
    
    if ( get_post_meta( get_the_ID(), 'ntt_featured_image', true ) ) {
        return true;
    } 
}

// CSS
function ntt__kid_ntt__function__entry_banner_visuals__css( $classes ) {

    $post_meta = ntt__kid_ntt__function__entry_banner_visuals__validation();
    $on = 'ntt--entry-banner-visuals---1';
    $off = 'ntt--entry-banner-visuals---0';

    if ( $post_meta || get_the_post_thumbnail() !== '' ) {
        $classes[] = $on;
    } else if ( ! $post_meta || get_the_post_thumbnail() === '' ) {
        $classes[] = $off;
    } else {
        $classes[] = $off;
    }

    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__function__entry_banner_visuals__css' );
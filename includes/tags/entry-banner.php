<?php
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

function ntt__kid_ntt__function__entry_banner__css( $classes ) {

    $post_meta = get_post_meta( get_the_ID(), 'ntt_featured_image', true );

    if ( $post_meta || get_the_post_thumbnail() !== '' ) {
        $classes[] = 'ntt--entry-banner-visuals---1';
    } else if ( ! $post_meta || get_the_post_thumbnail() === '' ) {
        $classes[] = 'ntt--entry-banner-visuals---0';
    } else {
        $classes[] = 'ntt--entry-banner-visuals---0';
    }

    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__function__entry_banner__css' );
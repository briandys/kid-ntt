<?php

/**
 * Entry Banner
 * Priority List of Featured Images
 * 1. Featured Image via custom fields
 * 2. Featured Image via built-in WordPress functionality
 * 3. Featured Image via the first <img> found in content
 * Key: ntt_featured_image
 * Value: HTML <img>
*/
if ( ! function_exists( 'ntt__tag__entry_banner' ) ) {
    function ntt__tag__entry_banner() {

        $post_meta = get_post_meta( get_the_ID(), 'ntt_featured_image', true );

        $entry_banner_mu_s = '<div class="ntt--entry-banner ntt--cp" data-name="Entry Banner">';
        $entry_banner_mu_e = '</div>';
        $entry_banner_visuals_mu_s = '<figure class="ntt--entry-banner-visuals ntt--obj" data-name="Entry Banner Visuals">';
        $entry_banner_visuals_mu_e = '</figure>';

        // Custom Field
        if ( $post_meta ) {
            
            $markup = '<div class="ntt--entry-banner ntt--cp" data-name="Entry Banner">';
                $markup .= $entry_banner_visuals_mu_s;
                    $markup .= $post_meta;
                $markup .= $entry_banner_visuals_mu_e;
            $markup .= '</div>';

            $markup = apply_filters( 'ntt__kid_ntt__wp_filter__entry_banner_visuals', $markup );
            
            echo $markup;
        
        // Featured Image
        } else if ( ! $post_meta && get_the_post_thumbnail() !== '' ) {
        
            echo $entry_banner_mu_s;
            ntt__tag__entry_banner_visuals();
            echo $entry_banner_mu_e;
        
        // First Image in Content
        } else if ( ! $post_meta && get_the_post_thumbnail() === '') {

            global $post;
            $content = $post->post_content;

            if ( $image = ntt__function__image_tag__getter( $content ) ) {
                $markup = '<div class="ntt--entry-banner ntt--entry-banner-visuals--img-tag---1 ntt--cp" data-name="Entry Banner">';
                    $markup .= $entry_banner_visuals_mu_s;
                        $markup .= '<img src="'. $image['src'].'" width="'. $image['width'].'" height="'. $image['height'].'" alt="Featured Image" />';
                    $markup .= $entry_banner_visuals_mu_e;
                $markup .= '</div>';

                $markup = apply_filters( 'ntt__kid_ntt__wp_filter__entry_banner_visuals', $markup );
                
                echo $markup;
            }
        }
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
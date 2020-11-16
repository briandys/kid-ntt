<?php
/**
 * Entry Banner Visuals Validation
 * Checks for the existence of featured images
 */
function ntt__kid_ntt__function__entry_banner_visuals__validation( $type = '' ) {

    // Custom field
    $post_meta = get_post_meta( get_the_ID(), 'ntt_featured_image', true );

    // Custom field
    $post_meta_auto = get_post_meta( get_the_ID(), 'ntt_featured_image_auto', true );
    $post_meta_auto_clean = substr( strtolower( preg_replace( '/\s+/', '', $post_meta_auto ) ), 0, 8 );
    $post_meta_auto_on = array(
        'on',
        '1',
    );
    $post_meta_auto = in_array( $post_meta_auto_clean, $post_meta_auto_on, true );

    // Featured image
    $post_thumbnail = get_the_post_thumbnail() !== '';
    
    if ( $type === 'post_meta' && $post_meta ) {
        return true;
    } else if ( $type === 'post_meta_auto' && $post_meta_auto ) {
        return true;
    } else if ( $type === 'post_thumbnail' && $post_thumbnail ) {
        return true;
    } else if ( $type === '' && ( $post_meta || $post_meta_auto || $post_thumbnail ) ) {
        return true;
    }
}


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

        $post_meta = ntt__kid_ntt__function__entry_banner_visuals__validation( $type = 'post_meta' );        
        $post_meta_auto = ntt__kid_ntt__function__entry_banner_visuals__validation( $type = 'post_meta_auto' );
        $post_thumbnail = ntt__kid_ntt__function__entry_banner_visuals__validation( $type = 'post_thumbnail' );

        $post_meta_content = get_post_meta( get_the_ID(), 'ntt_featured_image', true );

        $entry_banner_mu_s = '<div class="ntt--entry-banner ntt--cp" data-name="Entry Banner">';
        $entry_banner_mu_e = '</div>';
        $entry_banner_visuals_mu_s = '<figure class="ntt--entry-banner-visuals ntt--obj" data-name="Entry Banner Visuals">';
        $entry_banner_visuals_mu_e = '</figure>';

        // Custom Field
        if ( $post_meta ) {
            
            $markup = $entry_banner_mu_s;
                $markup .= $entry_banner_visuals_mu_s;
                    $markup .= $post_meta_content;
                $markup .= $entry_banner_visuals_mu_e;
            $markup .= $entry_banner_mu_e;

            $markup = apply_filters( 'ntt__kid_ntt__wp_filter__entry_banner_visuals', $markup );
            
            echo $markup;
        
        // Featured Image
        } else if ( ! $post_meta && $post_thumbnail ) {
        
            echo $entry_banner_mu_s;
            ntt__tag__entry_banner_visuals();
            echo $entry_banner_mu_e;
        
        // First Image in Content
        } else if ( $post_meta_auto && ! $post_meta && ! $post_thumbnail ) {

            global $post;
            $content = $post->post_content;

            if ( $image = ntt__function__image_tag__getter( $content ) ) {
                $markup = $entry_banner_mu_s;
                    $markup .= $entry_banner_visuals_mu_s;
                        $markup .= '<img src="'. $image['src'].'" width="'. $image['width'].'" height="'. $image['height'].'" alt="Featured Image" />';
                    $markup .= $entry_banner_visuals_mu_e;
                $markup .= $entry_banner_mu_e;

                $markup = apply_filters( 'ntt__kid_ntt__wp_filter__entry_banner_visuals', $markup );
                
                echo $markup;
            }
        }
    }
}

/**
 * Entry CSS
 */
function ntt__kid_ntt__function__entry_banner_visuals__entry_css( $classes ) {

    $post_meta_auto = ntt__kid_ntt__function__entry_banner_visuals__validation( $type = 'post_meta_auto' );
    $entry_banner_visuals = ntt__kid_ntt__function__entry_banner_visuals__validation( $type = '' );
    
    $on = 'ntt--entry-banner-visuals---1';
    $off = 'ntt--entry-banner-visuals---0';    

    if ( $post_meta_auto ) {
        $classes[] = 'ntt--entry-banner-visuals-auto';
    }

    if ( $entry_banner_visuals ) {
        $classes[] = $on;
    } else {
        $classes[] = $off;
    }

    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__function__entry_banner_visuals__entry_css' );
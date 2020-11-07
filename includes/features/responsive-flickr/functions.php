<?php
/*
Feature Name: Responsive Flickr
Slug: responsive-flickr
Description: Make the embed code of Flickr generate responsive images.
URL: http://modernblackhand.com/index.php/en/responsive-flickr-embed-photos/
Scope: Entity
Version: 0.0.0
*/

/**
 * Entry Feature Validation (entry-specific)
 * Checks if the feature is in Custom Fields
 */
function ntt__kid_ntt__features__responsive_flickr__entry_validation() {

    $post_meta = get_post_meta( get_the_ID(), 'ntt_features', true );

    if ( is_singular() && $post_meta ) {

        // Convert string to array
        $post_meta = explode( ' ', $post_meta );

        $feature_array = array(
            ntt__kid_ntt__features__get_data( 'responsive-flickr' )['Slug'],        
        );

        if ( array_intersect( $post_meta, $feature_array ) ) {
            return true;
        }
    }
}

/**
 * Entity Feature Validation (site-wide)
 * Checks if the feature is in Snaps functions.php or WP Customizer
 */
function ntt__kid_ntt__features__responsive_flickr__entity_validation() {
    
    $features_customizer = get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' );

    if ( $features_customizer == '' ) {
        $features_customizer = array();
    } else {
        $features_customizer = get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' );
    }
    
    $snaps_feature_settings = ntt__kid_ntt__snaps__features();

    //Temp until Customizer is fixed
    $features_customizer = array();

    if ( $features_customizer || $snaps_feature_settings ) {

        $feature_array = array(
            ntt__kid_ntt__features__get_data( 'responsive-flickr' )['Slug'],
        );
    
        if (  array_intersect( $features_customizer, $feature_array ) || array_intersect( $snaps_feature_settings, $feature_array ) ) {
            return true;
        }
    }    
}

/**
 * Main
 */
function ntt__kid_ntt__function__responsive_flickr( $content ) {

    if ( ( is_singular() && ntt__kid_ntt__features__responsive_flickr__entry_validation() ) || ntt__kid_ntt__features__responsive_flickr__entity_validation() ) {

        $preg_match_b = preg_match( '/src=\"(.*staticflickr\.com.*)_b\.jpg\"/i', $content );
        $preg_match_n = preg_match( '/src=\"(.*staticflickr\.com.*)_n\.jpg\"/i', $content );
        $preg_match_z = preg_match( '/src=\"(.*staticflickr\.com.*)_z\.jpg\"/i', $content );

        if ( $preg_match_b || $preg_match_n || $preg_match_z ) {
            
            $string = $content;
        
            $flickr_find = '/src=\"(.*staticflickr\.com.*)(_.*)b\.jpg\"/i';
            $flickr_replace = 'src="$1_b.jpg" srcset="$1_n.jpg 320w, $1_z.jpg 640w, $1_b.jpg 1024w"';
            
            $find = array();
            $find[0] = $flickr_find;
            $find[1] = $flickr_find;
            $find[2] = $flickr_find;
            $find[3] = '/data-flickr-embed="true" /i';
            $find[4] = '/<script.*script>/i';
            
            $replace = array();
            $replace[0] = $flickr_replace;
            $replace[1] = $flickr_replace;
            $replace[2] = $flickr_replace;
            $replace[3] = '';
            $replace[4] = '';
            
            $content = preg_replace( $find, $replace, $string );
        }
    }
        
    return $content;
}
add_filter( 'the_content', 'ntt__kid_ntt__function__responsive_flickr' );
add_filter( 'ntt__kid_ntt__wp_filter__entry_banner_visuals', 'ntt__kid_ntt__function__responsive_flickr' );

/**
 * View CSS
 */
function ntt__kid_ntt__features__responsive_flickr__view__css( $classes ) {
    
    $slug = ntt__kid_ntt__features__get_data( 'responsive-flickr' )['Slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
    
    if ( ( is_singular() && ntt__kid_ntt__features__responsive_flickr__entry_validation() ) || ntt__kid_ntt__features__responsive_flickr__entity_validation() ) {
        
        $classes[] = esc_attr( $prefixed_slug ). '--view';
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__features__responsive_flickr__view__css' );

/**
 * Entry CSS
 */
function ntt__kid_ntt__features__responsive_flickr__entry__css( $classes ) {
    
    $slug = ntt__kid_ntt__features__get_data( 'responsive-flickr' )['Slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
    
    if ( is_singular() && ntt__kid_ntt__features__responsive_flickr__entry_validation() ) {
        
        $classes[] = esc_attr( $prefixed_slug. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__features__responsive_flickr__entry__css' );
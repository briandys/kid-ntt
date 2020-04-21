<?php
/**
 * Responsive Flickr
 * Make the embed code of Flickr generate responsive images.
 * .ntt--kid-ntt--feature--responsive-flickr
 * http://modernblackhand.com/index.php/en/responsive-flickr-embed-photos/
 * https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images
 */

 $GLOBALS['ntt__gvar__kid_ntt__feature__responsive_flickr__prefixed_name'] = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $GLOBALS['ntt__gvar__kid_ntt__feature__responsive_flickr__name'];

// Validation
 function ntt__kid_ntt__feature__responsive_flickr__validation() {
    
    $post_meta = get_post_meta( get_the_ID(), 'ntt_feature', true );

    $ntt_f5e_array = array(
        $GLOBALS['ntt__gvar__kid_ntt__feature__responsive_flickr__prefixed_name'],
    );

    if ( strpos_array( $post_meta, $ntt_f5e_array ) ) {
        return true;
    }
}

// Main
function ntt__kid_ntt__function__responsive_flickr( $content ) {

    if ( ntt__kid_ntt__feature__responsive_flickr__validation() ) {

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

// View CSS
function ntt__kid_ntt__feature__responsive_flickr__view__css( $classes ) {
    
    if ( is_singular() && ntt__kid_ntt__feature__responsive_flickr__validation() ) {
        $classes[] = esc_attr( $GLOBALS['ntt__gvar__kid_ntt__feature__responsive_flickr__prefixed_name'] );
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__feature__responsive_flickr__view__css' );

// Entry CSS
function ntt__kid_ntt__feature__responsive_flickr__entry__css( $classes ) {
    
    if ( ntt__kid_ntt__feature__responsive_flickr__validation() ) {
        $classes[] = esc_attr( $GLOBALS['ntt__gvar__kid_ntt__feature__responsive_flickr__prefixed_name']. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__feature__responsive_flickr__entry__css' );
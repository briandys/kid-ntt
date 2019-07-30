<?php
/**
 * Responsive Flickr
 * 
 * Make the embed code of Flickr generate responsive images.
 * 
 * http://modernblackhand.com/index.php/en/responsive-flickr-embed-photos/
 */


function ntt_kid_responsive_flickr( $content ) {
    $content = preg_replace( '/src=\"(.*staticflickr\.com.*)(_.*)\.jpg\"/i', 'src="$1_b.jpg" srcset="$1_n.jpg 320w, $1_z.jpg 640w, $1_b.jpg 1024w, $1_h.jpg 1600w"', $content , -1 );
    return $content;
}
add_filter( 'the_content', 'ntt_kid_responsive_flickr' );
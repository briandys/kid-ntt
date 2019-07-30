<?php
/**
 * Comments CSS
 */

/**
 * Comments Status HTML CSS
 */

function ntt_kid_comments_status_html_css( $classes ) {

    $css_suffix = '--view';

    $comments_count = (int) get_comments_number( get_the_ID() );
    
    // Comments Population Status
    if ( $comments_count >= 1 ) {
        $classes[] = 'ntt--comments---populated' .$css_suffix;
    } else {
        $classes[] = 'ntt--comments---empty' .$css_suffix;
    }

    // Comment Creation Ability Status
    if ( comments_open() ) {
        $classes[] = 'ntt--comment-creation---1' .$css_suffix;
    } else {
        $classes[] = 'ntt--comment-creation---0' .$css_suffix;
    }

    return $classes;
}

add_filter( 'ntt_html_css_filter', function( $classes ) {
    return is_singular() ? ntt_kid_comments_status_html_css( $classes ) : $classes;
} );
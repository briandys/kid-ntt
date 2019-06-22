<?php
/**
 * HTML2Canvas Conditional
 */

function ntt_kid_ntt_html_canvas_mode() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_html_canvas_mode', true );
    $post_meta = trim( preg_replace( '/\s+/', '', $post_meta ) );
    
    $on = array(
        '1',
        'active',
        'enabled',
        'on',
    );
    
    return ( is_singular() && in_array( $post_meta, $on, true ) );
}

/**
 * HTML2Canvas HTML CSS
 */

function ntt_kid_ntt_html_canvas_mode_html_css( $classes ) {

    if ( ntt_kid_ntt_html_canvas_mode() ) {
        $classes[] = 'ntt--html-canvas-mode';
    }

    return $classes;
}
add_filter( 'ntt_html_css_filter', 'ntt_kid_ntt_html_canvas_mode_html_css' );

/**
 * HTML2Canvas Styles, Scripts
 */

function ntt_kid_ntt_html_canvas_styles_scripts() {

    wp_enqueue_script( 'ntt--kid-ntt--html-canvas-library-script', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/scripts/html2canvas.min.js', array(), null, true );

    wp_enqueue_script( 'ntt--kid-ntt--html-canvas-script', get_stylesheet_directory_uri(). '/includes/snaps/'. $GLOBALS['ntt_snaps_name_slug']. '/assets/scripts/html-canvas-mode.js', array( 'ntt--kid-ntt--html-canvas-library-script', ), null, true );
}
add_action( 'wp_enqueue_scripts', 'ntt_kid_ntt_html_canvas_styles_scripts', 0 );
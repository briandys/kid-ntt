<?php
/**
 * HTML to Canvas
 * .ntt--f5e--html-to-canvas
 * Adds a button to save screenshot of the page.
 * https://html2canvas.hertzen.com
 */
$GLOBALS['ntt_kid_f5e_html_to_canvas_css_name'] = 'ntt--f5e--'. $GLOBALS['ntt_kid_f5e_html_to_canvas_slug'];
$GLOBALS['ntt_kid_f5e_html_to_canvas_enqueue_slug'] = 'ntt-kid-f5e--'. $GLOBALS['ntt_kid_f5e_html_to_canvas_slug'];

/**
 * NTT Feature Validation
 */
function ntt_kid_f5e_html_to_canvas() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_feature', true );

    $ntt_f5e_array = array(
        $GLOBALS['ntt_kid_f5e_html_to_canvas_css_name'],
    );
    
    return ( is_singular() && strpos_array( $post_meta, $ntt_f5e_array ) );
}

/**
 * Styles, Scripts
 */
function ntt_kid_f5e_html_to_canvas_styles_scripts() {

    if ( ntt_kid_f5e_html_to_canvas() ) {

        wp_enqueue_style( $GLOBALS['ntt_kid_f5e_html_to_canvas_enqueue_slug']. '-style', get_stylesheet_directory_uri(). '/includes/features/'. $GLOBALS['ntt_kid_f5e_html_to_canvas_slug']. '/style.min.css', array( 'ntt-style' ), wp_get_theme()->get( 'Version' ) );
        
        wp_enqueue_script( $GLOBALS['ntt_kid_f5e_html_to_canvas_enqueue_slug']. '-library-script', get_stylesheet_directory_uri(). '/includes/features/'. $GLOBALS['ntt_kid_f5e_html_to_canvas_slug']. '/html2canvas.min.js', array(), wp_get_theme()->get( 'Version' ), true );

        wp_enqueue_script( $GLOBALS['ntt_kid_f5e_html_to_canvas_enqueue_slug']. '-script', get_stylesheet_directory_uri(). '/includes/features/'. $GLOBALS['ntt_kid_f5e_html_to_canvas_slug']. '/main.js', array( $GLOBALS['ntt_kid_f5e_html_to_canvas_enqueue_slug']. '-library-script', ), wp_get_theme()->get( 'Version' ), true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt_kid_f5e_html_to_canvas_styles_scripts', 0 );
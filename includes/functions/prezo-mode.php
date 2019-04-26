<?php
/**
 * Prezo Mode Conditional
 */
function ntt_kid_prezo_mode() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_cf_prezo_mode', true );
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
 * Prezo Mode HTML CSS
 */
function ntt_kid_prezo_mode_html_css( $classes ) {

    if ( ntt_kid_prezo_mode() ) {
        $classes[] = 'ntt--prezo-mode';
    }

    return $classes;
}
add_filter( 'ntt_html_css_wp_filter', 'ntt_kid_prezo_mode_html_css' );

/**
 * Prezo Mode Styles, Scripts
 */
function ntt_kid_prezo_mode_styles_scripts() {

    if ( ntt_kid_prezo_mode() ) {

        wp_enqueue_script( 'ntt-kid-html2canvas-script', get_stylesheet_directory_uri(). '/assets/scripts/html2canvas.min.js', array( 'ntt-kid-script', ), null, true );
        
        wp_enqueue_script( 'ntt-kid-prezo-mode-script', get_stylesheet_directory_uri(). '/assets/scripts/prezo-mode.js', array( 'ntt-kid-html2canvas-script', ), null, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt_kid_prezo_mode_styles_scripts', 0 );
<?php
/**
 * Styles, Scripts
 */
function app_ntt_styles_scripts() {
    
    wp_enqueue_style( 'app-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/app/assets/styles/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'app_ntt_styles_scripts', 0 );
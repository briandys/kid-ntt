<?php
/**
 * Styles, Scripts
 */

function ntt_kid_styles_scripts() {

    wp_enqueue_style( 'ntt-kid-style', get_stylesheet_directory_uri(). '/assets/styles/style.min.css', array( 'ntt-style' ), wp_get_theme()->get( 'Version' ) );

    wp_enqueue_script( 'ntt-kid-script', get_stylesheet_directory_uri(). '/assets/scripts/main.js', array( 'jquery', 'ntt-script', ), wp_get_theme()->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'ntt_kid_styles_scripts', 0 );
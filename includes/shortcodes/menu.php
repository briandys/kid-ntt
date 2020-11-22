<?php
/**
 * Menu Shortcode
 * Call menu using a shortcode
 * Usage: [ntt_menu "Menu Name"]
 */
function ntt__kid_ntt__wp_shortcode__nav_menu( $atts ) {

    if ( ! isset( $atts[0] ) ) {
        return;
    } else {
        $name = $atts[0];
    }

    $menu = wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
    
	return $menu;
}

function ntt__kid_ntt__wp_shortcode__nav_menu__initialization() {
    add_shortcode( 'ntt_menu', 'ntt__kid_ntt__wp_shortcode__nav_menu' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__nav_menu__initialization' );
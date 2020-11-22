<?php

function ntt__kid_ntt__wp_shortcode__search_widget__initialization() {
    add_shortcode( 'ntt_search', 'get_search_form' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__search_widget__initialization' );
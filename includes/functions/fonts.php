<?php
/**
 * Custom Fonts Preconnect
 */
function ntt__kid_ntt__function__custom_fonts_preconnect( $urls, $relation_type ) {
    
    if ( wp_style_is( 'ntt-kid-custom-fonts-style', 'queue' ) && 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'ntt__kid_ntt__function__custom_fonts_preconnect', 10, 2 );

/**
 * Custom Fonts
 * Usage: $font_families[] = 'Open+Sans';
 */
function ntt__kid_ntt__function__custom_fonts() {
    $font_families = array();
    $font_families = apply_filters( 'ntt__kid_ntt__wp_filter__custom_fonts', $font_families );

    $query_args = array(
        'family' => implode( '|', $font_families ),
        'subset' => 'latin,latin-ext',
    );
    
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    
    return esc_url_raw( $fonts_url );
}

/**
 * Custom Fonts Style
 */
function ntt__kid_ntt__function__custom_fonts__styles() {
    wp_enqueue_style( 'ntt-kid-custom-fonts-style', ntt__kid_ntt__function__custom_fonts() );
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__function__custom_fonts__styles', 0);
<?php
//ucwords(str_replace("-"," ",$row[website]))
/**
 * Prezo Mode
 * Adds a button to toggle Prezo Mode.
 */
function ntt__kid_ntt__features__prezo_mode__info() {
    
    $name = 'Prezo Mode';

    $info = array(
        'name'      => $name,
        'slug'      => sanitize_title( $name ),
        'version'   => '0.0.0',
        'prefix'    => $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix'],
    );
    
    return $info;
}

/**
 * NTT Feature Validation
 * Checks if the feature is in Custom Fields
 */
function ntt__kid_ntt__features__prezo_mode__entry_validation() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_features', true );
    
    $feature_array = array(
        ntt__kid_ntt__features__prezo_mode__info()['slug'],
    );

    if ( strpos_array( $post_meta, $feature_array ) ) {
        return true;
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__features__prezo_mode__styles_scripts() {

    $info = ntt__kid_ntt__features__prezo_mode__info();
    $prefixed_slug = $info['prefix']. $info['slug'];
    $style_id = $prefixed_slug. '--style';
    $script_id = $prefixed_slug. '--script';
    $version = $info['version']. '-'. wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__features__prezo_mode__entry_validation() ) {

        wp_enqueue_style( $style_id, get_stylesheet_directory_uri(). '/includes/features/'. $info['slug']. '/style.min.css', array( 'ntt-kid-style' ), $version );

        wp_enqueue_script( $script_id, get_stylesheet_directory_uri(). '/includes/features/'. $info['slug']. '/main.js', array(), $version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__features__prezo_mode__styles_scripts', 0 );

/**
 * View CSS
 */
function ntt__kid_ntt__features__prezo_mode__view__css( $classes ) {
    
    $info = ntt__kid_ntt__features__prezo_mode__info();
    $prefixed_slug = $info['prefix']. $info['slug'];
    
    if ( ( is_singular() && ntt__kid_ntt__features__prezo_mode__entry_validation() ) ) {
        $classes[] = esc_attr( $prefixed_slug ). '--view';
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__features__prezo_mode__view__css' );

/**
 * Entry CSS
 */
function ntt__kid_ntt__features__prezo_mode__entry__css( $classes ) {
    
    $info = ntt__kid_ntt__features__prezo_mode__info();
    $prefixed_slug = $info['prefix']. $info['slug'];
    
    if ( is_singular() && ntt__kid_ntt__features__prezo_mode__entry_validation() ) {
        $classes[] = esc_attr( $prefixed_slug. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__features__prezo_mode__entry__css' );
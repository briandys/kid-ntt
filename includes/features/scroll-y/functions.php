<?php
/**
 * Scroll Y
 * Adds data attributes to HTML element to track scrolling in the Y-axis, both in pixels and percentage.
 */
function ntt__kid_ntt__features__scroll_y__info() {
    
    $name = 'Scroll Y';

    $info = array(
        'name'      => $name,
        'slug'      => sanitize_title( $name ),
        'version'   => '0.0.2',
        'prefix'    => $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix'],
    );
    
    return $info;
}

/**
 * NTT Feature Validation
 * Checks if the feature is in Custom Fields
 */
function ntt__kid_ntt__features__scroll_y__entry_validation() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_features', true );
    
    $feature_array = array(
        ntt__kid_ntt__features__scroll_y__info()['slug'],
    );

    if ( strpos_array( $post_meta, $feature_array ) ) {
        return true;
    }
}

/**
 * NTT Feature Validation
 * Checks if the feature is in Snaps functions.php or WP Customizer
 */
function ntt__kid_ntt__features__scroll_y__theme_validation() {
    
    $theme_mod = join( ' ', get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' ) );
    $snaps_feature_settings = join( ' ', ntt__kid_ntt__snaps__features() );

    $feature_array = array(
        ntt__kid_ntt__features__scroll_y__info()['slug'],
    );

    if (  strpos_array( $theme_mod, $feature_array ) || strpos_array( $snaps_feature_settings, $feature_array ) ) {
        return true;
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__features__scroll_y__styles_scripts() {

    $info = ntt__kid_ntt__features__scroll_y__info();
    $prefixed_slug = $info['prefix']. $info['slug'];
    $main_script_id = $prefixed_slug. '--script';
    $version = $info['version']. '-'. wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__features__scroll_y__entry_validation() || ntt__kid_ntt__features__scroll_y__theme_validation() ) {

        wp_enqueue_script( $main_script_id, get_stylesheet_directory_uri(). '/includes/features/'. $info['slug']. '/main.js', array(), $version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__features__scroll_y__styles_scripts', 0 );

/**
 * View CSS
 */
function ntt__kid_ntt__features__scroll_y__view__css( $classes ) {
    
    $info = ntt__kid_ntt__features__scroll_y__info();
    $prefixed_slug = $info['prefix']. $info['slug'];
    
    if ( ( is_singular() && ntt__kid_ntt__features__scroll_y__entry_validation() ) || ntt__kid_ntt__features__scroll_y__theme_validation() ) {
        $classes[] = esc_attr( $prefixed_slug ). '--view';
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__features__scroll_y__view__css' );

/**
 * Entry CSS
 */
function ntt__kid_ntt__features__scroll_y__entry__css( $classes ) {
    
    $info = ntt__kid_ntt__features__scroll_y__info();
    $prefixed_slug = $info['prefix']. $info['slug'];
    
    if ( is_singular() && ntt__kid_ntt__features__scroll_y__entry_validation() ) {
        $classes[] = esc_attr( $prefixed_slug. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__features__scroll_y__entry__css' );
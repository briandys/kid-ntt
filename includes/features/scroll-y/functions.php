<?php
/**
 * Scroll Y
 * Adds data attributes to HTML element to track scrolling in the Y-axis, both in pixels and percentage.
 */

function ntt__kid_ntt__features__info() {
    $name = 'Scroll Y';

    $info = array(
        'name'      => $name,
        'slug'      => sanitize_title( $name ),
        'version'   => '0.0.1',
        'prefix'    => 'ntt--kid-ntt--feature--',
    );
    
    return $info;
}

$feature_slug = ntt__kid_ntt__features__info()['slug'];
$feature_prefix = ntt__kid_ntt__features__info()['prefix'];
$feature_prefixed_name = $feature_prefix. $feature_slug;
$feature_version = ntt__kid_ntt__features__info()['version'];

$GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__prefixed_name'] = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__name'];
$GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__version'] = '1.0.0';

/**
 * NTT Feature Validation
 * Checks if the feature is in Custom Fields or Customizer > NTT Settings
 */
function ntt__kid_ntt__feature__scroll_y__validation() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_feature', true );
    $theme_mod = get_theme_mod( 'ntt_settings_features' );
    
    $feature_array = array(
        ntt__kid_ntt__features__info()['slug'],
    );

    if ( strpos_array( $post_meta, $feature_array ) || strpos_array( $theme_mod, $feature_array ) ) {
        return true;
    }
}

echo ntt__kid_ntt__feature__scroll_y__validation();

/**
 * NTT Feature Validation
 * Checks if the feature is in Custom Fields or Customizer > NTT Settings
 */
function ntt__kid_ntt__feature__scroll_y__snaps_settings_validation() {
    $snaps_feature_settings = join( ' ', ntt__kid_ntt__snaps__feature_settings() );

    $feature_array = array(
        ntt__kid_ntt__features__info()['slug'],
    );

    if ( strpos_array( $snaps_feature_settings, $feature_array ) ) {
        return true;
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__feature__scroll_y__styles_scripts() {

    $feature_slug = ntt__kid_ntt__features__info()['slug'];
    $feature_prefix = ntt__kid_ntt__features__info()['prefix'];
    $feature_prefixed_name = $feature_prefix. $feature_slug;
    $feature_version = ntt__kid_ntt__features__info()['version'];
    $theme_version = wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__feature__scroll_y__validation() || ntt__kid_ntt__feature__scroll_y__snaps_settings_validation() ) {

        wp_enqueue_script( $feature_prefixed_name. '--script', get_stylesheet_directory_uri(). '/includes/features/'. $feature_slug. '/main.js', array(), $feature_version. '-'. $theme_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__feature__scroll_y__styles_scripts', 0 );

// View CSS
function ntt__kid_ntt__feature__scroll_y__view__css( $classes ) {
    $feature_slug = ntt__kid_ntt__features__info()['slug'];
    $feature_prefix = ntt__kid_ntt__features__info()['prefix'];
    $feature_prefixed_name = $feature_prefix. $feature_slug;
    
    if ( ( is_singular() && ntt__kid_ntt__feature__scroll_y__validation() ) || ntt__kid_ntt__feature__scroll_y__snaps_settings_validation() ) {
        $classes[] = esc_attr( $feature_prefixed_name );
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__feature__scroll_y__view__css' );

// Entry CSS
function ntt__kid_ntt__feature__scroll_y__entry__css( $classes ) {
    $feature_slug = ntt__kid_ntt__features__info()['slug'];
    $feature_prefix = ntt__kid_ntt__features__info()['prefix'];
    $feature_prefixed_name = $feature_prefix. $feature_slug;
    
    if ( is_singular() && ntt__kid_ntt__feature__scroll_y__validation() ) {
        $classes[] = esc_attr( $feature_prefixed_name. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__feature__scroll_y__entry__css' );
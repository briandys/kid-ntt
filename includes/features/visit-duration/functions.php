<?php
/**
 * Visit Duration
 * Adds data attributes to HTML element to track scrolling in the Y-axis, both in pixels and percentage.
 */

function ntt__kid_ntt__features__visit_duration__info() {
    $name = 'Visit Duration';

    $info = array(
        'name'      => $name,
        'slug'      => sanitize_title( $name ),
        'version'   => '0.0.1',
        'prefix'    => $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix'],
    );
    
    return $info;
}

/**
 * NTT Feature Validation
 * Checks if the feature is in Custom Fields or Customizer > NTT Settings
 */
function ntt__kid_ntt__features__visit_duration__entry_validation() {
    
    $post_meta = get_post_meta( get_the_ID(), 'ntt_features', true );
    
    $feature_array = array(
        ntt__kid_ntt__features__visit_duration__info()['slug'],
    );

    if ( strpos_array( $post_meta, $feature_array ) ) {
        return true;
    }
}

/**
 * NTT Feature Validation
 * Checks if the feature is in Snaps functions.php
 */
function ntt__kid_ntt__features__visit_duration__theme_validation() {
    
    $theme_mod = join( ' ', get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' ) );
    $snaps_feature_settings = join( ' ', ntt__kid_ntt__snaps__feature_settings() );

    $feature_array = array(
        ntt__kid_ntt__features__visit_duration__info()['slug'],
    );

    if (  strpos_array( $theme_mod, $feature_array ) || strpos_array( $snaps_feature_settings, $feature_array ) ) {
        return true;
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__features__visit_duration__styles_scripts() {

    $info = ntt__kid_ntt__features__visit_duration__info();
    $prefixed_slug = $info['prefix']. $info['slug'];
    $main_script_id = $prefixed_slug. '--script';
    $version = $info['version']. '-'. wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__features__visit_duration__entry_validation() || ntt__kid_ntt__features__visit_duration__theme_validation() ) {

        wp_enqueue_script( $main_script_id, get_stylesheet_directory_uri(). '/includes/features/'. $info['slug']. '/main.js', array(), $version, true );

        $ntt_l10n = array(
            'prefixedSlug' => $prefixed_slug,
        );
    
        wp_localize_script( $main_script_id, 'nttKidNttFeatureVisitDurationData', $ntt_l10n );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__features__visit_duration__styles_scripts', 0 );

// View CSS
function ntt__kid_ntt__features__visit_duration__view__css( $classes ) {
    
    $feature_slug = ntt__kid_ntt__features__visit_duration__info()['slug'];
    $feature_prefix = ntt__kid_ntt__features__visit_duration__info()['prefix'];
    $feature_prefixed_name = $feature_prefix. $feature_slug;
    
    if ( ( is_singular() && ntt__kid_ntt__features__visit_duration__entry_validation() ) || ntt__kid_ntt__features__visit_duration__theme_validation() ) {
        $classes[] = esc_attr( $feature_prefixed_name ). '--view';
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__features__visit_duration__view__css' );

// Entry CSS
function ntt__kid_ntt__features__visit_duration__entry__css( $classes ) {
    
    $feature_slug = ntt__kid_ntt__features__visit_duration__info()['slug'];
    $feature_prefix = ntt__kid_ntt__features__visit_duration__info()['prefix'];
    $feature_prefixed_name = $feature_prefix. $feature_slug;
    
    if ( is_singular() && ntt__kid_ntt__features__visit_duration__entry_validation() ) {
        $classes[] = esc_attr( $feature_prefixed_name. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__features__visit_duration__entry__css' );
<?php
/*
Feature Name: Prezo Mode
Slug: prezo-mode
Description: Adds a button to toggle Prezo Mode.
Scope: Entry
Version: 0.0.0
*/

/**
 * Entry Feature Validation (entry-specific)
 * Checks if the feature is in Custom Fields
 */
function ntt__kid_ntt__features__prezo_mode__entry_validation() {

    $post_meta = get_post_meta( get_the_ID(), 'ntt_features', true );

    if ( is_singular() && $post_meta ) {

        // Convert string to array
        $post_meta = explode( ' ', $post_meta );

        $feature_array = array(
            ntt__kid_ntt__features__get_data( 'prezo-mode ')['Slug'],        
        );

        if ( array_intersect( $post_meta, $feature_array ) ) {
            return true;
        }
    }
}

/**
 * Entity Feature Validation (site-wide)
 * Checks if the feature is in Snaps functions.php or WP Customizer
 */
function ntt__kid_ntt__features__prezo_mode__entity_validation() {
    
    $theme_mod = get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' );
    $snaps_feature_settings = ntt__kid_ntt__snaps__features();

    if ( $theme_mod || $snaps_feature_settings ) {

        $feature_array = array(
            ntt__kid_ntt__features__get_data( 'prezo-mode ')['Slug'],
        );
    
        if (  array_intersect( $theme_mod, $feature_array ) || array_intersect( $snaps_feature_settings, $feature_array ) ) {
            return true;
        }
    }    
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__features__prezo_mode__styles_scripts() {

    $feature = ntt__kid_ntt__features__get_data( 'prezo-mode');
    $slug = $feature['Slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
    $main_style_id = $prefixed_slug. '--style';
    $main_script_id = $prefixed_slug. '--script';
    $path = get_stylesheet_directory_uri(). '/includes/features/'. $slug;
    $version = $feature['Version']. '-'. wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__features__prezo_mode__entry_validation() || ntt__kid_ntt__features__prezo_mode__entity_validation() ) {

        wp_enqueue_style( $main_style_id, $path. '/style.min.css', array( 'ntt-kid-style' ), $version );
        wp_enqueue_script( $main_script_id, $path. '/main.js', array(), $version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__features__prezo_mode__styles_scripts', 0 );

/**
 * View CSS
 */
function ntt__kid_ntt__features__prezo_mode__view__css( $classes ) {
    
    $slug = ntt__kid_ntt__features__get_data( 'prezo-mode ')['Slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
    
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
    
    $slug = ntt__kid_ntt__features__get_data( 'prezo-mode ')['Slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
    
    if ( is_singular() && ntt__kid_ntt__features__prezo_mode__entry_validation() ) {
        
        $classes[] = esc_attr( $prefixed_slug. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__features__prezo_mode__entry__css' );
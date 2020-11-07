<?php
/*
Feature Name: InstaFeed
Slug: instafeed
Description: Display personal Instagram feed
Scope: Entity
Version: 0.0.2
*/

/**
 * Entry Feature Validation (entry-specific)
 * Checks if the feature is in Custom Fields
 */
function ntt__kid_ntt__features__instafeed__entry_validation() {

    $post_meta = get_post_meta( get_the_ID(), 'ntt_features', true );

    if ( is_singular() && $post_meta ) {

        // Convert string to array
        $post_meta = explode( ' ', $post_meta );

        $feature_array = array(
            ntt__kid_ntt__features__get_data( 'instafeed' )['Slug'],
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
function ntt__kid_ntt__features__instafeed__entity_validation() {

    $features_customizer = get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' );

    if ( $features_customizer == '' ) {
        $features_customizer = array();
    } else {
        $features_customizer = get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' );
    }
    
    $snaps_feature_settings = ntt__kid_ntt__snaps__features();

    //Temp until Customizer is fixed
    $features_customizer = array();

    if ( $features_customizer || $snaps_feature_settings ) {

        $feature_array = array(
            ntt__kid_ntt__features__get_data( 'instafeed' )['Slug'],
        );
    
        if (  array_intersect( $features_customizer, $feature_array ) || array_intersect( $snaps_feature_settings, $feature_array ) ) {
            return true;
        }
    }    
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__features__instafeed__styles_scripts() {

    if ( ntt__kid_ntt__features__instafeed__entry_validation() || ntt__kid_ntt__features__instafeed__entity_validation() ) {

        $feature = ntt__kid_ntt__features__get_data( 'instafeed' );
        $slug = $feature['Slug'];
        $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
        $main_style_id = $prefixed_slug. '--style';
        $main_script_id = $prefixed_slug. '--script';
        $library_script_id = $prefixed_slug. '--library-script';
        $path = get_stylesheet_directory_uri(). '/includes/features/'. $slug;
        $version = $feature['Version']. '-'. wp_get_theme()->get( 'Version' );

        wp_enqueue_script( $main_style_id, $path. '/style.min.css', array(), $version );
        wp_enqueue_script( $library_script_id, $path. '/instafeed.min.js', array(), $version, true );
        wp_enqueue_script( $main_script_id, $path. '/main.js', array( $library_script_id ), $version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__features__instafeed__styles_scripts', 0 );

/**
 * View CSS
 */
function ntt__kid_ntt__features__instafeed__view__css( $classes ) {
    
    $slug = ntt__kid_ntt__features__get_data( 'instafeed' )['Slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
    
    if ( ( is_singular() && ntt__kid_ntt__features__instafeed__entry_validation() ) || ntt__kid_ntt__features__instafeed__entity_validation() ) {
        
        $classes[] = esc_attr( $prefixed_slug ). '--view';
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__features__instafeed__view__css' );

/**
 * Entry CSS
 */
function ntt__kid_ntt__features__instafeed__entry__css( $classes ) {
    
    $slug = ntt__kid_ntt__features__get_data( 'instafeed' )['Slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
    
    if ( is_singular() && ntt__kid_ntt__features__instafeed__entry_validation() ) {
        
        $classes[] = esc_attr( $prefixed_slug. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__features__instafeed__entry__css' );
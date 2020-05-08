<?php
/*
Feature Name: Feature Name: InstaFeed
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
    
    $theme_mod = get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' );
    $snaps_feature_settings = ntt__kid_ntt__snaps__features();

    if ( $theme_mod || $snaps_feature_settings ) {

        $feature_array = array(
            ntt__kid_ntt__features__get_data( 'instafeed' )['Slug'],
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













































$GLOBALS['ntt_kid_f5e_instafeed_css_name'] = 'ntt--f5e--'. $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'];
$GLOBALS['ntt_kid_f5e_instafeed_enqueue_slug'] = 'ntt-kid-f5e--'. $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'];

$GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__prefixed_name'] = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'];
$GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__version'] = '1.0.0';

/**
 * NTT Feature Validation
 */
function ntt__kid_ntt__feature__instafeed__validation() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_features', true );
    $theme_mod = get_theme_mod( 'ntt__wp_customizer__settings__features' );

    $ntt_f5e_array = array(
        $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__prefixed_name'],
    );

    if ( strpos_array( $post_meta, $ntt_f5e_array ) || strpos_array( $theme_mod, $ntt_f5e_array ) ) {
        return true;
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__feature__instafeed__styles_scripts() {

    $name = $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'];
    $prefixed_name = $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__prefixed_name'];
    $version = $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__version'];
    $theme_version = wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__feature__instafeed__validation() ) {

        wp_enqueue_style( $prefixed_name. '--style', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/style.min.css', array( 'ntt-kid-style' ), $version. '-'. $theme_version );

        wp_enqueue_script( $prefixed_name. '--library-script', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/instafeed.min.js', array(), $version. '-'. $theme_version, true );

        wp_enqueue_script( $prefixed_name. '--script', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/main.js', array( $prefixed_name. '--library-script' ), $version. '-'. $theme_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__feature__instafeed__styles_scripts', 0 );

// View CSS
function ntt__kid_ntt__feature__instafeed__view__css( $classes ) {
    
    if ( ntt__kid_ntt__feature__instafeed__validation() ) {
        $classes[] = esc_attr( $GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__prefixed_name'] );
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__feature__instafeed__view__css' );

// Entry CSS
function ntt__kid_ntt__feature__instafeed__entry__css( $classes ) {
    
    if ( is_singular() && ntt__kid_ntt__feature__instafeed__validation() ) {
        $classes[] = esc_attr( $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__prefixed_name']. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__feature__instafeed__entry__css' );
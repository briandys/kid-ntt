<?php
/*
Feature Name: Screenshot
Slug: screenshot
Description: Adds a button to save screenshot of the page.
URL: https://html2canvas.hertzen.com
Scope: Entry
Version: 0.0.3
*/

/**
 * Entry Feature Validation (entry-specific)
 * Checks if the feature is in Custom Fields
 */
function ntt__kid_ntt__features__screenshot__entry_validation() {

    $post_meta = get_post_meta( get_the_ID(), 'ntt_features', true );

    if ( is_singular() && $post_meta ) {

        // Convert string to array
        $post_meta = explode( ' ', $post_meta );

        $feature_array = array(
            ntt__kid_ntt__features__get_data( 'screenshot' )['Slug'],        
        );

        if ( array_intersect( $post_meta, $feature_array ) ) {
            return true;
        }
    }
}

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__features__screenshot__styles_scripts() {

    $feature = ntt__kid_ntt__features__get_data( 'screenshot' );
    $slug = $feature['Slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
    $main_script_id = $prefixed_slug. '--script';
    $path = get_stylesheet_directory_uri(). '/includes/features/'. $slug;
    $version = $feature['Version']. '-'. wp_get_theme()->get( 'Version' );

    if ( ntt__kid_ntt__features__screenshot__entry_validation() ) {

        $feature = ntt__kid_ntt__features__get_data( 'screenshot');
        $slug = $feature['Slug'];
        $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
        $main_style_id = $prefixed_slug. '--style';
        $library_script_id = $prefixed_slug. '--library-script';
        $main_script_id = $prefixed_slug. '--script';
        $path = get_stylesheet_directory_uri(). '/includes/features/'. $slug;
        $version = $feature['Version']. '-'. wp_get_theme()->get( 'Version' );
        
        wp_enqueue_style( $main_style_id, $path. '/style.min.css', array( 'ntt-kid-style' ), $version );
        wp_enqueue_script( $library_script_id, $path. '/html2canvas.min.js', array(), $version, true );
        wp_enqueue_script( $main_script_id, $path. '/main.js', array( $library_script_id ), $version, true );

        $ntt_l10n = array(  
            'downloadScreenshotTxt' => __( 'Download Screenshot', 'kid-ntt' ),
            'screenShotTxt'         => __( 'Screenshot', 'kid-ntt' ),
        );
        
        wp_localize_script( 'ntt-kid-script', 'nttKidNttScreenshotData', $ntt_l10n );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__features__screenshot__styles_scripts', 0 );

/**
 * View CSS
 */
function ntt__kid_ntt__features__screenshot__view__css( $classes ) {
    
    $slug = ntt__kid_ntt__features__get_data( 'screenshot' )['Slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
    
    if ( ( is_singular() && ntt__kid_ntt__features__screenshot__entry_validation() ) ) {
        
        $classes[] = esc_attr( $prefixed_slug ). '--view';
    }
    
    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__features__screenshot__view__css' );

/**
 * Entry CSS
 */
function ntt__kid_ntt__features__screenshot__entry__css( $classes ) {
    
    $slug = ntt__kid_ntt__features__get_data( 'screenshot' )['Slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $slug;
    
    if ( is_singular() && ntt__kid_ntt__features__screenshot__entry_validation() ) {
        
        $classes[] = esc_attr( $prefixed_slug. '--entry' );
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__features__screenshot__entry__css' );
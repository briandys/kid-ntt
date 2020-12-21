<?php
/**
 * HTML CSS
 */

function ntt__kid_ntt__function__view__css( $classes ) {

    /**
     * Entity Name
     * Ex. If site name is "NTT," CSS class name is "ntt--entity--ntt".
     */    
    $classes[] = 'ntt--entity--'. sanitize_title( get_bloginfo( 'name' ) );
    
    /**
     * Page Position
     */
    if ( ! is_paged() ) {
        $classes[] = 'ntt--page---first';
    } else {
        $classes[] = 'ntt--page---subsequent';
    }

    /**
     * User Types
     */
    if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
        $classes[] = 'ntt--user---admin';
    }

    /**
     * Entity Name Ability Status
     */
    if ( get_bloginfo( 'name', 'display' ) && get_header_textcolor() !== 'blank' ) {
        $classes[] = 'ntt--entity-name---1';
    } else {
        $classes[] = 'ntt--entity-name---0';
    }

    /**
     * Entity Description Ability Status
     */
    if ( get_bloginfo( 'description', 'display' ) && get_header_textcolor() !== 'blank' ) {
        $classes[] = 'ntt--entity-description---1';
    } else {
        $classes[] = 'ntt--entity-description---0';
    }

    /**
     * Page Template
     * https://stackoverflow.com/a/2395905
     */
    $page_template_text = 'ntt--page-template';
    $view_text = 'view';
    
    if ( get_page_template_slug() ) {
        global $post;
        $template_slug = get_page_template_slug( $post->ID );
        $template_slug = preg_replace( '/\.[^.]+$/', '', $template_slug );
        $template_slug = sanitize_title( $template_slug );
        
        $classes[] = $page_template_text. '---specific'. '--'. $view_text;
        $classes[] = $page_template_text. '--'. $template_slug. '--'. $view_text;
    } else {
        $classes[] = $page_template_text. '---generic'. '--'. $view_text;
    }
    
    // Entry Category
    if ( is_category() ) {
        $classes[] = 'ntt--entry-category--'. sanitize_title( single_cat_title( '', false ) ). '--view';
    }

    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__function__view__css' );
<?php
/**
 * Entry CSS
 */
function ntt_kid_entry_css( $classes ) {

    global $post;
    
    /**
     * Entry Update Status
     */
    if ( get_the_modified_date( 'j F Y H i' ) !== get_the_date( 'j F Y H i' ) ) {
        $classes[] = 'entry--updated';
    }

    /**
     * Entry More Tag <!--more--> Ability Status
     */
    if ( strpos( $post->post_content, '<!--more-->' ) ) {
        $classes[] = 'entry-more-tag--1';
    }

    /**
     * Entry Author Default Avatar Status
     */
    $avatar_css = 'entry-author-default-avatar';
    
    if ( get_option( 'avatar_default' ) == 'blank' ) {
        $classes[] = $avatar_css . '--blank';
    } else {
        $classes[] = $avatar_css . '--custom';
    }

    /**
     * Entry Summary (Excerpt) Ability Status
     */
    if ( has_excerpt() ) {
        $classes[] = 'entry-summary-content--1';
    }

    /**
     * Entry Name Population Status
     */
    if ( ! get_the_title() ) {
        $classes[] = 'entry-name--empty';
    }

    /**
     * Entry Banner Visuals (Featured Image) Ability Status
     */
    if ( get_the_post_thumbnail() !== '' ) {
        $classes[] = 'entry-banner-visuals--1';
    } else {
        $classes[] = 'entry-banner-visuals--0';
    }

    /**
     * Entry Name View
     */
    if ( $post->post_title ) {
        $post_name = $post->post_type. '-entry--'. $post->post_name;
    } else {
        $post_name = $post->post_type. '-entry-'. $post->post_name;
    }

    $classes[] = $post_name;

    /**
     * Sticky Post
     */
    if ( is_sticky() ) {
        $classes[] = 'entry--sticky';
    } else {
        $classes[] = 'entry--unsticky';
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt_kid_entry_css' );

/**
 * Entry CSS added to HTML
 */
add_filter( 'ntt_html_css_wp_filter', function( $classes ) {
    return is_singular() ? ntt_kid_entry_css( $classes ) : $classes;
} );

/**
 * Entry CSS Status Classes
 */
/*
function ntt_kid_entry_css_status_classes( $classes ) {
    
    global $post;

    $enabled_css = '1';
    $disabled = '0';
    $populated = 'populated';
    $empty = 'empty';
    
    // Post Formats
    $r_post_formats_css = array(
        'aside',
        'audio',
        'chat',
        'gallery',
        'link',
        'image',
        'quote',
        'status',
        'video',
    );

    foreach ( $r_post_formats_css as $post_format_css ) {

        if ( has_post_format( $post_format_css ) ) {
            $classes[] = $post_format_css. '-post-view';
        } else {
            $classes[] = 'standard-post-view';
        }
    }

    // Entry Name Type
    if ( ! get_the_title() ) {
        $classes[] = 'entry-name--default';
    }
    
    // Entry Author Avatar Ability Status
    if ( get_option( 'show_avatars' ) !== 0 ) {
        $classes[] = 'entry-author-avatar--1';
    }

    // Entry Categories Ability Status
    if ( has_category( '', $post->ID ) ) {
        $classes[] = 'entry-categories--1';
    }

    // Entry Tags Population Status
    if ( get_the_tag_list( '', '', '', $post->ID ) ) {
        $classes[] = 'entry-tags--1';
    }

    // Entry Banner Visuals / Featured Image Ability Status
    if ( '' !== get_the_post_thumbnail() ) {
        $classes[] = 'entry-banner-visuals--1';
    }

    // Entry Summary Content / Excerpt Ability Status
    if ( has_excerpt() ) {
        $classes[] = 'entry-summary-content--1';
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt_kid_entry_css_status_classes' );

// Entry CSS Status Classes added to HTML Element
add_filter( 'ntt_html_css_wp_filter', function( $classes ) {
    return is_singular() ? ntt_kid_entry_css_status_classes( $classes ) : $classes;
} );
*/
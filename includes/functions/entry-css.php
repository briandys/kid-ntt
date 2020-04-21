<?php
/**
 * Entry CSS
 */

function ntt__kid_ntt__function__entry__css( $classes ) {

    global $post;

    /**
     * Entry Name
     */

    if ( $post->post_title ) {
        $classes[] = 'ntt--'. $post->post_type. '--'. $post->post_name;
    }

    /**
     * Entry Type View
     */

    $classes[] = 'ntt--'. $post->post_type;
    
    /**
     * Entry Update Status
     */
    if ( get_the_modified_date( 'j F Y H i' ) !== get_the_date( 'j F Y H i' ) ) {
        $classes[] = 'ntt--entry---updated';
    }

    /**
     * Entry More Tag <!--more--> Ability Status
     */
    if ( strpos( $post->post_content, '<!--more-->' ) ) {
        $classes[] = 'ntt--entry-more-tag---1';
    }

    /**
     * Entry Author Default Avatar Status
     */

    if ( get_option( 'avatar_default' ) == 'blank' ) {
        $classes[] = 'ntt--entry-author-default-avatar---blank';
    } else {
        $classes[] = 'ntt--entry-author-default-avatar---custom';
    }

    /**
     * Entry Summary (Excerpt) Ability Status
     */

    if ( has_excerpt() ) {
        $classes[] = 'ntt--entry-summary-content---1';
    }

    /**
     * Entry Name Population Status
     */

    if ( ! get_the_title() ) {
        $classes[] = 'ntt--entry-name---empty';
    }

    /**
     * Entry Banner Visuals (Featured Image) Ability Status
     */

    if ( get_the_post_thumbnail() !== '' ) {
        $classes[] = 'ntt--entry-banner-visuals---1';
    } else {
        $classes[] = 'ntt--entry-banner-visuals---0';
    }

    /**
     * Sticky Post
     */

    if ( is_single() ) {

        if ( is_sticky() ) {
            $classes[] = 'ntt--entry---sticky';
        } else {
            $classes[] = 'ntt--entry---unsticky';
        }
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt__kid_ntt__function__entry__css' );

/**
 * Entry CSS added to HTML
 * 
 * Duplicated from ntt__kid_ntt__function__entry__css()
 */

function ntt__kid_ntt__function__entry_view__css( $classes ) {

    global $post;

    $css_suffix = '--view';

    /**
     * Entry ID
     */

    $classes[] = 'ntt--entry--'. $post->ID. $css_suffix;

    /**
     * Entry Name
     */

    if ( $post->post_title ) {
        $classes[] = 'ntt--'. $post->post_type. '--'. $post->post_name. $css_suffix;
    }

    /**
     * Entry Type View
     */

    $classes[] = 'ntt--'. $post->post_type. $css_suffix;
    
    /**
     * Entry Update Status
     */
    if ( get_the_modified_date( 'j F Y H i' ) !== get_the_date( 'j F Y H i' ) ) {
        $classes[] = 'ntt--entry---updated'. $css_suffix;
    }

    /**
     * Entry More Tag <!--more--> Ability Status
     */
    if ( strpos( $post->post_content, '<!--more-->' ) ) {
        $classes[] = 'ntt--entry-more-tag---1'. $css_suffix;
    }

    /**
     * Entry Author Default Avatar Status
     */

    if ( get_option( 'avatar_default' ) == 'blank' ) {
        $classes[] = 'ntt--entry-author-default-avatar---blank'. $css_suffix;
    } else {
        $classes[] = 'ntt--entry-author-default-avatar---custom'. $css_suffix;
    }

    /**
     * Entry Summary (Excerpt) Ability Status
     */

    if ( has_excerpt() ) {
        $classes[] = 'ntt--entry-summary-content---1'. $css_suffix;
    }

    /**
     * Entry Name Population Status
     */

    if ( ! get_the_title() ) {
        $classes[] = 'ntt--entry-name---empty'. $css_suffix;
    }

    /**
     * Entry Banner Visuals (Featured Image) Ability Status
     */

    if ( get_the_post_thumbnail() !== '' ) {
        $classes[] = 'ntt--entry-banner-visuals---1'. $css_suffix;
    } else {
        $classes[] = 'ntt--entry-banner-visuals---0'. $css_suffix;
    }

    /**
     * Sticky Post
     */

    if ( is_single() ) {

        if ( is_sticky() ) {
            $classes[] = 'ntt--entry---sticky'. $css_suffix;
        } else {
            $classes[] = 'ntt--entry---unsticky'. $css_suffix;
        }
    }
    
    return $classes;
}

add_filter( 'ntt__wp_filter__view_css', function( $classes ) {
    return is_singular() ? ntt__kid_ntt__function__entry_view__css( $classes ) : $classes;
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
        $classes[] = 'ntt--entry-banner-visuals---1';
    }

    // Entry Summary Content / Excerpt Ability Status
    if ( has_excerpt() ) {
        $classes[] = 'entry-summary-content--1';
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt_kid_entry_css_status_classes' );

// Entry CSS Status Classes added to HTML Element
add_filter( 'ntt__wp_filter__view_css', function( $classes ) {
    return is_singular() ? ntt_kid_entry_css_status_classes( $classes ) : $classes;
} );
*/
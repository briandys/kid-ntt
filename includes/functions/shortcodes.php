<?php
/**
 * WordPress Shortcodes
 */

/**
 * Enable the Text Widget and Custom HTML Widget to run WP Shortcodes
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * WordPress Shortcode Initialization
 * 
 * List down all WordPress Shortcodes functions and their corresponding shortcode name (the one enclosed in [brackets] and is used while composing entries).
 */
function ntt__kid_ntt__wp_shortcode__initialization() {
    
    $r_wp_shortcodes = array(
        'get_search_form'                                 => 'ntt_search_widget',
        'ntt__kid_ntt__wp_shortcode__percept'             => 'ntt_percept',
        'ntt__kid_ntt__wp_shortcode__nav_menu'            => 'ntt_menu',
        'ntt__kid_ntt__wp_shortcode__random_number'       => 'ntt_rand',
        'ntt__kid_ntt__wp_shortcode__htmlok'              => 'ntt_htmlok',
        'ntt__kid_ntt__wp_shortcode__tag'                 => 'ntt_tag',
        'ntt__kid_ntt__wp_shortcode__call_to_action'      => 'ntt_cta',
    );
    
    foreach ( $r_wp_shortcodes as $func => $wp_shortcode ) {
        add_shortcode( $wp_shortcode, $func );
    }
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__initialization' );

/**
 * NTT Percept Shortcode
 * 
 * Display content from posts, pages, and custom fields using a shortcode
 *
 * To display a particular post using ID: [ntt_percept post_id="<post ID>"]
 * To display a particular post using name: [ntt_percept post="<post name>"]
 * To display a particular page using ID: [ntt_percept page_id="<page ID>"]
 * To display a particular page using name: [ntt_percept page="<page name>"]
 * To display a custom field from the current entry: [ntt_percept "custom_field_name"]
 * To display a custom field from a particular entry: [ntt_percept post_id="<post ID>" "custom_field_name"]
 */
function ntt__kid_ntt__wp_shortcode__percept( $atts ) {
    
    $atts = array_change_key_case( ( array ) $atts, CASE_LOWER );
 
    // Shortcode Attributes
    $clean_atts = extract( shortcode_atts( array(
        'content'   => null,
        'post'      => null,
        'post_id'   => null,
        'page'      => null,
        'page_id'   => null,
        'security'  => null,
    ), $atts ) );
    
    // WP_Query Arguments
    $args = array(
        'post_status'   => array( 'publish', 'private' ),
        'name'          => sanitize_title( $post ),
        'p'             => $post_id,
        'pagename'      => sanitize_title( $page ),
        'page_id'       => $page_id,
	);
    
    // From Custom Fields
    if ( $content !== null || isset( $atts[0] ) ) {
		
		// If content = '' is set
        if ( $content !== null && ! isset( $atts[0] ) ) {
            $content = $content;
        // If root attribute is set
        } else if ( $content === null && isset( $atts[0] ) ) {
            $content = esc_attr( $atts[0] );
        }
        
        // If no Post is defined, use the current Post
        if ( $post === null && $post_id === null && $page === null && $page_id === null ) {
            global $post;
            $post_id = $post->ID;        
        // If Post ID or Name is defined, get the ID of that
        } else {
            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $post_id = get_the_id();
                }
                wp_reset_postdata();
            }
        }

        if ( $security === 'private' ) {
        
            if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) {
                return wpautop( get_post_meta( $post_id, $content, true ) );
            } else {
                return;
            }
        } else {
            return wpautop( get_post_meta( $post_id, $content, true ) );
        }
	
	// From Content
	} else {
        
        // Gatekeeper
        if ( $post === null && $post_id === null && $page === null && $page_id === null ) {
            return;
        }

        // References: https://wordpress.org/plugins/insert-pages/        
        $old_query = $GLOBALS['wp_query'];
        $posts = query_posts( $args );

        if ( have_posts() ) {
        
            ob_start();
            the_post();

            $section_mu = '<article class="ntt--percept---'. esc_attr( '%3$s' ). ' '. 'ntt--'. esc_attr( '%3$s' ). ' '. 'ntt--percept ntt--'. esc_attr( '%4$s' ). ' '. 'ntt--entry ntt--cp" data-source-url="'. esc_url( get_the_permalink() ).'" data-name="NTT Percept">';
                $section_mu .= '<h1 class="ntt--percept--entry-name ntt--entry-name ntt--obj" data-name="NTT Percept Entry Name">';
                    $section_mu .= '<a href="'. esc_url( get_the_permalink() ).'">'. esc_html( '%2$s' ). '</a>';
                $section_mu .= '</h1>';
                $section_mu .= '<div class="ntt--percept--entry-content ntt--entry-content ntt--content ntt--cp" data-name="NTT Percept Entry Content">';                
                    $section_mu .= esc_html( '%1$s' );
                $section_mu .= '</div>';
            $section_mu .= '</article>';

            global $post;

            $percept_section = printf( $section_mu,
                apply_filters( 'the_content', do_shortcode( get_the_content() ) ),
                get_the_title(),
                sanitize_title( $post->post_type ). '--'. sanitize_title( $post->post_name ),
                sanitize_title( $post->post_type )
            );

            $percept_section = ob_get_clean();
        }
        $GLOBALS['wp_query'] = $old_query; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        wp_reset_postdata();
        
        return $percept_section;
    }
}

/**
 * Menu Shortcode
 * Call menu using a shortcode
 * Usage: [ntt_menu "Menu Name"]
 */
function ntt__kid_ntt__wp_shortcode__nav_menu( $atts ) {

    if ( ! isset( $atts[0] ) ) {
        return;
    } else {
        $name = $atts[0];
    }

    $menu = wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
    
	return $menu;
}

/**
 * Random Numbers
 * 
 * Generates random numbers
 * Defaults at 2 random digits
 * 
 * Usage: [ntt_rand]
 * Setting at 4 digits: [ntt_rand 4]
 */
function ntt__kid_ntt__wp_shortcode__random_number( $atts ) {
    
    if ( ! isset( $atts[0] ) ) {
        $digits = '2';
    } else {
        $digits = $atts[0];
    }
    
    return substr( mt_rand(), 0, $digits );
}

// ------------------------------------ NTT HTML_OK Shortcode
// [ntt_htmlok name="Name"]Content[/ntt_htmlok]
// https://developer.wordpress.org/plugins/shortcodes/shortcodes-with-parameters/#complete-example

function ntt__kid_ntt__wp_shortcode__htmlok( $atts, $content = null, $tag = '' ) {

    $atts = array_change_key_case( ( array ) $atts, CASE_LOWER );
 
    $atts = shortcode_atts( array(
        'name' => 'HTML_OK',
    ), $atts, $tag );
 
    $o = '<div id="'. sanitize_title( $atts['name'] ). '" class="cp'. ' '. sanitize_title( $atts['name'] ). ' '. 'ntt-html-ok-shortcode'. '" data-name="'. esc_html( $atts['name'] ). ' CP">';
        $o .= '<div class="cr'. ' '. sanitize_title( $atts['name'] ). '---cr">';
            $o .= '<div class="h">' . esc_html__( $atts['name'], 'kid-ntt' ). '</div>';
            $o .= '<div class="ct'. ' '. sanitize_title( $atts['name'] ). '---ct">';

            if ( ! is_null( $content ) ) {
                $o .= do_shortcode( $content );
            }

            $o .= '</div>';
        $o .= '</div>';
    $o .= '</div>';
 
    return $o;
}

/**
 * NTT Call to Action
 *
 * Usage: [ntt_cta "Click me!" href="#" class="button"]
 *
 */
function ntt__kid_ntt__wp_shortcode__call_to_action( $atts ) {

    $atts = array_change_key_case( ( array ) $atts, CASE_LOWER );

    // Shortcode Attributes
    $clean_atts = extract( shortcode_atts( array(
        'class' => 'button',
        'href'  => '#',
    ), $atts ) );

    if ( ! isset( $atts[0] ) ) {
        return;
    } else {
        $content = $atts[0];
    }

    if ( $class === 'button' ) {
        $mu_s = '<div class="ntt--cta-obj ntt--obj">';
        $mu_e = '</div>';
    } else {
        $mu_s = '';
        $mu_e = '';
    }

    $cta = $mu_s. '<a href="'. esc_attr( $href ). '" class="ntt--cta'. ' '. 'ntt--cta-'. esc_attr( $class ).'">'. esc_html( $content ). '</a>'. $mu_e;

    return $cta;
}

/**
 * NTT Tag Shortcode
 *
 * Usage: [ntt_tag "[tag]"]
 *
 */
function ntt__kid_ntt__wp_shortcode__tag( $atts ) {
    
    extract( shortcode_atts( array(
        'post_id' => NULL,
    ), $atts ) );
    
    if ( ! isset( $atts[0] ) ) {
        return;
    }
    
    $field = $atts[0];
    $tag = get_term_by( 'slug', $field, 'post_tag' );
    
    if ( $tag ) {
        $tag_id = $tag->term_id;
        $tag_link = get_tag_link( $tag_id );
        
        $tag_display = '<a class="ntt--entry-tag" href="'. $tag_link. '" rel="tag">'. esc_html( $field ). '</a>';
    } else {
        $tag_display = '<span class="ntt--entry-tag---untagged">'. esc_html( $field ). '</span>';
    }
    
    return $tag_display;
}
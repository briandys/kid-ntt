<?php
/**
 * WordPress Shortcodes
 */

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
        'ntt__kid_ntt__wp_shortcode__email_anti_spambots' => 'ntt_email',
        'applicator_htmlok_shortcode'                     => 'applicator_htmlok_cp',
        'applicator_tag_shortcode'                        => 'applicator_tag',
    );
    
    foreach ( $r_wp_shortcodes as $func => $wp_shortcode ) {
        add_shortcode( $wp_shortcode, $func );
    }
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__initialization' );

/**
 * NTT Percept Shortcode
 * 
 * Display any content using a shortcode
 *
 * To display a particular entry: [ntt_percept post_id="<post id>"]
 * To display a custom field: [ntt_percept "custom_field_name"]
 * To display a custom field from a particular entry: [ntt_percept post_id="<post id>" "custom_field_name"]
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
        } elseif ( $content === null && isset( $atts[0] ) ) {
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
            }
            wp_reset_postdata();
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
 * 
 * Call menu using a shortcode
 * 
 * Usage: [ntt_menu name="menu-name"]
 */
function ntt__kid_ntt__wp_shortcode__nav_menu( $atts, $content = null ) {
	extract( shortcode_atts( array( 'name' => null, ), $atts ) );
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
        $digits = esc_attr( $atts[0] );
    }
    
    return substr( rand(), 0, $digits );
}

/**
 * Hide email from Spam Bots using a shortcode.
 *
 * @param array  $atts    Shortcode attributes. Not used.
 * @param string $content The shortcode content. Should be an email address.
 *
 * @return string The obfuscated email address. 
 */
function ntt__kid_ntt__wp_shortcode__email_anti_spambots( $atts , $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	$content = antispambot( $content );

	$email_link = sprintf( 'mailto:%s', $content );

	return sprintf( '<a href="%s">%s</a>', esc_url( $email_link, array( 'mailto' ) ), esc_html( $content ) );
}
add_shortcode( 'email', 'ntt__kid_ntt__wp_shortcode__email_anti_spambots' );

/**
 * Enable the Text Widget and Custom HTML Widget to run WP Shortcodes
 */
add_filter( 'widget_text', 'do_shortcode' );

// ------------------------------------ Applicator HTML_OK Shortcode
// [applicator_htmlok_cp name="Name"]Content[/applicator_htmlok_cp]
// https://developer.wordpress.org/plugins/shortcodes/shortcodes-with-parameters/#complete-example

function applicator_htmlok_shortcode( $atts = [], $content = null, $tag = '' )
{
    $atts = array_change_key_case( ( array ) $atts, CASE_LOWER );
 
    $htmlok_atts = shortcode_atts( [
        'name' => 'HTML_OK',
    ], $atts, $tag );
 
    $o = '';
 
    $o .= '<div id="'. sanitize_title( $htmlok_atts['name'] ). '" class="cp'. ' '. sanitize_title( $htmlok_atts['name'] ). ' '. 'applicator-html-ok-shortcode'. '" data-name="'. esc_html( $htmlok_atts['name'] ). ' CP">';
        $o .= '<div class="cr'. ' '. sanitize_title( $htmlok_atts['name'] ). '---cr">';
            $o .= '<div class="h">' . esc_html__( $htmlok_atts['name'], 'applicator' ). '</div>';
            $o .= '<div class="ct'. ' '. sanitize_title( $htmlok_atts['name'] ). '---ct">';

            if ( ! is_null( $content ) )
            {
                $o .= do_shortcode( $content );
            }

            $o .= '</div>';
        $o .= '</div>';
    $o .= '</div>';
 
    return $o;
}

/**
 *
 * Applicator Tag Shortcode
 *
 * Usage: [applicator_tag "[tag]"]
 *
 * @package WordPress\Applicator\Plugin\Function\Shortcode
 *
 * @version 1.0.0
 *
 */
function applicator_tag_shortcode( $atts )
{
    extract( shortcode_atts( array(
        'post_id' => NULL,
    ), $atts ) );
    
    if ( !isset( $atts[0] ) )
    {
        return;
    }
    
    $field = esc_attr( $atts[0] );
    
    $tag = get_term_by( 'slug', $field, 'post_tag' );
    
    $tag_display = '';
    
    if ( $tag )
    {
        $tag_id = $tag->term_id;
        $tag_link = get_tag_link( $tag_id );
        
        $tag_display = '<a class="tag" href="'. $tag_link. '">'. $field. '</a>';
    }
    else
    {
        $tag_display = '<span class="untagged">'. $field. '</span>';
    }
    
    return $tag_display;
}
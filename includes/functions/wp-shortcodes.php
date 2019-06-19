<?php
/**
 * Enable the Text Widget and Custom HTML Widget to run WP Shortcodes
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Shortcode Initialization
 */
function ntt_kid_shortcodes_init() {
    $r_wp_shortcodes = array(
        'ntt_kid_percept_wp_shortcode'                  => 'ntt_percept',
        'ntt_kid_menu_wp_shortcode'                     => 'ntt_menu',
        'get_search_form'                               => 'ntt_search_widget',
        'ntt_kid_random_number_wp_shortcode'            => 'ntt_rand',
        'ntt_kid_hide_email_from_spambots_wp_shortcode' => 'ntt_email',
    );
    
    foreach ( $r_wp_shortcodes as $func => $wp_shortcode ) {
        add_shortcode( $wp_shortcode, $func );
    }
}
add_action( 'init', 'ntt_kid_shortcodes_init' );

/**
 * Menu Shortcode
 * 
 * Call menu using a shortcode
 * 
 * Usage: [ntt_menu name="menu-name"]
 */
function ntt_kid_menu_wp_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 'name' => null, ), $atts ) );
	$menu = wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
	return $menu;
}

/**
 * NTT Percept Shortcode
 * 
 * Call any content using a shortcode
 *
 * Usage: [ntt_percept post_id="<post id>"]
 */
function ntt_kid_percept_wp_shortcode( $atts ) {
    
    $atts = array_change_key_case( ( array ) $atts, CASE_LOWER );
 
    $clean_atts = extract( shortcode_atts( array(
        'content'   => null,
        'post'      => null,
        'post_id'   => null,
        'page'      => null,
        'page_id'   => null,
        'security'  => null,
    ), $atts ) );
    
    $args = array(
        'post_status'   => 'publish',
        'name'          => sanitize_title( $post ),
        'p'             => $post_id,
        'pagename'      => sanitize_title( $page ),
        'page_id'       => $page_id,
	);

    
    // From Custom Fields
    if ( null !== $content || isset( $atts[0] ) ) {
		
		// If content = '' is set
        if ( null !== $content && ! isset( $atts[0] ) ) {
            $content = $content;
        // If root attribute is set
        } elseif ( null === $content && isset( $atts[0] ) ) {
            $content = esc_attr( $atts[0] );
        }
        
        // If no Post is defined, use the current Post
        if ( null === $post && null === $post_id && null === $page && null === $page_id ) {
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
        if ( null === $post && null === $post_id && null === $page && null === $page_id ) {
            return;
        }
        
        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) {
			
			while ( $the_query->have_posts() ) {
			
				$the_query->the_post();

                $section_mu = '<div class="ntt-percept ntt-percept--'. '%3$s'.' cp" data-source-url="'. esc_url( get_the_permalink() ).'" data-name="NTT Percept">';
                    $section_mu .= '<div class="cr">';
                        $section_mu .= '<div class="ntt-percept-name obj">'. esc_html( '%2$s' ). '</div>';
                        $section_mu .= '<div class="ntt-percept-content cp" data-name="NTT Percept Content">';
                            $section_mu .= '<div class="ntt-percept-content---cr">';
						        $section_mu .= '%1$s';
					        $section_mu .= '</div>';
                        $section_mu .= '</div>';
					$section_mu .= '</div>';
				$section_mu .= '</div>';

                $percept_section = sprintf( $section_mu,
                    apply_filters( 'the_content', do_shortcode( get_the_content() ) ),
                    get_the_title(),
                    sanitize_title( get_the_title() )
                );
                
                return $percept_section;
            }
        }
        wp_reset_postdata();
    }
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
function ntt_kid_random_number_wp_shortcode( $atts ) {
    
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

function ntt_kid_hide_email_from_spambots_wp_shortcode( $atts , $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	$content = antispambot( $content );

	$email_link = sprintf( 'mailto:%s', $content );

	return sprintf( '<a href="%s">%s</a>', esc_url( $email_link, array( 'mailto' ) ), esc_html( $content ) );
}
add_shortcode( 'email', 'ntt_kid_hide_email_from_spambots_wp_shortcode' );
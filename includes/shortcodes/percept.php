<?php
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
        'name'          => sanitize_text_field( $post ),
        'p'             => $post_id,
        'pagename'      => sanitize_text_field( $page ),
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

            $mu = '<article class="ntt--percept---'. esc_attr( '%3$s' ). ' '. 'ntt--'. esc_attr( '%3$s' ). ' '. 'ntt--percept ntt--'. esc_attr( '%4$s' ). ' '. 'ntt--entry ntt--cp" data-source-url="'. esc_url( get_the_permalink() ).'" data-name="NTT Percept">';
                $mu .= '<h1 class="ntt--percept--entry-name ntt--entry-name ntt--obj" data-name="NTT Percept Entry Name">';
                    $mu .= '<a href="'. esc_url( get_the_permalink() ).'">'. esc_html( '%2$s' ). '</a>';                    
                $mu .= '</h1>';
                $mu .= do_shortcode( '[ntt_subtitle]' );
                $mu .= '<div class="ntt--percept--entry-content ntt--entry-content ntt--content ntt--cp" data-name="NTT Percept Entry Content">';                
                    $mu .= esc_html( '%1$s' );
                $mu .= '</div>';
            $mu .= '</article>';

            global $post;

            if ( has_shortcode( $post->post_content, 'ntt_percept' ) ) {
                remove_filter( 'the_content', 'wpautop' );
            }

            $percept = printf( $mu,
                apply_filters( 'the_content', do_shortcode( get_the_content() ) ),
                get_the_title(),
                sanitize_title( $post->post_type ). '--'. sanitize_title( $post->post_name ),
                sanitize_title( $post->post_type )
            );

            $percept = ob_get_clean();
        
        } else {
            ob_start();
            $percept = ntt__kid_ntt__tag__content_none();
            $percept = ob_get_clean();
        }
        $GLOBALS['wp_query'] = $old_query; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        wp_reset_postdata();
        
        return $percept;
    }
}

function ntt__kid_ntt__wp_shortcode__percept__initialization() {
    add_shortcode( 'ntt_percept', 'ntt__kid_ntt__wp_shortcode__percept' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__percept__initialization' );
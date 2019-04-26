<?php
/**
 * Open Graph XMLNS
 */
function ntt_kid_open_graph_xmlns( $output ) {
    return $output. '
    xmlns="https://www.w3.org/1999/xhtml"
    xmlns:og="https://ogp.me/"
    ';
}
add_filter( 'language_attributes', 'ntt_kid_open_graph_xmlns' );

/**
 * Open Graph
 */
function ntt_kid_open_graph() {

    /*
    For Home
    Plural View
    Singular View

    For Image:
    4. Banner Image
    5. Background Image
    6. Default Image
    */

    if ( is_singular() ) {
        global $post;
    
        // Open Graph Array
        $og = array(
            'title'     => get_the_title(),
            'type'      => 'article',
            'url'       => get_permalink(),
            'site_name' => get_bloginfo( 'name' ),
        );
    
        // Open Graph
        foreach ( $og as $key => $value ) {
            echo '<meta property="og:'. $key.'" content="'. $value.'" />';
        }

        /**
         * Get Image
         * 
         * 1. Featured Image
         * 2. First Image in Content
         * 3. Custom Logo
         * 
         * https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
         * https://wordpress.stackexchange.com/a/302166
         * https://stackoverflow.com/a/7082487
         * 
         * $image_meta = wp_get_attachment_metadata( get_post_thumbnail_id( $post->ID ) );
         * $image_width = $image_meta['sizes']['medium']['width'];
         * $image_height = $image_meta['sizes']['medium']['height'];
         */
        if ( has_post_thumbnail( $post->ID ) ) {
            $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            $image_meta = wp_get_attachment_metadata( get_post_thumbnail_id( $post->ID ) );
            $image_width = $image_meta['sizes']['medium']['width'];
            $image_height = $image_meta['sizes']['medium']['height'];

            $image_src = $image_src[0];
            //$image_width = $image_src[1];
            //$image_height = $image_src[2];
        } elseif ( $content = $post->post_content) {
            $dom = new DOMDocument;
            libxml_use_internal_errors( true );
            $dom->loadHTML( $content );
            libxml_clear_errors();
            $images = $dom->getElementsByTagName( 'img' );
            $image = $images->item(0);

            if ( $image ) {
                $image_src = $image->getAttribute( 'src' );
                $image_width = $image->getAttribute( 'width' );
                $image_height = $image->getAttribute( 'height' );
            } elseif ( has_custom_logo() ) {
                $image_src = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'medium' );
                
                $image_src = $image_src[0];
                $image_width = $image_src[1];
                $image_height = $image_src[2];
            } else {
                $image_src = '';
                $image_width = '';
                $image_height = '';
            }
        } else {
            $image_src = '';
            $image_width = '';
            $image_height = '';
        }

        /**
         * Get Meta Description
         * 
         * 1. Excerpt
         * 2. Content
         * 3. Site Description
         */
        if ( $excerpt = $post->post_excerpt ) {
            $meta_description = $excerpt;
        } elseif ( $content = $post->post_content ) {
            $meta_description = $content;
        } elseif ( $description = get_bloginfo( 'description' ) ) {
            $meta_description = $description;
        } else {
            $meta_description = '';
        }

        /*
        // Get Open Graph Image
        if ( has_post_thumbnail( $post->ID ) ) {
            $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            $image_src = $image_src[0];
        } else {
            
            if ( $content = $post->post_content) {
                $dom = new DOMDocument;
                libxml_use_internal_errors( true );
                $dom->loadHTML( $content );
                libxml_clear_errors();
                $images = $dom->getElementsByTagName( 'img' );
                $image = $images->item(0);

                if ( $image ) {
                    $image_src = $image->getAttribute( 'src' );
                }
            }
        }
        */
        
        
    
    // For Plural Entries
    } else {
        $og = array(
            'title' => get_bloginfo( 'name' ),
            'type'  => 'website',
            'url'   => home_url( '/' ),
        );
    
        foreach ( $og as $key => $value ) {
            echo '<meta property="og:'. $key.'" content="'. $value. '" />';
        }

        // Get Open Graph Image
        if ( has_custom_logo() ) {
            $image_src = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'medium' );
            $image_src = $image_src[0];
        } elseif ( has_header_image() ) {
            $image_src = get_header_image();
        } else {
            $image_src = '';
        }

        // Get Meta Description
        if ( $description = get_bloginfo( 'description' ) ) {
            $meta_description = $description;
        } else {
            $meta_description = '';
        }
    }

    // Echo Open Graph Image
    if ( $image_src !== '' ) {
        echo '<meta property="og:image" content="'. esc_attr( $image_src ).'" />';
        echo '<meta property="og:image:width" content="'. esc_attr( $image_width ).'" />';
        echo '<meta property="og:image:height" content="'. esc_attr( $image_height ).'" />';
    }

    // Echo Meta Description
    if ( $meta_description !== '' ) {
        $meta_description = wp_trim_words( strip_shortcodes( $meta_description ), 55 );
        echo '<meta name="description" content="'. esc_attr( $meta_description ). '">';
    }
}
add_action( 'wp_head', 'ntt_kid_open_graph' );
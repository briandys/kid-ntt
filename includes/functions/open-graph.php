<?php
/**
 * Open Graph XMLNS
 */
function ntt__kid_ntt__function__open_graph_xmlns( $output ) {
    return $output. 'xmlns="https://www.w3.org/1999/xhtml" xmlns:og="https://ogp.me/"';
}
add_filter( 'language_attributes', 'ntt__kid_ntt__function__open_graph_xmlns' );

/**
 * Open Graph
 */
function ntt__kid_ntt__function__open_graph() {

    $image_src = '';
    $image_width = '';
    $image_height = '';
    $meta_description = '';

    /*
    For Home
    Plural View
    Singular View

    For Image:
    4. Banner Image
    5. Background Image
    6. Default Image
    */

    // Singular
    if ( is_singular() ) {
        
        $og = array(
            'title'     => get_the_title(),
            'type'      => 'article',
            'url'       => get_permalink(),
            'site_name' => get_bloginfo( 'name' ),
        );
    
        foreach ( $og as $key => $value ) {
            echo '<meta property="og:'. $key.'" content="'. $value.'" />';
        }

        /**
         * Get Image
         * 
         * Priority List
         * 1. Featured Image via custom fields
         * 2. Featured Image
         * 3. First Image in Content
         * 4. Custom Logo
         * 
         * https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
         * https://wordpress.stackexchange.com/a/302166
         * https://stackoverflow.com/a/7082487
         */
        global $post;
        $post_meta = get_post_meta( get_the_ID(), 'ntt_featured_image', true );
        $content = $post->post_content;
        
        if ( $image = ntt__function__image_tag__getter( $post_meta ) ) {
            $image_src = $image['src'];
            $image_width = $image['width'];
            $image_height = $image['height'];
        } else if ( has_post_thumbnail( $post->ID ) ) {
            $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            $image_meta = wp_get_attachment_metadata( get_post_thumbnail_id( $post->ID ) );

            $image_src = $image_src[0];
            $image_width = $image_meta['sizes']['medium']['width'];
            $image_height = $image_meta['sizes']['medium']['height'];
        } else if ( $image = ntt__function__image_tag__getter( $content ) ) {

            if ( $image ) {
                $image_src = $image['src'];
                $image_width = $image['width'];
                $image_height = $image['height'];
            }
        } else if ( has_custom_logo() ) {
            $get_image_src = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'medium' );

            $image_src = $get_image_src[0];
            $image_width = strval( $get_image_src[1] );
            $image_height = strval( $get_image_src[2] );
        }

        /**
         * Get Meta Description
         * 
         * Priority List
         * 
         * 1. Excerpt
         * 2. Content
         * 3. Site Description
         * 4. Current Theme Description
         * 5. Parent Theme Description
         */
        if ( $excerpt = $post->post_excerpt ) {
            $meta_description = $excerpt;
        } else if ( $content = $post->post_content ) {
            $meta_description = $content;
        } else if ( $description = get_bloginfo( 'description' ) ) {
            $meta_description = $description;
        } else if ( $description = wp_get_theme()->get( 'Description' ) ) {
            $meta_description = $description;
        } else if ( $description = wp_get_theme( get_template() )->get( 'Description' ) ) {
            $meta_description = $description;
        } else {
            $meta_description = '';
        }
    
    // Plural
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
            $get_image_src = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'medium' );
            
            $image_src = $get_image_src[0];
            $image_width = strval( $get_image_src[1] );
            $image_height = strval( $get_image_src[2] );
        } else if ( has_header_image() ) {
            $image_src = get_header_image();
        }

        /**
         * Get Meta Description
         * 
         * Priority List
         * 
         * 1. Site Description
         * 2. Current Theme Description
         * 3. Parent Theme Description
         */
        if ( $description = get_bloginfo( 'description' ) ) {
            $meta_description = $description;
        } else if ( $description = wp_get_theme()->get( 'Description' ) ) {
            $meta_description = $description;
        } else if ( $description = wp_get_theme( get_template() )->get( 'Description' ) ) {
            $meta_description = $description;
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
add_action( 'wp_head', 'ntt__kid_ntt__function__open_graph' );
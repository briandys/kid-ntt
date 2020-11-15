<?php
function ntt__function__image_tag__getter( $content = NULL ) {
    
    if ( $content ) {
        $content = mb_strcut( $content, 0, 4000 );
        $dom = new DOMDocument;
        libxml_use_internal_errors( true );
        $dom->loadHTML( $content );
        libxml_clear_errors();
        $images = $dom->getElementsByTagName( 'img' );
        $image = $images->item( 0 );

        if ( $image = $images->item( 0 ) ) {
            $image_src = NULL;
            $image_width = NULL;
            $image_height = NULL;

            if ( $image_src = $image->getAttribute( 'src' ) ) {
                $image_src;
            }

            if ( $image_width = $image->getAttribute( 'width' ) ) {
                $image_width;
            }

            if ( $image_height = $image->getAttribute( 'height' ) ) {
                $image_height;
            }

            $image = array(
                'src'       => $image_src,
                'width'     => $image_width,
                'height'    => $image_height,
            );
            
            return $image;
        }
    }
}
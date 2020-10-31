<?php

/**
* Page Template: Sub-Pages
 */

function ntt__kid_ntt__function__sub_pages() {
    
    if ( is_page_template( 'templates/sub-pages.php' ) ) {   
        
        global $post;
        $args = array(
            'post_type'         => 'page',
            'post_status'       => 'publish',
            'post_parent'       => $post->ID,
            'orderby'           => 'menu_order',
            'order'             => 'ASC',
            'posts_per_page'    => -1,
        );

        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) {   
            
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                get_template_part( 'content', get_post_format() );
            }
            wp_reset_postdata();
        }
    }
}
add_action( 'ntt__wp_hook__entry_full_content___after', 'ntt__kid_ntt__function__sub_pages' );
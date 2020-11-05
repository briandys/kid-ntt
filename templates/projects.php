<?php
// Template Name: Subject Matter
// Displays the categories with the same slug as the page name that uses this template
?>

    <div class="ct main-content---ct">
        <div class="mn main-content---mn" data-main-name="Main Content MAIN">

            <?php

            while ( have_posts() ) {

                the_post();
                ntt__tag__entry_content();
            }
            
            
            // Paged
            if ( get_query_var( 'paged' ) )
            {
                $paged = get_query_var( 'paged' );
            }
            elseif ( get_query_var( 'page' ) )
            {
                $paged = get_query_var( 'page' );
            }
            else
            {
                $paged = 1;
            }            
            
            // Override via Custom Fields
            $category_name_post_meta = get_post_meta( get_the_ID(), 'Category Name', true );
    
            if ( $category_name_post_meta )
            {
                $category_name = wp_strip_all_tags( $category_name_post_meta );
            }
            
            // Or the Post's slug
            else
            {
                $category_name = $post->post_name;
            }
            
            
            // Query Arguments
            $args = array(
                'posts_per_page'        => get_option( 'posts_per_page' ),
                'ignore_sticky_posts'   => true,
                'category_name'         => $category_name,
                'paged'                 => $paged,
            );
                        
            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() )
            {
                
                while ( $the_query->have_posts() )
                {   
                    $the_query->the_post();
                    ntt__tag__entry_content();
                    
                    $big = 999999999; 
                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var( 'paged' ) ),
                        'total' => $the_query->max_num_pages,
                        
                        'show_all'              => true,
                        'mid_size'              => 0,

                        'type'                  => 'list',

                        'before_page_number'    => '',
                        'after_page_number'     => '',

                        'prev_text'             => 'Previous',
                        'next_text'             => 'Next',
                    ) );
                }
                wp_reset_postdata();
            }
            ?>

        </div>
    </div>
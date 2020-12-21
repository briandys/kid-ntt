<?php

function ntt__kid_ntt__wp_shortcode__taxonomy_query( $atts ) {
    
    $atts = array_change_key_case( ( array ) $atts, CASE_LOWER );
 
    // Shortcode Attributes
    $clean_atts = extract( shortcode_atts( array(
        'name'                  => null,
        'heading'               => null,
        'category'              => '',
        'category_heading'      => null,
        'tag'                   => '',
        'tag_heading'           => null,
        'relation'              => null,
        'posts_per_page'        => -1,
        'ignore_sticky_posts'   => 1,
    ), $atts ) );
    
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    
    // Category AND Tag Arguments
    $taxonomy_args = array(
        'category_name'  => $category,
        'tag'            => $tag,
    );
    
    // Category OR Tag Arguments
    if ( $relation === 'or' ) {
        $taxonomy_args = array(
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category,
                ),
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'slug',
                    'terms' => $tag,
                ),
            ),
        );
    }

    // Default Arguments
    $default_args = array(
        'posts_per_page'        => $posts_per_page,
        'ignore_sticky_posts'   => $ignore_sticky_posts,
        'paged'                 => $paged,
    );
    
    $args = array_merge( $default_args, $taxonomy_args );

    $query = new WP_Query( $args );
    $total_pages = $query->max_num_pages;
    $old_query = $GLOBALS['wp_query'];
    $posts = query_posts( $args );

    if ( $name !== null ) {
        $css = 'ntt--taxonomy-query--'. sanitize_title( $name ). ' ';
        $css_content = 'ntt--taxonomy-query--'. sanitize_title( $name ). '--content'. ' ';
    } else {
        $css = '';
        $css_content = '';
    }
    
    ob_start();
    
    if ( ( $category !== null || $tag !== null ) && have_posts() ) {

        if ( $heading !== null ) {
            $tag = 'section';
        } else {
            $tag = 'div';
        }
        ?>
        
        <<?php echo $tag; ?> class="<?php echo $css; ?>ntt--taxonomy-query ntt--cp" data-name="NTT Taxonomy Query">
            
            <?php
            // Heading
            if ( $heading !== null ) {
                echo '<h2 class="ntt--taxonomy-query--name ntt--obj" data-name="NTT Taxonomy Query Name">'. $heading. '</h2>';
            } else if ( $category_heading !== null ) {
                ntt__tag__entry_category_heading( $category_heading );
            } else if ( $tag_heading !== null ) {
                ntt__tag__entry_tag_heading( $tag_heading );
            }            
            ?>

            <?php // Content ?>
            <div class="<?php echo $css_content; ?>ntt--taxonomy-query-content ntt--cp" data-name="NTT Taxonomy Query Content">
                <?php
                while ( have_posts() ) {            
                    the_post();            
                    ntt__kid_ntt__tag__snippet_entry();
                }
                ?>
            </div>
            
            <?php
            if ( $posts_per_page != -1 ) {
                ntt__tag__entries_custom_nav( $total_pages );
            }
            
            $GLOBALS['wp_query'] = $old_query; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            wp_reset_postdata();
            ?>
        </<?php echo $tag; ?>>
    <?php
    
    } else {
        $mu = ntt__kid_ntt__tag__content_none();
    }
    
    $mu = ob_get_clean();

    return $mu;
}

function ntt__kid_ntt__wp_shortcode__taxonomy_query__initialization() {
    add_shortcode( 'ntt_taxonomy_query', 'ntt__kid_ntt__wp_shortcode__taxonomy_query' );    
}
add_action( 'init', 'ntt__kid_ntt__wp_shortcode__taxonomy_query__initialization' );

/**
 * View CSS
 */
function ntt__kid_ntt__wp_shortcode__taxonomy_query__view__css( $classes ) {

    $classes[] = 'ntt--entry-pseudo-index--view';

    return $classes;
}
add_filter( 'ntt__wp_filter__view_css', 'ntt__kid_ntt__wp_shortcode__taxonomy_query__view__css' );
<?php
/**
 * Functions Page
 */
function ntt_kid_functions_page() {

    $page_name = 'functions';
    $category_name = $page_name;

    if ( is_page( $page_name ) ) {

        // There's a conflict in the usage of <!--nextpage--> and WP Custom Query Navigation; use one over the other
        if ( wp_link_pages( array( 'echo' => false, ) ) ) {
            // Display all
            $posts_per_page = -1;
        } else {
            // Display based on Settings
            $posts_per_page = get_option( 'posts_per_page' );
        }

        if ( get_query_var( 'paged' ) ) {
            $paged = get_query_var( 'paged' );
        } elseif ( get_query_var( 'page' ) ) {
            $paged = get_query_var( 'page' );
        } else {
            $paged = 1;
        }

        $args = array(
            'orderby'               => 'title',
            'order'                 => 'ASC',
            'category_name'         => $category_name,
            'post_status'           => 'publish',
            'post_type'             => 'post',
            'posts_per_page'        => $posts_per_page,
            'paged'                 => $paged,
        );

        $the_query = new WP_Query( $args );
        $total_pages = $the_query->max_num_pages;

        if ( $the_query->have_posts() ) {
            ?>
            <div class="sub-content-entries cp" data-name="Sub-Content Entries">
                <div class="sub-content-entries---cr">
                    <div class="sub-content-entries-name obj">
                            <span class="txt"><?php esc_html_e( 'Sub-Content Entries', 'ntt' ); ?></span>
                        </div>
                    <div class="sub-content-entries-group cp">
                        <div class="sub-content-entries-group---cr">
                            <?php
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                global $post;
                                ?>
                                <div id="sub-content-entry-<?php the_id(); ?>" class="sub-content-entry-<?php the_id(); ?> sub-content-entry cp" data-name="Sub-Content Entry">
                                    <div class="sub-content-entry---cr">
                                        <div class="sub-content-entry-name obj">
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="u-url">
                                                <span class="txt"><?php the_title(); ?></span>
                                            </a>
                                        </div>
                                        <?php if ( $post->ntt_description ) {
                                            ?>
                                            <div class="sub-content-entry-description obj" data-name="Sub-Content Entry Description">
                                                <?php echo wpautop( $post->ntt_description ); ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                ?>
                        </div>
                    </div>
                    <?php
                    if ( $total_pages > 1 ) {
                        ntt_sub_content_nav( $total_pages );
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    }
}
add_action( 'ntt_after_the_content_wp_hook', 'ntt_kid_functions_page' );

/**
 * Sub-Content Entry Count
 */
function ntt_kid_sub_content_entry_count() {

    $page_name = 'functions';
    $category_name = $page_name;

    if ( is_page( $page_name ) ) {
        $args = array(
            'category_name' => $category_name,
            'post_status'   => 'publish',
            'post_type'     => 'post',
        );

        ntt_entry_count( $args, 'Sub-Content', 'sub-content' );
    }
}
add_action( 'ntt_after_entry_name_wp_hook', 'ntt_kid_sub_content_entry_count', 0 );

/**
 * Function Page Entry CSS
 */
function ntt_kid_functions_page_entry_css( $classes ) {

    $page_name = 'functions';

    if ( is_page( $page_name ) ) {
        $classes[] = 'entry--sub-content-entries-parent';
    }
    
    return $classes;
}
add_filter( 'post_class', 'ntt_kid_functions_page_entry_css' );

/**
 * Entry CSS added to HTML
 */
add_filter( 'ntt_html_css_wp_filter', function( $classes ) {
    return is_singular() ? ntt_kid_functions_page_entry_css( $classes ) : $classes;
} );
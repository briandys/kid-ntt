<?php
/**
 * Functions
 */

/**
 * Child Theme Settings
 */
$GLOBALS['ntt_child_theme_name'] = 'Kid NTT';
$GLOBALS['ntt_child_theme_url'] = '//briandys.com/ntt/';

/**
 * Features Slug
 */
$GLOBALS['ntt_kid_f5e_html_to_canvas_slug'] = 'html-to-canvas';
$GLOBALS['ntt_kid_f5e_instafeed_slug'] = 'instafeed';
$GLOBALS['ntt_kid_f5e_prezo_mode_slug'] = 'prezo-mode';
$GLOBALS['ntt_kid_f5e_scroll_y_slug'] = 'scroll-y';

/**
 * Functions
 */
$r_functions = array(
    // Primary
    'styles-scripts',
    // Secondary
    'comments-css',
    'customizer',
    'custom-fields',
    'entry-css',
    //'fonts',
    'html-css',
    'open-graph',
    'shortcodes',
    'snaps',
);

foreach ( $r_functions as $function ) {
    require( get_stylesheet_directory(). '/includes/functions/'. $function. '.php' );
}

/**
 * Features
 */
$r_features = array(
    $GLOBALS['ntt_kid_f5e_html_to_canvas_slug'],
    $GLOBALS['ntt_kid_f5e_instafeed_slug'],
    $GLOBALS['ntt_kid_f5e_prezo_mode_slug'],
    $GLOBALS['ntt_kid_f5e_scroll_y_slug'],
);

foreach ( $r_features as $feature ) {
    require( get_stylesheet_directory(). '/includes/features/'. $feature. '/functions.php' );
}

/**
 * Font Families
 */
/*
add_filter( 'kid_ntt_custom_fonts_filter', function( $font_families ) {
    $font_families[] = 'Hind|Open+Sans+Condensed:700';
    return $font_families;
} );
*/

/**
 * String Position with Needles in Array
 * https://www.php.net/manual/en/function.strpos.php#102773
 */
function strpos_array( $haystack, $needles ) {
    if ( is_array( $needles ) ) {
        foreach ( $needles as $str ) {
            if ( is_array( $str ) ) {
                $pos = strpos_array( $haystack, $str );
            } else {
                $pos = strpos( $haystack, $str );
            }
            if ( $pos !== false ) {
                return true;
            }
        }
    } else {
        return strpos( $haystack, $needles );
    }
}

/**
 * Maker Tag Name
 */
add_filter( 'ntt_entity_maker_tag_theme_name_filter', function() {
    return $GLOBALS['ntt_child_theme_name'];
} );

/**
 * Maker Tag URL
 */
add_filter( 'ntt_entity_maker_tag_theme_url_filter', function() {
    return $GLOBALS['ntt_child_theme_url'];
} );

add_filter( 'ntt_entry_nav_name_filter', function() {
    return __( 'Can\'t Get Enough?', 'ntt' );
} );

function ntt_entry_header_content() {

    ntt_entry_categories();
    ntt_entry_breadcrumbs_nav();
    ntt_entry_heading();
    ntt_entry_actions();
    
    if ( ( ( is_singular() || is_home() || is_archive() ) && has_excerpt() ) || is_search() ) {
        ntt_entry_summary_content();
    }

    ntt_entry_banner();
    ntt_entry_primary_meta();
    ntt__tag__comments_actions_snippet();
}

function ntt_entry_primary_meta_content() {

    ntt_entry_author();
    ntt_entry_datetime();   
}

/**
 * Remove Password-Protected Posts Filter
 * Removes posts that are password-protected from the index
 * https://aspengrovestudios.com/how-to-customize-password-protected-pages/
 */
function ntt_kid_remove_password_protected_posts_filter( $where = '' ) {

    if ( ! is_single() && ! current_user_can( 'edit_private_posts' ) && ! is_admin() ) {
        $where .= " AND post_password = ''";
    }
 
    return $where;
}
add_filter( 'posts_where', 'ntt_kid_remove_password_protected_posts_filter' );

/**
 * Responsive Flickr
 * Make the embed code of Flickr generate responsive images.
 * http://modernblackhand.com/index.php/en/responsive-flickr-embed-photos/
 * https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images
 */
function ntt_kid_responsive_flickr( $content ) {
    $content = preg_replace( '/src=\"(.*staticflickr\.com.*)(_.*)\.jpg\"/i', 'src="$1_b.jpg" srcset="$1_n.jpg 320w, $1_z.jpg 640w, $1_b.jpg 1024w" sizes="(min-width: 880px) 100vw, 100vw"', $content , -1 );
    
    return $content;
}
add_filter( 'the_content', 'ntt_kid_responsive_flickr' );

/**
 * DateTime - Month Format
 */
add_filter( 'ntt_cm_datetime_month_filter', function() {
    return 'M';
} );

/**
 * Complimentary Close
 */
/*
function eel_ntt_complimentary_close() {

    if ( is_single() ) {
        ?>
        <div class="complimentary-close obj">
            <span class="compliment---txt"><?php echo apply_filters( 'eel_ntt_complimentary_close_compliment_filter', 'To your success,' ); ?></span>
            <span class="author-name---txt"><?php echo apply_filters( 'eel_ntt_complimentary_close_author_name_filter', get_the_author_meta( 'nickname' ) ); ?></span>
        </div>
        <?php
    }
}
add_action( 'ntt__wp_hook__the_content___after', 'eel_ntt_complimentary_close');
*/

/**
 * Entry Banner Visuals Featured Image Size
 */
/*
function eel_ntt_entry_banner_visuals_featured_image_size() {

    if ( is_singular() ) {
        $featured_image_size = 'ntt-large';
    } else {
        $featured_image_size = 'ntt-large';
    }

    return $featured_image_size;
}
add_filter( 'ntt_entry_banner_visuals_featured_image_size_filter', 'eel_ntt_entry_banner_visuals_featured_image_size' );
*/
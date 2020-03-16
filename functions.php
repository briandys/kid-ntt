<?php
/**
 * Functions
 */

/**
 * Child Theme Settings
 */
$GLOBALS['ntt__gvar__child_theme__name'] = 'Kid NTT';
$GLOBALS['ntt__gvar__child_theme__url'] = '//briandys.com/ntt/';
$GLOBALS['ntt__gvar__child_theme__version'] = '1.0.0';

/**
 * Features Global Variables
 */
$GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix'] = 'ntt--kid-ntt--feature--';
$GLOBALS['ntt__gvar__kid_ntt__feature__html_to_canvas__name'] = 'html-to-canvas';
$GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'] = 'instafeed';
$GLOBALS['ntt__gvar__kid_ntt__feature__prezo_mode__name'] = 'prezo-mode';
$GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__name'] = 'scroll-y';
$GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__name'] = 'user-functions';

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
    $GLOBALS['ntt__gvar__kid_ntt__feature__html_to_canvas__name'],
    $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'],
    $GLOBALS['ntt__gvar__kid_ntt__feature__prezo_mode__name'],
    $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__name'],
    $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__name'],
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
    return $GLOBALS['ntt__gvar__child_theme__name'];
} );

/**
 * Maker Tag URL
 */
add_filter( 'ntt_entity_maker_tag_theme_url_filter', function() {
    return $GLOBALS['ntt__gvar__child_theme__url'];
} );

add_filter( 'ntt_entry_nav_name_filter', function() {
    return __( 'Can\'t Get Enough?', 'ntt' );
} );

/**
 * Remove Password-Protected Posts Filter
 * Removes posts that are password-protected from the index
 * https://aspengrovestudios.com/how-to-customize-password-protected-pages/
 */
function ntt__kid_ntt__function__remove_password_protected_posts( $where = '' ) {

    if ( ! is_single() && ! current_user_can( 'edit_private_posts' ) && ! is_admin() ) {
        $where .= " AND post_password = ''";
    }
 
    return $where;
}
add_filter( 'posts_where', 'ntt__kid_ntt__function__remove_password_protected_posts' );

/**
 * Responsive Flickr
 * Make the embed code of Flickr generate responsive images.
 * http://modernblackhand.com/index.php/en/responsive-flickr-embed-photos/
 * https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images
 */
function ntt__kid_ntt__function__responsive_flickr( $content ) {
    $content = preg_replace( '/src=\"(.*staticflickr\.com.*)(_.*)\.jpg\"/i', 'src="$1_b.jpg" srcset="$1_n.jpg 320w, $1_z.jpg 640w, $1_b.jpg 1024w"', $content , -1 );
    
    return $content;
}
add_filter( 'the_content', 'ntt__kid_ntt__function__responsive_flickr' );

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
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
    'styles-scripts',
    'comments-css',
    'customizer',
    'custom-fields',
    'entry-css',
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
 * Sub-pages
 */
function ntt__kid_ntt__function__sub_pages() {
    
    if ( is_page_template( 'templates/sub-pages.php' ) ) {   
        global $post;
        $parent = $post->ID;
        $args = array(
            'post_type'     => 'page',
            'post_status'   => 'publish',
            'post_parent'   => $parent,
            'orderby'       => 'menu_order',
            'order'         => 'ASC'
        );

        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) {   
            
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                get_template_part( 'content', get_post_format() );
            }
        }
        wp_reset_postdata();
    }
}
add_action( 'ntt__wp_hook__entry_full_content___after', 'ntt__kid_ntt__function__sub_pages' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function ntt__kid_ntt__function__skip_link_focus_fix() {
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'ntt__kid_ntt__function__skip_link_focus_fix' );

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
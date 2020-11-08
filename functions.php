<?php
/**
 * Child Theme Settings
 */
$GLOBALS['ntt__gvar__child_theme__name'] = 'Kid NTT';
$GLOBALS['ntt__gvar__child_theme__url'] = '//briandys.com/ntt/';
$GLOBALS['ntt__gvar__child_theme__version'] = '1.0.3';

$GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix'] = 'ntt--kid-ntt--feature--';
$GLOBALS['ntt__gvar__kid_ntt__snap__name_prefix'] = 'ntt--kid-ntt--snap--';
$GLOBALS['ntt__gvar__kid_ntt__plugin__name_prefix'] = 'ntt--kid-ntt--plugin--';

/**
 * Classes
 */
$ntt_r_classes = array(
    'class-svg-icons',
);

foreach ( $ntt_r_classes as $ntt_class ) {
    require( get_stylesheet_directory(). '/classes/'. $ntt_class. '.php' );
}

/**
 * Functions
 */
$ntt_r_functions = array(
    'styles-scripts',
    'customizer',
    'custom-fields',
    'shortcodes',
    'open-graph',
    'page-template-sub-pages',
    'svg-icons',

    // Conditional CSS Class Names
    'view-css',
    'entry-css',
    'comments-css',

    'snaps', // Similar to WP Child Themes
    'features', // Similar to WP Plugins
);

foreach ( $ntt_r_functions as $ntt_function ) {
    require( get_stylesheet_directory(). '/includes/functions/'. $ntt_function. '.php' );
}

/**
 * Tag
 */
$ntt_r_tags = array(
    'entry-banner',
);

foreach ( $ntt_r_tags as $ntt_tag ) {
    require( get_stylesheet_directory(). '/includes/tags/'. $ntt_tag. '.php' );
}

/**
 * String Position with Needles in Array
 * https://www.php.net/manual/en/function.strpos.php#102773
 */
function ntt__kid_ntt__function__strpos_array( $haystack, $needles ) {
    if ( is_array( $needles ) ) {
        foreach ( $needles as $str ) {
            if ( is_array( $str ) ) {
                $pos = ntt__kid_ntt__function__strpos_array( $haystack, $str );
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
add_filter( 'ntt__wp_filter__entity_maker_tag_theme_name', function() {
    return $GLOBALS['ntt__gvar__child_theme__name'];
} );

/**
 * Maker Tag URL
 */
add_filter( 'ntt__wp_filter__entity_maker_tag_theme_url', function() {
    return $GLOBALS['ntt__gvar__child_theme__url'];
} );

/**
 * Remove Password-Protected Posts Filter
 * Removes posts that are password-protected from the Entry Index
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
 * DateTime - Month Format
 */
add_filter( 'ntt__wp_filter__cm_datetime_month', function() {
    return 'M';
} );

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
 * Site Icon
 */
function ntt__kid_ntt__function__site_icon() {

    if ( ! has_site_icon() ) {

        $get_theme_mod_icon = get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__site_icon' );
        $icon_is_svg = wp_check_filetype( $get_theme_mod_icon )['type'] == 'image/svg+xml';

        if ( $get_theme_mod_icon && $icon_is_svg ) {
            echo '<link rel="icon" type="image/svg+xml" href="'. $get_theme_mod_icon.'">';
            
        } elseif ( $get_theme_mod_icon && ! $icon_is_svg ) {
            $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M320,640a71,71,0,0,1-35.78-9.66l-213-124.26A71.25,71.25,0,0,1,36,444.74V195.26a71.25,71.25,0,0,1,35.22-61.34l213-124.26a71.09,71.09,0,0,1,71.56,0l213,124.26A71.25,71.25,0,0,1,604,195.26V444.74a71.25,71.25,0,0,1-35.22,61.34l-213,124.26A71,71,0,0,1,320,640Z" fill="#0049b2"/><path d="M555.4 156.92l-213-124.26a44.42 44.42 0 0 0-44.72 0l-213 124.26a44.54 44.54 0 0 0-22 38.34v249.48a44.54 44.54 0 0 0 22 38.34l213 124.26a44.42 44.42 0 0 0 44.72 0l213-124.26a44.54 44.54 0 0 0 22-38.34V195.26a44.54 44.54 0 0 0-22-38.34z" fill="#1064e2"/><path d="M308.9 235.86c-2.9-1.68-4.6-4-4.6-6.47V122l-84.17 49.1c-6.12 3.58-16.06 3.58-22.2 0s-6.12-9.37 0-12.94l111-64.72c4.5-2.62 11.24-3.4 17.1-2s9.7 4.76 9.7 8.46v107.4l84.16-49.1c6.13-3.58 16.07-3.58 22.2 0s6.13 9.37 0 12.94l-111 64.72c-4.48 2.62-11.23 3.4-17.1 2a18.76 18.76 0 0 1-5.08-2zM198 468.15c0 7.2-5 10.16-11.1 6.63s-11.1-12.25-11.1-19.45V338l-44.38-25.62c-6.13-3.54-11.1-12.24-11.1-19.44s5-10.17 11.1-6.63l111 64.05c6.13 3.54 11.1 12.25 11.1 19.45s-5 10.17-11.1 6.63L198 350.8m244 0l-44.38 25.63c-6.12 3.54-11.1.57-11.1-6.63s5-15.9 11.1-19.45l111-64.05c6.12-3.54 11.1-.57 11.1 6.63s-5 15.9-11.1 19.44L464.24 338v117.33c0 7.2-5 15.9-11.1 19.45s-11.1.57-11.1-6.63" fill="#fff"/></svg>';
    
            echo '<link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,'. base64_encode( $icon ).'">';
        }
    }
}
add_action( 'wp_head', 'ntt__kid_ntt__function__site_icon' );

/**
 * Remove Jetpack Related Posts
 * https://jetpack.com/support/related-posts/customize-related-posts/#delete
 */
function ntt__kid_ntt__function__jetpack_remove_rp() {
    
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
 
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_action( 'wp', 'ntt__kid_ntt__function__jetpack_remove_rp', 20 );

/**
 * Add Jetpack Related Posts
 * https://jetpack.com/support/related-posts/customize-related-posts/#delete
 */
function ntt__kid_ntt__function__jetpack_add_rp() {
    
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        echo do_shortcode( '[jetpack-related-posts]' );
    }
}
add_action( 'ntt__wp_hook__entry_secondary_meta___after', 'ntt__kid_ntt__function__jetpack_add_rp' );
<?php
/**
 * Functions
 */
$r_funcs = array(
    'fonts',
);

foreach ( $r_funcs as $func ) {
    require( get_stylesheet_directory(). '/includes/functions/'. $func. '.php' );
}

/**
 * Styles, Scripts
 */
function eel_ntt_styles_scripts() {

    wp_enqueue_style( 'eel-ntt-style', get_stylesheet_directory_uri(). '/includes/snaps/elevate-everyday-living/assets/styles/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'eel_ntt_styles_scripts', 0 );

/**
 * Font Families
 */
function eel_ntt_font_families( $font_families ) {
    
    $font_families[] = 'Great+Vibes|Noto+Serif+JP:400,700';
    
    return $font_families;
}
add_filter( 'kid_ntt_custom_fonts_filter', 'eel_ntt_font_families' );

/** 
 * Add Stuff with Entry Name
 */
function eel_ntt_before_entry_name() {
    ntt_entry_categories();
    ntt_entry_breadcrumbs_nav();
}
add_action( 'ntt_before_entry_name_wp_hook', 'eel_ntt_before_entry_name' );

/**
 * Complimentary Close
 */
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
add_action( 'ntt_after_the_content_wp_hook', 'eel_ntt_complimentary_close');

/**
 * Entry Banner Visuals Featured Image Size
 */
function eel_ntt_entry_banner_visuals_featured_image_size() {

    if ( is_singular() ) {
        $featured_image_size = 'ntt-large';
    } else {
        $featured_image_size = 'ntt-large';
    }

    return $featured_image_size;
}
add_filter( 'ntt_entry_banner_visuals_featured_image_size_filter', 'eel_ntt_entry_banner_visuals_featured_image_size' );
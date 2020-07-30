<?php
/**
 * Snaps Info
 */
if ( ! function_exists( 'ntt__kid_ntt__snaps__info' ) ) {
    function ntt__kid_ntt__snaps__info() {
    
        $name = 'Hexetidine';
    
        $info = array(
            'name'      => $name,
            'slug'      => sanitize_title( $name ),
            'version'   => '0.0.8',
            'features'  => array(
                'scroll-y',
            ),
        );
        
        return $info;
    }
}

/**
 * Styles, Scripts
 */
function ntt__kid_ntt__snaps__styles_scripts() {

    $snap = ntt__kid_ntt__snaps__info();
    $slug = $snap['slug'];
    $prefixed_slug = $GLOBALS['ntt__gvar__kid_ntt__snap__name_prefix']. $slug;    
    $main_style_id = $prefixed_slug. '--style';
    $main_script_id = $prefixed_slug. '--script';
    $path = get_stylesheet_directory_uri(). '/includes/snaps/'. $slug. '/assets';
    $version = $snap['version']. '-'. wp_get_theme()->get( 'Version' );

    wp_enqueue_style( $main_style_id, $path. '/styles/style.min.css', array( 'ntt-style', 'ntt-kid-style' ), $version );
    wp_enqueue_script( $main_script_id, $path. '/scripts/main.js', array( 'ntt-kid-script', ), $version, true );

    $ntt_l10n = array(
        'one'       => __( 'Plant seeds in the neighborhood; grow fruits in your yard.', 'ntt' ),
        'two'       => __( 'Better make it and make it better.', 'ntt' ),
        'three'     => __( 'The power is in the collective.', 'ntt' ),
        'four'      => __( 'Someone will notice your fire whether it is too bright or too dim only after you start a fire.', 'ntt' ),
        'five'      => ntt__kid_ntt__function__get_theme_svg( 'wink', 'hexetidine' ),
        'backTxt'   => __( 'Back', 'ntt' ),
    );

    wp_localize_script( $main_script_id, 'nttKidNttHexetidineData', $ntt_l10n );
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__snaps__styles_scripts', 0 );

/**
 * Add Month
 */
add_action( 'ntt__wp_hook__entity_logo___before', function() {
    echo '<div class="ntt--hexetidine--current-month">'. date('F Y'). '</div>';
} );

/**
 * Modifying Entry Header Structure
 */
function ntt__tag__entry_header__structure() {

    ntt__tag__entry_categories();
    ntt__tag__entry_breadcrumbs_nav();
    ntt__tag__entry_heading();
    ntt__tag__entry_actions();
    ntt__tag__entry_banner();
    ntt__tag__entry_primary_meta();
    ntt__tag__comments_actions_snippet();
    
    if ( ( ( is_singular() || is_home() || is_archive() ) && has_excerpt() ) || is_search() ) {
        ntt__tag__entry_secondary_meta__structure();
    }
}

/**
 * Modifying Entry Primary Meta Structure
 */
function ntt__tag__entry_primary_meta__structure() {

    ntt__tag__entry_datetime(); 
    ntt__tag__entry_author();  
}

/**
 * Icons
 * classes/class-svg-icons.php
 */
function ntt__kid_ntt__snaps__hexetidine_ntt__function__icons() {

    $icons = array(
        'wink' => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="ntt--wink-icon ntt--icon"><path d="M50 82a38.3 38.3 0 01-35.7-24.7 5.4 5.4 0 1110.2-3.8A27.4 27.4 0 0050 71.2c11.3 0 21.5-7.1 25.5-17.7a5.5 5.5 0 017-3.2 5.5 5.5 0 013.2 7A38.3 38.3 0 0150 82zM81.5 33c-1.5 0-2.8-.9-3.4-2.3a4.6 4.6 0 00-4.2-2.9 4.7 4.7 0 00-4.2 2.9 3.5 3.5 0 01-4.6 2.1 3.5 3.5 0 01-2.1-4.6c1.7-4.5 6.1-7.6 10.9-7.6s9.2 3 10.9 7.6c.7 1.9-.2 3.9-2.1 4.6l-1.2.2z"/><circle cx="27.7" cy="26.1" r="8.1"/></svg>',
    );

    return $icons;
}

/**
 * Search Query Criteria
 */
function ntt__kid_ntt__snaps__hexetidine_ntt__function__search_query( $query ) {
    
    if ( ! is_admin() && $query->is_main_query() && is_search() ) {
        $query->set( 'post_type', 'post' );
        $query->set( 'category__not_in', get_cat_ID ( 'The Ride' ) );
    }
    
    return $query;
}
add_filter( 'pre_get_posts','ntt__kid_ntt__snaps__hexetidine_ntt__function__search_query' );

/**
 * Comment Label Text
 */
add_filter( 'ntt__wp_filter__comment_label_text', function() {
    return __( 'What are your thoughts?', 'ntt' );
} );
<?php
/**
 * Snaps Info
 */
if ( ! function_exists( 'ntt__kid_ntt__snaps__info' ) ) {
    function ntt__kid_ntt__snaps__info() {
    
        $name = 'STLMI';
    
        $info = array(
            'name'      => $name,
            'slug'      => sanitize_title( $name ),
            'version'   => '0.0.1',
            'features'  => array(
                '',
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
    
    $splide_style_id = $prefixed_slug. '--splide-style';
    $splide_script_id = $prefixed_slug. '--splide-script';
    
    $path = get_stylesheet_directory_uri(). '/includes/snaps/'. $slug. '/assets';
    $version = $snap['version']. '-'. wp_get_theme()->get( 'Version' );

    wp_enqueue_style( $main_style_id, $path. '/styles/main.min.css', array( 'ntt-style', 'ntt-kid-style' ), $version );
    wp_enqueue_style( $splide_style_id, $path. '/styles/splide.min.css', array( 'ntt-style', 'ntt-kid-style' ), $version );
    wp_enqueue_script( $main_script_id, $path. '/scripts/main.js', array( 'ntt-kid-script', ), $version, true );
    wp_enqueue_script( $splide_script_id, $path. '/scripts/splide.min.js', array( 'ntt-kid-script', ), $version, true );
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__snaps__styles_scripts', 0 );
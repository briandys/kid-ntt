<?php
/**
 * Features
 */
function ntt__kid_ntt__features() {
    $features = array();
    $r_features = array_filter( glob( get_stylesheet_directory(). '/includes/features/*' ), 'is_dir' );

    if ( $r_features === false ) {
        return array();
    }

    foreach ( $r_features as $feature ) {
        $features[] = esc_html( basename( $feature ) );
    }

    return $features;
}


$GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__name'] = 'screenshot';
$GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'] = 'instafeed';
$GLOBALS['ntt__gvar__kid_ntt__feature__prezo_mode__name'] = 'prezo-mode';
//$GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__name'] = 'scroll-y';
$GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__name'] = 'user-functions';
$GLOBALS['ntt__gvar__kid_ntt__feature__responsive_flickr__name'] = 'responsive-flickr';

/**
 * Features Directory
 */
$r_features = ntt__kid_ntt__features();

if ( $r_features === false ) {
    return array();
}

// Features won't work if Customizer > NTT Settings > Snaps is set to "ntt"
// 0 = 'default'
// 1 = 'ntt'
// > 1 = snaps
if ( get_theme_mod( 'ntt__kid_ntt__wp_customizer__snaps__settings' ) == 0 || get_theme_mod( 'ntt__kid_ntt__wp_customizer__snaps__settings' ) > 1 ) {

    foreach ( $r_features as $feature ) {
        
        if ( file_exists( get_stylesheet_directory(). '/includes/features/'. basename( $feature ). '/functions.php' ) ) {
            require( get_stylesheet_directory(). '/includes/features/'. basename( $feature ). '/functions.php' );
        }
    }
}
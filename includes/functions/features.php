<?php
/**
 * Features
 * Features won't work if Snaps is set as "NTT"
 */
if ( get_theme_mod( 'ntt__kid_ntt__wp_customizer__snaps__settings' ) == 0 || get_theme_mod( 'ntt__kid_ntt__wp_customizer__snaps__settings' ) > 1 ) {
    
    $r_features = array(
        $GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__name'],
        $GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'],
        $GLOBALS['ntt__gvar__kid_ntt__feature__prezo_mode__name'],
        $GLOBALS['ntt__gvar__kid_ntt__feature__scroll_y__name'],
        $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__name'],
        $GLOBALS['ntt__gvar__kid_ntt__feature__responsive_flickr__name'],
    );

    foreach ( $r_features as $feature ) {
        require( get_stylesheet_directory(). '/includes/features/'. $feature. '/functions.php' );
    }
}
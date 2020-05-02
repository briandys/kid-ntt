<?php
/**
 * Features
 */

$GLOBALS['ntt__gvar__kid_ntt__feature__screenshot__name'] = 'screenshot';
$GLOBALS['ntt__gvar__kid_ntt__feature__instafeed__name'] = 'instafeed';
$GLOBALS['ntt__gvar__kid_ntt__feature__prezo_mode__name'] = 'prezo-mode';
$GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__name'] = 'user-functions';
$GLOBALS['ntt__gvar__kid_ntt__feature__responsive_flickr__name'] = 'responsive-flickr';

    
function ntt__kid_ntt__features__array_filter__functions_php( $feature_pathname ) {

    if ( file_exists( $feature_pathname. '/functions.php' ) ) {
        return $feature_pathname;
    }
}

 /**
 * Features Pathnames
 * Returns the pathnames of directories inside /includes/features/ folder
 */
function ntt__kid_ntt__features__pathnames() {
    
    // Glob all pathnames that does not start with an underscore
    // Array Filter directories only
    $feature_pathnames = array_filter( glob( get_stylesheet_directory(). '/includes/features/[!_]*' ), 'is_dir' );
    
    // Filter directories with functions.php only
    $feature_pathnames = array_filter( $feature_pathnames, 'ntt__kid_ntt__features__array_filter__functions_php' );

    return $feature_pathnames;
}

/**
 * Features Slugs
 * Returns the slugs of the features' folder names
 */
function ntt__kid_ntt__features__slugs() {
    
    $feature_slugs = array();
    $feature_pathnames = ntt__kid_ntt__features__pathnames();
    
    if ( $feature_pathnames ) {

        foreach ( $feature_pathnames as $feature_pathname ) {
            $feature_slugs[] = sanitize_title( basename( $feature_pathname ) );
        }
        
        // Sort array in alphabetical order
        sort( $feature_slugs, SORT_NATURAL | SORT_FLAG_CASE );
    }

    return $feature_slugs;    
}

/**
 * Include Features Functions File
 */
$feature_pathnames = ntt__kid_ntt__features__pathnames();
$feature_slugs = ntt__kid_ntt__features__slugs();

// Check WP Customizer which features are enabled
$features_customizer = get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' );

// Check Snaps which features are enabled
$features_snaps_settings = ntt__kid_ntt__snaps__features();

// Merge the features found
$features_merge = array_merge( $features_customizer, $features_snaps_settings );

// Remove the ones that are not in the official list
$features_intersect = array_intersect( $features_merge, $feature_slugs );

// Remove duplicate features
$features_unique = array_unique( $features_intersect );

// Features won't work if Customizer > NTT Settings > Snaps is set to "ntt"
if ( $feature_pathnames && get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__snaps' ) !== 'ntt' ) {

    // Include all automatically if there are features that are conditionally dependent on other features
    foreach ( $feature_pathnames as $feature_pathname ) {
        
        $functions_file = $feature_pathname. '/functions.php';
        
        if ( file_exists( $functions_file ) ) {
            require( $functions_file );
        }
    }
}

/*
// Only include functions.php of features that are set in the result of $features_unique (do not include all automatically)
if ( $feature_pathnames && get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__snaps' ) !== 'ntt' && $features_unique ) {

    foreach ( $features_unique as $feature ) {
        
        $functions_file = get_stylesheet_directory(). '/includes/features/'. $feature. '/functions.php';
        
        if ( file_exists( $functions_file ) ) {
            require( $functions_file );
        }
    }
}
*/
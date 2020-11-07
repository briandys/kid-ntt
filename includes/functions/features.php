<?php
/**
 * Features
 */

$GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__name'] = 'user-functions';

 /**
 * Features Pathnames
 * Returns the pathnames of directories inside /includes/features/ folder
 */
function ntt__kid_ntt__features__pathnames() {
    
    $feature_pathnames = array();
    
    // Exclude all pathnames that does not start with an underscore
    // Array Filter directories only
    $feature_pathnames = array_filter( glob( get_stylesheet_directory(). '/includes/features/[!_]*' ), 'is_dir' );
    
    // Filter directories with functions.php only by running through a function
    $feature_pathnames = array_filter( $feature_pathnames, 'ntt__kid_ntt__features__array_filter__functions_php' );

    return $feature_pathnames;
}

function ntt__kid_ntt__features__array_filter__functions_php( $feature_pathname ) {

    if ( file_exists( $feature_pathname. '/functions.php' ) ) {
        return $feature_pathname;
    }
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

/*
// Features setting in Customizer: Start

// Check WP Customizer which features are enabled
$features_customizer = get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' );

if ( $features_customizer == '' ) {
    $features_customizer = array();
} else {
    $features_customizer = get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' );
}

// Check Snaps which features are enabled
$features_snaps_settings = ntt__kid_ntt__snaps__features();

// Merge the features found
$features_merge = array_merge( $features_customizer, $features_snaps_settings );

// Remove the ones that are not in the official list
$features_intersect = array_intersect( $features_merge, $feature_slugs );

// Remove duplicate features
$features_unique = array_unique( $features_intersect );

// Features setting in Customizer: End
*/

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

/**
 * Get Feature Data
 */
function ntt__kid_ntt__features__get_data( $feature_slug ) {
 
    $default_headers = array(
        'Feature Name'  => 'Feature Name',
        'Slug'          => 'Slug',
        'Description'   => 'Description',
        'URL'           => 'URL',
        'Scope'         => 'Scope',
        'Version'       => 'Version',
    );

    $feature_data = get_file_data( get_stylesheet_directory(). '/includes/features/'. $feature_slug. '/functions.php', $default_headers, 'ntt_feature' );
 
    return $feature_data;
}
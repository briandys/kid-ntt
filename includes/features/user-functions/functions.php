<?php
/**
 * User Functions
 * .ntt--feature--user-functions
 * Lists all user defined functions in the Functions page.
 * https://www.php.net/manual/en/function.get-defined-functions.php
 * https://stackoverflow.com/a/10474285
 */
$GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__prefixed_name'] = $GLOBALS['ntt__gvar__kid_ntt__feature__name_prefix']. $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__name'];
$GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__version'] = '1.0.0';

/**
 * NTT Feature Validation
 */
function ntt__kid_ntt__feature__user_functions__validation() {
    $post_meta = get_post_meta( get_the_ID(), 'ntt_feature', true );

    $ntt_f5e_array = array(
        $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__prefixed_name'],
    );

    if ( strpos_array( $post_meta, $ntt_f5e_array ) ) {
        return true;
    }
}

function ntt__kid_ntt__feature__user_functions() {

    if ( is_page() && ntt__kid_ntt__feature__user_functions__validation() ) {

        $r_user_functions = get_defined_functions()['user'];
        
        // ntt__ only
        $r_user_functions_filtered_ntt = array_filter( $r_user_functions, function ( $var ) {
            return ( ( stripos( $var, 'ntt__' ) !== false ) && ( stripos( $var, 'ntt__kid_ntt' ) === false ) );
        } );

        $r_user_functions_filtered_ntt_count = count($r_user_functions_filtered_ntt);
        sort($r_user_functions_filtered_ntt);
        
        // ntt__kid_ntt only
        $r_user_functions_filtered_ntt_kid = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__kid_ntt' ) !== false );
        } );

        $r_user_functions_filtered_ntt_kid_count = count($r_user_functions_filtered_ntt_kid);
        sort($r_user_functions_filtered_ntt_kid);
        
        // ntt__function only
        $r_user_functions_filtered_ntt_function = array_filter( $r_user_functions, function ( $var ) {
            return ( ( stripos( $var, 'ntt__function' ) !== false ) && ( stripos( $var, 'ntt__kid_ntt__function' ) === false ) );
        } );

        $r_user_functions_filtered_ntt_function_count = count($r_user_functions_filtered_ntt_function);
        sort($r_user_functions_filtered_ntt_function);
        
        // ntt__tag only
        $r_user_functions_filtered_ntt_tag = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__tag' ) !== false );
        } );

        $r_user_functions_filtered_ntt_tag_count = count($r_user_functions_filtered_ntt_tag);
        sort($r_user_functions_filtered_ntt_tag);
        
        // ntt__wp_customizer only
        $r_user_functions_filtered_ntt_wp_customizer = array_filter( $r_user_functions, function ( $var ) {
            return ( ( stripos( $var, 'ntt__wp_customizer' ) !== false ) && ( stripos( $var, 'ntt__kid_ntt__wp_customizer' ) === false ) );
        } );

        $r_user_functions_filtered_ntt_wp_customizer_count = count($r_user_functions_filtered_ntt_wp_customizer);
        sort($r_user_functions_filtered_ntt_wp_customizer);
        
        // ntt__wp_hook only
        $r_user_functions_filtered_ntt_wp_hook = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__wp_hook' ) !== false );
        } );

        $r_user_functions_filtered_ntt_wp_hook_count = count($r_user_functions_filtered_ntt_wp_hook);
        sort($r_user_functions_filtered_ntt_wp_hook);
        
        // ntt__wp_theme only
        $r_user_functions_filtered_ntt_wp_theme = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__wp_theme' ) !== false );
        } );

        $r_user_functions_filtered_ntt_wp_theme_count = count($r_user_functions_filtered_ntt_wp_theme);
        sort($r_user_functions_filtered_ntt_wp_theme);
        
        // ntt__wp_widget only
        $r_user_functions_filtered_ntt_wp_widgets = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__wp_widget' ) !== false );
        } );

        $r_user_functions_filtered_ntt_wp_widgets_count = count($r_user_functions_filtered_ntt_wp_widgets);
        sort($r_user_functions_filtered_ntt_wp_widgets);
        
        // ntt__kid_ntt__function only
        $r_user_functions_filtered_ntt_kid_function = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__kid_ntt__function' ) !== false );
        } );

        $r_user_functions_filtered_ntt_kid_function_count = count($r_user_functions_filtered_ntt_kid_function);
        sort($r_user_functions_filtered_ntt_kid_function);
        
        // ntt__kid_ntt__feature only
        $r_user_functions_filtered_ntt_kid_feature = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__kid_ntt__feature' ) !== false );
        } );

        $r_user_functions_filtered_ntt_kid_feature_count = count($r_user_functions_filtered_ntt_kid_feature);
        sort($r_user_functions_filtered_ntt_kid_feature);
        sort($r_user_functions_filtered_ntt_kid_function);
        
        // ntt__kid_ntt__snaps only
        $r_user_functions_filtered_ntt_kid_snaps = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__kid_ntt__snaps' ) !== false );
        } );

        $r_user_functions_filtered_ntt_kid_snaps_count = count($r_user_functions_filtered_ntt_kid_snaps);
        sort($r_user_functions_filtered_ntt_kid_snaps);
        sort($r_user_functions_filtered_ntt_kid_function);
        
        // ntt__kid_ntt__wp_custom_field only
        $r_user_functions_filtered_ntt_kid_wp_custom_field = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__kid_ntt__wp_custom_field' ) !== false );
        } );

        $r_user_functions_filtered_ntt_kid_wp_custom_field_count = count($r_user_functions_filtered_ntt_kid_wp_custom_field);
        sort($r_user_functions_filtered_ntt_kid_wp_custom_field);
        sort($r_user_functions_filtered_ntt_kid_function);
        
        // ntt__kid_ntt__wp_customizer only
        $r_user_functions_filtered_ntt_kid_wp_customizer = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__kid_ntt__wp_customizer' ) !== false );
        } );

        $r_user_functions_filtered_ntt_kid_wp_customizer_count = count($r_user_functions_filtered_ntt_kid_wp_customizer);
        sort($r_user_functions_filtered_ntt_kid_wp_customizer);
        sort($r_user_functions_filtered_ntt_kid_function);
        
        // ntt__kid_ntt__wp_shortcode only
        $r_user_functions_filtered_ntt_kid_wp_shortcode = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__kid_ntt__wp_shortcode' ) !== false );
        } );

        $r_user_functions_filtered_ntt_kid_wp_shortcode_count = count($r_user_functions_filtered_ntt_kid_wp_shortcode);
        sort($r_user_functions_filtered_ntt_kid_wp_shortcode);
        
        // ntt__ all
        $r_user_functions_filtered_ntt_all = array_filter( $r_user_functions, function ( $var ) {
            return ( stripos( $var, 'ntt__' ) !== false );
        } );

        $r_user_functions_filtered_ntt_all_count = count($r_user_functions_filtered_ntt_all);

        $r_user_functions_filtered_ntt_all_count_total = $r_user_functions_filtered_ntt_count + $r_user_functions_filtered_ntt_kid_count;

        if ( $r_user_functions_filtered_ntt_all_count == $r_user_functions_filtered_ntt_all_count_total ) {
            $equality_txt = 'Equal';
        } else {
            $equality_txt = 'Not Equal';
        }
        ?>

        <div class="ntt--user-functions">
            <h2 class="ntt--user-functions-heading">All Functions</h2>
            <span class="ntt--user-functions-count"><?php echo $r_user_functions_filtered_ntt_all_count; ?></span>
            <p>Total: <?php echo $r_user_functions_filtered_ntt_count. ' + '. $r_user_functions_filtered_ntt_kid_count. ' = '. $r_user_functions_filtered_ntt_all_count_total. ' ('. $equality_txt. ')'; ?></p>
            
            <details>
                <summary>
                    <h3>NTT Function</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>

            <details>
                <summary>
                    <h3>NTT Kid Function</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_kid_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_kid as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>

            <h2>NTT</h2>
            <details>
                <summary>
                    <h3>NTT Function</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_function_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_function as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
            <details>
                <summary>
                    <h3>NTT Tag</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_tag_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_tag as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
            </details>
            <details>
                <summary>
                    <h3>NTT WP Customizer</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_wp_customizer_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_wp_customizer as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
            </details>
            <details>
                <summary>
                    <h3>NTT WP Hook</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_wp_hook_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_wp_hook as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
            </details>
            <details>
                <summary>
                    <h3>NTT WP Theme</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_wp_theme_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_wp_theme as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
            </details>
            <details>
                <summary>
                    <h3>NTT WP Widget</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_wp_widgets_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_wp_widgets as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>

            <h2>NTT Kid</h2>
            <details>
                <summary>
                    <h3>NTT Kid Function</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_kid_function_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_kid_function as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
            <details>
                <summary>
                    <h3>NTT Kid Feature</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_kid_feature_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_kid_feature as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
            </details>
            <details>
                <summary>
                    <h3>NTT Kid Snaps</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_kid_snaps_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_kid_snaps as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
            </details>
            <details>
                <summary>
                    <h3>NTT Kid WP Custom Field</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_kid_wp_custom_field_count; ?></spn>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_kid_wp_custom_field as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
            </details>
            <details>
                <summary>
                    <h3>NTT Kid WP Customizer</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_kid_wp_customizer_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_kid_wp_customizer as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
            </details>
            <details>
                <summary>
                    <h3>NTT Kid WP Shortcode</h3>
                    <span class="ntt--count"><?php echo $r_user_functions_filtered_ntt_kid_wp_shortcode_count; ?></span>
                </summary>
                <ul>
                    <?php
                    foreach( $r_user_functions_filtered_ntt_kid_wp_shortcode as $function ) {
                        ?>
                        <li><?php echo $function; ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </details>
        </div>
        <?php
    }
}
add_action( 'ntt__wp_hook__the_content___after', 'ntt__kid_ntt__feature__user_functions');

/**
 * Styles, Scripts
 */
/*
function ntt__kid_ntt__feature__user_functions__styles_scripts() {

    if ( is_page() && ntt__kid_ntt__feature__user_functions__validation() ) {

        wp_enqueue_style( $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__enqueue_slug']. '-style', get_stylesheet_directory_uri(). '/includes/features/'. $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__name']. '/style.min.css', array( 'ntt-kid-style' ), wp_get_theme()->get( 'Version' ) );

        wp_enqueue_script( $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__enqueue_slug']. '-script', get_stylesheet_directory_uri(). '/includes/features/'. $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__name']. '/main.js', array(), wp_get_theme()->get( 'Version' ), true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__feature__user_functions__styles_scripts', 0 );
*/

/**
 * Styles, Scripts
 * Enqueues the styles and scripts
 */
function ntt__kid_ntt__feature__user_functions__styles_scripts() {

    $name = $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__name'];
    $prefixed_name = $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__prefixed_name'];
    $version = $GLOBALS['ntt__gvar__kid_ntt__feature__user_functions__version'];
    $theme_version = wp_get_theme()->get( 'Version' );

    if ( is_page() && ntt__kid_ntt__feature__user_functions__validation() ) {

        wp_enqueue_style( $prefixed_name. '--style', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/style.min.css', array( 'ntt-kid-style' ), $version. '-'. $theme_version );

        wp_enqueue_script( $prefixed_name. '--script', get_stylesheet_directory_uri(). '/includes/features/'. $name. '/main.js', array(), $version. '-'. $theme_version, true );
    }
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__feature__user_functions__styles_scripts', 0 );
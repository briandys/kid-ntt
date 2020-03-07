<?php
/**
 * List User Defined Functions
 * https://www.php.net/manual/en/function.get-defined-functions.php
 * https://stackoverflow.com/a/10474285
 */
function ntt__function__user_functions() {

    if ( is_page( 'Functions' ) ) {

        if ( current_user_can( 'edit_private_posts' ) ) {
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

            <h2>All Functions <?php echo $r_user_functions_filtered_ntt_all_count; ?></h2>
            <p>Total: <?php echo $r_user_functions_filtered_ntt_count. ' + '. $r_user_functions_filtered_ntt_kid_count. ' = '. $r_user_functions_filtered_ntt_all_count_total. ' ('. $equality_txt. ')'; ?></p>
            
            <details>
                <summary>NTT Function <?php echo $r_user_functions_filtered_ntt_count; ?></summary>
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
                <summary>NTT Kid Function <?php echo $r_user_functions_filtered_ntt_kid_count; ?></summary>
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

            <h2>Details</h2>
            <h3>NTT</h3>
            <details>
                <summary>NTT Function <?php echo $r_user_functions_filtered_ntt_function_count; ?></summary>
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
                <summary>NTT Tag <?php echo $r_user_functions_filtered_ntt_tag_count; ?></summary>
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
                <summary>NTT WP Customizer <?php echo $r_user_functions_filtered_ntt_wp_customizer_count; ?></summary>
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
                <summary>NTT WP Hook <?php echo $r_user_functions_filtered_ntt_wp_hook_count; ?></summary>
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
                <summary>NTT WP Theme <?php echo $r_user_functions_filtered_ntt_wp_theme_count; ?></summary>
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
                <summary>NTT WP Widget <?php echo $r_user_functions_filtered_ntt_wp_widgets_count; ?></summary>
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

            <h3>NTT Kid</h3>
            <details>
                <summary>NTT Kid Function <?php echo $r_user_functions_filtered_ntt_kid_function_count; ?></summary>
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
                <summary>NTT Kid Feature <?php echo $r_user_functions_filtered_ntt_kid_feature_count; ?></summary>
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
                <summary>NTT Kid Snaps <?php echo $r_user_functions_filtered_ntt_kid_snaps_count; ?></summary>
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
                <summary>NTT Kid WP Custom Field <?php echo $r_user_functions_filtered_ntt_kid_wp_custom_field_count; ?></summary>
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
                <summary>NTT Kid WP Customizer <?php echo $r_user_functions_filtered_ntt_kid_wp_customizer_count; ?></summary>
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
                <summary>NTT Kid WP Shortcode <?php echo $r_user_functions_filtered_ntt_kid_wp_shortcode_count; ?></summary>
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
            <?php
        } else {
            ?>
            <div class="ntt--note ntt--cp">
                <p>Please log in to view the content.</p>
            </div>
            <?php
        }
    }
}
add_action( 'ntt__wp_hook__the_content___after', 'ntt__function__user_functions');
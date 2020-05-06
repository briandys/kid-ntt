<?php
/**
 * WP Customizer
 * http://ottopress.com/2015/whats-new-with-the-customizer/
 */
function ntt__kid_ntt__wp_customizer( $wp_customize ) {

    // Separates labels into words and capitalize
    function ntt__kid_ntt__wp_customizer__format_label( $item ) {

        $item = ucwords( str_replace( array( '-', 'ntt' ), array( ' ', 'NTT' ), $item ) );
        
        return $item;
    }

    /**
     * Kid NTT Settings
     */
    $wp_customize->add_setting( 'ntt__kid_ntt__wp_customizer__settings__snaps', array(
        'default'   => 'kid-ntt',
    ) );

    if ( function_exists( 'ntt__kid_ntt__snaps' ) ) {
        
        $kid_ntt_snaps = ntt__kid_ntt__snaps();

        // Format the label for display
        $kid_ntt_snaps_label = array_map( 'ntt__kid_ntt__wp_customizer__format_label', $kid_ntt_snaps );

        // Make the values as keys by array_combine
        // https://www.php.net/array-combine
        $kid_ntt_snaps = array_combine( $kid_ntt_snaps, $kid_ntt_snaps_label );
    } else {
        $kid_ntt_snaps = array();
    }

    $wp_customize->add_control( 'ntt__kid_ntt__wp_customizer__settings__snaps', array(
        'label'     => __( 'Snaps', 'ntt' ),
        'section'   => 'ntt__wp_customizer__section__theme',
        'type'      => 'select',
        'choices'   => $kid_ntt_snaps,
    ) );




    /**
     * Multiple select customize control class.
     */
    class NTT_Customize_Control_Multiple_Select extends WP_Customize_Control {

        /**
         * The type of customize control being rendered.
         */
        public $type = 'ntt-multiple-select';

        /*
        public function enqueue() {
            wp_enqueue_script( 'ntt-customize-control', get_stylesheet_directory_uri(). '/assets/scripts/customizer.js', array( 'jquery' ) );
        }
        */

        /**
         * Displays the multiple select on the customize screen.
         */
        public function render_content() {

            if ( empty( $this->choices ) ) {
                return;
            }
            ?>

            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />

            <label>
                <?php
                if ( ! empty( $this->label ) ) {
                    ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php
                }
                
                if ( ! empty( $this->description ) ) {
                    ?>
                    <span class="description customize-control-description"><?php echo $this->description; ?></span>
                    <?php
                }
                ?>
                <select <?php $this->link(); ?> multiple="multiple">
                    <?php
                        foreach ( $this->choices as $value => $label ) {
                            $multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
                            $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                            echo '<option value="'. esc_attr( $value ). '"'. $selected. '>'. $label. '</option>';
                        }
                    ?>
                </select>
            </label>
        <?php }
    }

    $default_term = sanitize_title( __( 'default', 'ntt' ) );

    $wp_customize->add_setting(
        'ntt__kid_ntt__wp_customizer__settings__features',
        array(
            'default'   => array(
                $default_term,
            ),
        )
    );

    // Populate the fields
    $kid_ntt_features = ntt__kid_ntt__features__slugs();

    // Remove feature items that are exclusive for Entry Singular (not Entry Index)
    $kid_ntt_features_exclude = array(
        'prezo-mode', 
        'screenshot', 
    );
    $kid_ntt_features = array_diff( $kid_ntt_features, $kid_ntt_features_exclude );

    // Insert this as the first item
    array_unshift( $kid_ntt_features, $default_term );

    if ( function_exists( 'ntt__kid_ntt__features__slugs' ) && $kid_ntt_features ) {

        function ntt__kid_ntt__features__format_label( $item ) {
            return ucwords( str_replace( '-', ' ', $item ) );
        }

        // Format the label for display
        $kid_ntt_features_label = array_map( 'ntt__kid_ntt__wp_customizer__format_label', $kid_ntt_features );

        // Make the values as keys by array_combine
        // https://www.php.net/array-combine
        $kid_ntt_features = array_combine( $kid_ntt_features, $kid_ntt_features_label );

        //echo '<pre>Proof that NTT Features is an array: '. var_dump($kid_ntt_features). '</pre>';
        //echo '<pre>From Scroll Y Functions returns the string "array": '. var_dump( get_theme_mod( 'ntt__kid_ntt__wp_customizer__settings__features' ) ). '</pre>';
    }
     
    $wp_customize->add_control(
        new NTT_Customize_Control_Multiple_Select(
            $wp_customize,
            'ntt__kid_ntt__wp_customizer__settings__features',
            array(
                'label'    => __( 'Features', 'ntt' ),
                'section'  => 'ntt__wp_customizer__section__theme',
                'type'     => 'ntt-multiple-select',
                'choices'  => $kid_ntt_features,
            )
        )
    );

    
    
    
    /**
     * Site Icon Settings
     */
    $wp_customize->add_setting('ntt__kid_ntt__wp_customizer__settings__site_icon', array(
        'default'   => '',
    ) );

    $default_icon = '<svg aria-hidden="true" role="img" focusable="false" width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="ntt--default-site-icon ntt--icon"><path d="M320,640a71,71,0,0,1-35.78-9.66l-213-124.26A71.25,71.25,0,0,1,36,444.74V195.26a71.25,71.25,0,0,1,35.22-61.34l213-124.26a71.09,71.09,0,0,1,71.56,0l213,124.26A71.25,71.25,0,0,1,604,195.26V444.74a71.25,71.25,0,0,1-35.22,61.34l-213,124.26A71,71,0,0,1,320,640Z" fill="#0049b2"/><path d="M555.4 156.92l-213-124.26a44.42 44.42 0 0 0-44.72 0l-213 124.26a44.54 44.54 0 0 0-22 38.34v249.48a44.54 44.54 0 0 0 22 38.34l213 124.26a44.42 44.42 0 0 0 44.72 0l213-124.26a44.54 44.54 0 0 0 22-38.34V195.26a44.54 44.54 0 0 0-22-38.34z" fill="#1064e2"/><path d="M308.9 235.86c-2.9-1.68-4.6-4-4.6-6.47V122l-84.17 49.1c-6.12 3.58-16.06 3.58-22.2 0s-6.12-9.37 0-12.94l111-64.72c4.5-2.62 11.24-3.4 17.1-2s9.7 4.76 9.7 8.46v107.4l84.16-49.1c6.13-3.58 16.07-3.58 22.2 0s6.13 9.37 0 12.94l-111 64.72c-4.48 2.62-11.23 3.4-17.1 2a18.76 18.76 0 0 1-5.08-2zM198 468.15c0 7.2-5 10.16-11.1 6.63s-11.1-12.25-11.1-19.45V338l-44.38-25.62c-6.13-3.54-11.1-12.24-11.1-19.44s5-10.17 11.1-6.63l111 64.05c6.13 3.54 11.1 12.25 11.1 19.45s-5 10.17-11.1 6.63L198 350.8m244 0l-44.38 25.63c-6.12 3.54-11.1.57-11.1-6.63s5-15.9 11.1-19.45l111-64.05c6.12-3.54 11.1-.57 11.1 6.63s-5 15.9-11.1 19.44L464.24 338v117.33c0 7.2-5 15.9-11.1 19.45s-11.1.57-11.1-6.63" fill="#fff"/></svg>';
    
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'ntt__kid_ntt__wp_customizer__settings__site_icon',
            array(
                'section'       => 'ntt__wp_customizer__section__theme',
                'label'         => __( 'SVG Site Icon', 'ntt' ),
                'description'   => 'Choose SVG icon. If icon is not SVG, default NTT icon'. ' '. $default_icon. ' '. 'will be used. Leave blank to use custom site icon or none at all.',
            )
        )
    );
}
add_action( 'customize_register', 'ntt__kid_ntt__wp_customizer' );

/**
 * WP Customizer Styles, Scripts
 * 
 */
function ntt__kid_ntt__wp_customizer__styles_scripts() {
   
    wp_enqueue_style( 'ntt--kid-ntt--wp-customizer--style', get_stylesheet_directory_uri(). '/assets/styles/customizer.min.css', array(), wp_get_theme( get_template() )->get( 'Version' ). '-'. wp_get_theme()->get( 'Version' ) );
}
add_action( 'customize_controls_enqueue_scripts', 'ntt__kid_ntt__wp_customizer__styles_scripts');
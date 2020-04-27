<?php
/**
 * WP Customizer
 */
function ntt__kid_ntt__wp_customizer( $wp_customize ) {

    /**
     * Kid NTT Settings
     */
    
    $wp_customize->add_setting( 'ntt__kid_ntt__wp_customizer__settings__snaps', array(
        'default'           => '0',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr',
    ) );

    $wp_customize->add_control( 'ntt__kid_ntt__wp_customizer__settings__snaps', array(
        'label'     => 'Snaps',
        'section'   => 'ntt__wp_customizer__section__theme',
        'type'      => 'select',
        'choices'   => ntt__kid_ntt__snaps(),
    ) );

    /**
     * Multiple select customize control class.
     */
    class NTT_Customize_Control_Multiple_Select extends WP_Customize_Control {

        /**
         * The type of customize control being rendered.
         */
        public $type = 'ntt-multiple-select';

        /**
         * Displays the multiple select on the customize screen.
         */
        public function render_content() {

        if ( empty( $this->choices ) )
            return;
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select <?php $this->link(); ?> multiple="multiple">
                    <?php
                        foreach ( $this->choices as $value => $label ) {
                            $selected = ( @in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                            echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
                        }
                    ?>
                </select>
            </label>
        <?php }
    }

    $wp_customize->add_setting( 'ntt__kid_ntt__wp_customizer__settings__features', array(
        'default' => array(),
    ) );
    
    // Make the values as keys by array_combine
    // https://www.php.net/array-combine
    $kid_ntt_features = ntt__kid_ntt__features();
    $kid_ntt_features = array_combine( $kid_ntt_features, $kid_ntt_features );
     
    $wp_customize->add_control(
        new NTT_Customize_Control_Multiple_Select(
            $wp_customize,
            'ntt__kid_ntt__wp_customizer__settings__features',
            array(
                'label'    => 'Features',
                'section'  => 'ntt__wp_customizer__section__theme',
                'type'     => 'ntt-multiple-select',
                'choices'  => $kid_ntt_features,
            )
        )
    );
}
add_action( 'customize_register', 'ntt__kid_ntt__wp_customizer' );
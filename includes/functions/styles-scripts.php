<?php
/**
 * Styles, Scripts
 */
function ntt__kid_ntt__function__styles_scripts() {

    wp_enqueue_style( 'ntt-kid-style', get_stylesheet_directory_uri(). '/assets/styles/main.min.css', array( 'ntt-style' ), wp_get_theme( get_template() )->get( 'Version' ). '-'. wp_get_theme()->get( 'Version' ) );
    wp_enqueue_style( 'ntt-kid-noscript-style', get_stylesheet_directory_uri(). '/assets/styles/main.min.css', array( 'ntt-style' ) );

    wp_enqueue_script( 'ntt-kid-script', get_stylesheet_directory_uri(). '/assets/scripts/main.js', array( 'jquery', 'ntt-script', ), wp_get_theme( get_template() )->get( 'Version' ). '-'. wp_get_theme()->get( 'Version' ), true );

    $ntt_l10n = array(
        'arrowUpIcon'           => ntt__kid_ntt__function__get_theme_svg( 'arrow-up' ),
        'chevronLeftIcon'       => ntt__kid_ntt__function__get_theme_svg( 'chevron-left' ),
        'chevronRightIcon'      => ntt__kid_ntt__function__get_theme_svg( 'chevron-right' ),
        'chevronDownIcon'       => ntt__kid_ntt__function__get_theme_svg( 'chevron-down' ),
        'chevronUpDownIcon'     => ntt__kid_ntt__function__get_theme_svg( 'chevron-up-down' ),
        'loadingIndicator'      => ntt__kid_ntt__function__get_theme_svg( 'loading-indicator' ),

        'toggleMenuTxt'         => __( 'Toggle Menu', 'kid-ntt' ),
    );
    
    wp_localize_script( 'ntt-kid-script', 'nttData', $ntt_l10n );
}
add_action( 'wp_enqueue_scripts', 'ntt__kid_ntt__function__styles_scripts', 0 );

/**
 * Async CSS
 * https://www.filamentgroup.com/lab/load-css-simpler/
 */
function ntt__kid_ntt__function__stylesheet_attributes( $html, $handle ) {
    if ( 'ntt-kid-style' === $handle ) {
        return str_replace( "rel='stylesheet'", "rel='stylesheet' media='print' onload=\"this.media='all'\"", $html );
    }
    return $html;
}
add_filter( 'style_loader_tag', 'ntt__kid_ntt__function__stylesheet_attributes', 10, 2 );

/**
 * Add <noscript> to <link>
 * https://peterwilson.cc/delay-loading-of-print-css/
 */
function ntt__kid_ntt__function__stylesheet_noscript( $tag, $handle ) {
    if ( 'ntt-kid-noscript-style' === $handle ) {
        $tag = '<noscript>'. $tag. '</noscript>';
    }
    return $tag;
}
add_filter( 'style_loader_tag', 'ntt__kid_ntt__function__stylesheet_noscript', 10, 2 );

/**
 * Customizer Stylesheet
 */
function ntt__kid_ntt__wp_customizer__styles() {
    ?>
    <style>
        .customize-control select[multiple] {
            min-height:160px;
        }
    </style>
    <?php
}
add_action( 'customize_controls_print_styles', 'ntt__kid_ntt__wp_customizer__styles' );
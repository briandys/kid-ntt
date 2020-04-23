<?php
/**
 * SVG Icon helper functions
 *
 * From Twenty Twenty
 */

/**
 * Output and Get Theme SVG.
 * Output and get the SVG markup for an icon in the NTT_SVG_Icons class.
 *
 * @param string $svg_name The name of the icon.
 * @param string $group The group the icon belongs to.
 * @param string $color Color code.
 */
function ntt__kid_ntt__function__the_theme_svg( $svg_name, $group = 'ui', $color = '' ) {
    echo ntt__kid_ntt__function__get_theme_svg( $svg_name, $group, $color ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in ntt__kid_ntt__function__get_theme_svg().
}

/**
 * Get information about the SVG icon.
 *
 * @param string $svg_name The name of the icon.
 * @param string $group The group the icon belongs to.
 * @param string $color Color code.
 */
function ntt__kid_ntt__function__get_theme_svg( $svg_name, $group = 'ui', $color = '' ) {

    // Make sure that only our allowed tags and attributes are included.
    $svg = wp_kses(
        NTT_SVG_Icons::ntt__kid_ntt__function__get_svg( $svg_name, $group, $color ),
        array(
            'svg'       => array(
                'class'       => true,
                'xmlns'       => true,
                'width'       => true,
                'height'      => true,
                'viewbox'     => true,
                'aria-hidden' => true,
                'role'        => true,
                'focusable'   => true,
            ),
            'path'      => array(
                'fill'      => true,
                'fill-rule' => true,
                'd'         => true,
                'transform' => true,
                'class'     => true,
            ),
            'polygon'   => array(
                'fill'      => true,
                'fill-rule' => true,
                'points'    => true,
                'transform' => true,
                'focusable' => true,
            ),
            'circle'    => array(
                'cx'    => true,
                'cy'    => true,
                'r'     => true,
            ),
        )
    );

    if ( ! $svg ) {
        return false;
    }
    return $svg;
}
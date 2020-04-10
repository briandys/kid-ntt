<?php
/**
 * Custom icons for this theme.
 *
 * From Twenty Twenty
 */

/**
 * SVG ICONS CLASS
 * Retrieve the SVG code for the specified icon. Based on a solution in Twenty Nineteen.
 */
class NTT_SVG_Icons {
    /**
     * GET SVG CODE
     * Get the SVG code for the specified icon
     *
     * @param string $icon Icon name.
     * @param string $group Icon group.
     * @param string $color Color.
     */
    public static function ntt__kid_ntt__function__get_svg( $icon, $group = 'ui', $color = '#1A1A1B' ) {
        
        if ( 'ui' === $group ) {
            $arr = self::$ui_icons;
        } else {
            $arr = array();
        }
        
        if ( array_key_exists( $icon, $arr ) ) {
            $repl = '<svg class="ntt--icon" aria-hidden="true" role="img" focusable="false" ';
            $svg  = preg_replace( '/^<svg /', $repl, trim( $arr[ $icon ] ) ); // Add extra attributes to SVG code.
            $svg  = str_replace( '#1A1A1B', $color, $svg );   // Replace the color.
            $svg  = str_replace( '#', '%23', $svg );          // Urlencode hashes.
            $svg  = preg_replace( "/([\n\t]+)/", ' ', $svg ); // Remove newlines & tabs.
            $svg  = preg_replace( '/>\s*</', '><', $svg );    // Remove whitespace between SVG tags.
            return $svg;
        }
        return null;
    }

    /**
     * ICON STORAGE
     * Store the code for all SVGs in an array.
     *
     * @var array
     */
    public static $ui_icons = array(
        'arrow-up'          => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M12.8 48.4a6.4 6.4 0 008.9 0l22-22v62.3c0 3.5 2.8 6.3 6.3 6.3s6.3-2.8 6.3-6.3V26.4l22 22a6.4 6.4 0 008.9 0 6.4 6.4 0 000-8.9L54.4 6.8C53.2 5.6 51.6 5 50 5s-3.2.6-4.4 1.8L12.8 39.6a6.3 6.3 0 000 8.8z"/></svg>',

        'chevron-down'      => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M92.9 26a7.4 7.4 0 00-10.3 0L50 58.6 17.4 26A7.3 7.3 0 107.1 36.3L44.9 74a7.1 7.1 0 005.1 2.1c1.9.1 3.7-.7 5.1-2.1l37.8-37.8a7.2 7.2 0 000-10.2z"/></svg>',
        
        'chevron-right'     => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M26 7.1a7.4 7.4 0 000 10.3L58.6 50 26 82.6a7.4 7.4 0 000 10.3 7.4 7.4 0 0010.3 0L74 55.1a7.1 7.1 0 002.1-5.1c.1-1.9-.7-3.7-2.1-5.1L36.3 7.1a7.4 7.4 0 00-10.3 0z"/></svg>',
    );
}
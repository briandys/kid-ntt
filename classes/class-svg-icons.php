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
    public static function ntt__kid_ntt__function__get_svg( $icon, $group = 'ui', $color = '#1C1C1C' ) {
        
        if ( 'ui' === $group ) {
            $arr = self::$ui_icons;
        } else if ( 'hexetidine' === $group ) {
            $arr = ntt__kid_ntt__snaps__hexetidine_ntt__function__icons();
        } else {
            $arr = array();
        }
        
        if ( array_key_exists( $icon, $arr ) ) {
            $repl = '<svg aria-hidden="true" role="img" focusable="false" ';
            $svg  = preg_replace( '/^<svg /', $repl, trim( $arr[ $icon ] ) ); // Add extra attributes to SVG code.
            $svg  = str_replace( '#1C1C1C', $color, $svg );   // Replace the color.
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
        'arrow-up'          => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="ntt--arrow-up-icon ntt--icon"><path d="M12.8 48.4a6.4 6.4 0 008.9 0l22-22v62.3c0 3.5 2.8 6.3 6.3 6.3s6.3-2.8 6.3-6.3V26.4l22 22a6.4 6.4 0 008.9 0 6.4 6.4 0 000-8.9L54.4 6.8C53.2 5.6 51.6 5 50 5s-3.2.6-4.4 1.8L12.8 39.6a6.3 6.3 0 000 8.8z"/></svg>',

        'chevron-down'      => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="ntt--chevron-down-icon ntt--icon"><path d="M92.9 26a7.4 7.4 0 00-10.3 0L50 58.6 17.4 26A7.3 7.3 0 107.1 36.3L44.9 74a7.1 7.1 0 005.1 2.1c1.9.1 3.7-.7 5.1-2.1l37.8-37.8a7.2 7.2 0 000-10.2z"/></svg>',
        
        'chevron-left'      => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="ntt--chevron-left-icon ntt--icon"><path d="M74 92.9a7.4 7.4 0 000-10.3L41.4 50 74 17.4A7.3 7.3 0 1063.7 7.1L26 44.9a7.1 7.1 0 00-2.1 5.1c-.1 1.9.7 3.7 2.1 5.1l37.8 37.8a7.2 7.2 0 0010.2 0z"/></svg>',
        
        'chevron-right'     => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="ntt--chevron-right-icon ntt--icon"><path d="M26 7.1a7.4 7.4 0 000 10.3L58.6 50 26 82.6a7.4 7.4 0 000 10.3 7.4 7.4 0 0010.3 0L74 55.1a7.1 7.1 0 002.1-5.1c.1-1.9-.7-3.7-2.1-5.1L36.3 7.1a7.4 7.4 0 00-10.3 0z"/></svg>',
        
        'chevron-up-down'   => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="ntt--chevron-up-down-icon ntt--icon"><path d="M24 35a4.4 4.4 0 006.2 0l19.6-19.5 19.6 19.6a4.4 4.4 0 006.2-6.2L52.9 6.3a4.3 4.3 0 00-3-1.3 4 4 0 00-3.1 1.3L24 28.9a4.4 4.4 0 000 6.2zM76 65a4.4 4.4 0 00-6.3 0L50.3 84.4 30.6 64.9a4.4 4.4 0 00-6.2 6.2l22.7 22.6a4.3 4.3 0 003 1.3 4 4 0 003.1-1.3L76 71.1a4.4 4.4 0 000-6.2z"/></svg>',

        'loading-indicator' => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="ntt--loading-indicator-icon ntt--icon"><path d="M77 83.8a7 7 0 01-4.8-2 6.7 6.7 0 010-9.6 31.2 31.2 0 000-44.4 31.2 31.2 0 00-44.4 0 31.2 31.2 0 000 44.4c2.7 2.7 2.7 7 0 9.6a6.7 6.7 0 01-9.6 0 44.7 44.7 0 010-63.6 44.7 44.7 0 0163.6 0 44.7 44.7 0 010 63.6c-1.3 1.4-3 2-4.8 2z"/></svg>',
        
        'menu'              => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="ntt--menu-icon ntt--icon"><path d="M88.992 74H11.007a6.011 6.011 0 00-4.248 1.757 5.996 5.996 0 000 8.486A6.01 6.01 0 0011.007 86h77.875a6.014 6.014 0 005.65-3.678A5.993 5.993 0 0094.999 80a5.893 5.893 0 00-1.73-4.273A5.906 5.906 0 0088.993 74zM88.992 44H11.007a6.014 6.014 0 00-4.248 1.757 6 6 0 00-1.302 6.54 5.998 5.998 0 003.251 3.246c.73.302 1.51.457 2.3.457h77.874a6.014 6.014 0 005.65-3.678A5.993 5.993 0 0094.999 50a5.893 5.893 0 00-1.73-4.273A5.906 5.906 0 0088.993 44zM88.992 14H11.007a6.01 6.01 0 00-4.248 1.757 5.996 5.996 0 000 8.486A6.01 6.01 0 0011.007 26h77.875a6.014 6.014 0 005.65-3.678A5.993 5.993 0 0094.999 20a5.893 5.893 0 00-1.73-4.273A5.906 5.906 0 0088.993 14z" fill="#000"/></svg>',

        'wink'              => '<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="ntt--wink-icon ntt--icon"><path d="M50 82a38.3 38.3 0 01-35.7-24.7 5.4 5.4 0 1110.2-3.8A27.4 27.4 0 0050 71.2c11.3 0 21.5-7.1 25.5-17.7a5.5 5.5 0 017-3.2 5.5 5.5 0 013.2 7A38.3 38.3 0 0150 82zM81.5 33c-1.5 0-2.8-.9-3.4-2.3a4.6 4.6 0 00-4.2-2.9 4.7 4.7 0 00-4.2 2.9 3.5 3.5 0 01-4.6 2.1 3.5 3.5 0 01-2.1-4.6c1.7-4.5 6.1-7.6 10.9-7.6s9.2 3 10.9 7.6c.7 1.9-.2 3.9-2.1 4.6l-1.2.2z"/><circle cx="27.7" cy="26.1" r="8.1"/></svg>',
    );
}
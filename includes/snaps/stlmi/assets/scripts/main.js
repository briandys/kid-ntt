( function( $, window, document, undefined ) {
    'use strict';

    var kidNtt = kidNtt || {};

    const html = document.documentElement;

    /**
     * Is the DOM ready?
     *
     * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
     *
     * @param {Function} fn Callback function to run.
     */
    function nttDomReady( fn ) {
        if ( typeof fn !== 'function' ) {
            return;
        }

        if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
            return fn();
        }

        document.addEventListener( 'DOMContentLoaded', fn, false );
    }

    nttDomReady( function() {
        
    } );
} )( jQuery, window, document );


// https://splidejs.com/tutorials/image-slider/
document.addEventListener( 'DOMContentLoaded', function () {
            
    if ( document.querySelector( '.hero-slider' ) ) {

        new Splide( '.hero-slider', {
            cover       : true,
        } ).mount();
    }

    if ( document.querySelector( '.testimonies-slider' ) ) {

        new Splide( '.testimonies-slider', {
            cover       : true,
            perPage     : 3,
        } ).mount();
    }
} );
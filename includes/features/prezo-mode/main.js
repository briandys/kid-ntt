var kidNttFeature = kidNttFeature || {};

kidNttFeature.prezoMode = {

    init: function() {
        
        const html = document.documentElement;
        
        var wildCard = document.getElementById( 'ntt--wild-card' );

        // Check if the toolbar is already setup
        if ( ! html.contains( document.getElementById( 'ntt--wild-card-toolbar---js' ) ) ) {
            var toolbar = document.createElement( 'div' );
            toolbar.id = 'ntt--wild-card-toolbar---js';
            toolbar.className = 'ntt--wild-card-toolbar---js';
            wildCard.appendChild( toolbar );
        }
    
        var toolbar = document.getElementById( 'ntt--wild-card-toolbar---js' );
    
        var prezoAxn = document.createElement( 'button' );
        prezoAxn.innerHTML = 'Prezo';
        prezoAxn.id = 'ntt--kid-ntt--feature--prezo-mode-axn--js';
        prezoAxn.className = 'ntt--kid-ntt--feature--prezo-mode-axn--js';
        toolbar.appendChild( prezoAxn );
        
        prezoAxn.addEventListener( 'click', () => {
            html.classList.toggle( 'ntt--kid-ntt--feature--prezo-mode---active--js' );
        }, false );
    }
}; // kidNttFeature.prezoMode

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
    kidNttFeature.prezoMode.init();
} );
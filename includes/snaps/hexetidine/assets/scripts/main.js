var kidNttHexetidine = kidNttHexetidine || {};

/*	-----------------------------------------------------------------------------------------------
Display a Random Image from a Set
.ntt--js--random-image
https://stackoverflow.com/a/19693578
--------------------------------------------------------------------------------------------------- */
kidNttHexetidine.displayRandomQuote = {

    init: function() {
        var nttDataArray = [
            nttKidNttHexetidineData.one,
            nttKidNttHexetidineData.two,
            nttKidNttHexetidineData.three,
            nttKidNttHexetidineData.four,
        ];
        
        var num = Math.floor( Math.random() * ( nttDataArray.length ) );
        var entitySecondaryInfo = document.querySelector( '.ntt--entity-secondary-info' );
        var quotes = document.createElement( 'div' );
        quotes.className = 'ntt--kid-ntt--hexetidine--quotes--js';
        quotes.innerHTML = nttDataArray[num];
        
        entitySecondaryInfo.insertAdjacentHTML( 'beforebegin', quotes.outerHTML );
    }
}; // kidNttHexetidine.displayRandomQuote

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
    kidNttHexetidine.displayRandomQuote.init();
} );
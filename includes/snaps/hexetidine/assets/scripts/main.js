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
            nttKidNttHexetidineData.five,
            nttKidNttHexetidineData.six,
            nttKidNttHexetidineData.seven,
        ];
        
        var num = Math.floor( Math.random() * ( nttDataArray.length ) );
        var entitySecondaryInfo = document.querySelector( '.ntt--entity-secondary-info' );
        var quotes = document.createElement( 'div' );
        quotes.className = 'ntt--kid-ntt--hexetidine--quotes--js';
        quotes.innerHTML = nttDataArray[num];
        
        entitySecondaryInfo.insertAdjacentHTML( 'beforebegin', quotes.outerHTML );
    }
}; // kidNttHexetidine.displayRandomQuote

kidNttHexetidine.backButton = {

    init: function() {
        var aboutPage = document.querySelector( '.ntt--site-id--briandys-com--view.ntt--page--about--view' );
        
        if ( aboutPage ) {
            var entryName = aboutPage.querySelector( '.ntt--entry-name' );            
            
            var axn = document.createElement( 'a' );
            axn.className = 'ntt--kid-ntt--back-axn--js';
            axn.href = '../';
            axn.setAttribute( 'title', nttKidNttHexetidineData.backTxt );
            axn.innerHTML = '<span class="ntt--txt">' + nttKidNttHexetidineData.backTxt + '</span>' + nttData.chevronLeftIcon;
            entryName.insertAdjacentHTML( 'beforebegin', axn.outerHTML );
        }
    }
}; // kidNttHexetidine.backButton

kidNttHexetidine.currentYear = {

    init: function() {
        var yearTxt = document.querySelectorAll( '.ntt--cm-date .ntt--year-txt' );        
        
        if ( yearTxt ) {

            var currentYear = new Date().getFullYear();
            
            yearTxt.forEach( function ( el ) {

                if ( el.textContent == currentYear ) {
                    el.closest( '.ntt--cm-date' ).classList.add( 'ntt--cm-date--current-year--js' );
                }                
            } );
        }
    }
}; // kidNttHexetidine.currentYear

kidNttHexetidine.jetpackRelatedPosts = {

    init: function() {
        var postContext = document.querySelectorAll( '.jp-relatedposts-post-context' );        
        
        if ( postContext ) {

            postContext.forEach( function ( el ) {
                var txt = el.textContent.replace( /In "|"/g, '' );
                el.textContent = txt;
            } );
        }
    }
}; // kidNttHexetidine.jetpackRelatedPosts

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
    // kidNttHexetidine.displayRandomQuote.init();
    kidNttHexetidine.backButton.init();
    kidNttHexetidine.currentYear.init();
    kidNttHexetidine.jetpackRelatedPosts.init();
} );
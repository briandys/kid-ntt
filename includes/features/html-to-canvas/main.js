/**
 * HTML to Canvas
 * .ntt--f5e--html-to-canvas
 * Adds a button to save screenshot of the page
 * https://html2canvas.hertzen.com
 * https://github.com/eKoopmans/html2pdf.js/
 */
var kidNttF5eHtmlToCanvas = kidNttF5eHtmlToCanvas || {};

const html = document.documentElement;

kidNttF5eHtmlToCanvas.htmlToCanvas = {

    init: function() {

        if ( html.classList.contains( 'ntt--kid-ntt--feature--html-to-canvas' ) ) {
            this.createButton();
        }
    },

    createButton: function() {

        var wildCard = document.getElementById( 'ntt--wild-card' );
        var content = document.getElementById( 'content' );
        var capture = content;
        var toolbar = document.getElementById('ntt--wild-card-toolbar---js');
        
        // If there is no toolbar, create one
        if ( ! toolbar ) {
            var toolbar = document.createElement( 'div' );
            toolbar.id = 'ntt--wild-card-toolbar---js';
            toolbar.className = 'ntt--wild-card-toolbar---js';
            wildCard.appendChild( toolbar );
        }

        // Create the download button
        var downloadAxn = document.createElement( 'button' );
        downloadAxn.id = 'ntt--html-to-canvas-download-axn--js';
        downloadAxn.className = 'ntt--html-to-canvas-download-axn--js';
        downloadAxn.setAttribute('data-html2canvas-ignore', 'true');
        downloadAxn.innerHTML = '<span class="ntt--txt">' + nttData.downloadScreenshotTxt + '</span>';
        toolbar.appendChild( downloadAxn );
        
        // Create the button's click event
        downloadAxn.addEventListener( 'click', () => {
            
            let options = {
                logging: false,
                scale: 2.5,
                backgroundColor: '#ffffff',
                useCORS: true,
                ignoreElements: function ( el ) {
                    return el == content.querySelector( '.jp-relatedposts' ) || el == content.querySelector( '.ntt--entry-footer' );
                }
            };
            
            html2canvas( capture, options ).then( function( canvas ) {
                kidNttF5eHtmlToCanvas.htmlToCanvas.saveAs( canvas.toDataURL(), 'ntt--html-to-canvas.png' );
            } );

            downloadAxn.classList.add( 'ntt--html-to-canvas---downloading--js' );
            downloadAxn.classList.remove( 'ntt--html-to-canvas---downloaded--js' );
            downloadAxn.setAttribute( 'disabled', 'true' );
            downloadAxn.insertAdjacentHTML( 'beforeend', nttData.loadingIndicator );
        } );
    },

    saveAs: function( uri, filename ) {
        var link = document.createElement( 'a' );
        var downloadAxn = document.getElementById( 'ntt--html-to-canvas-download-axn--js' );
        
        if ( typeof link.download === 'string' ) {
            link.href = uri;
            link.download = filename;

            // Firefox requires the link to be in the body
            document.body.appendChild( link );

            // Simulate click
            link.click();

            // Remove the link when done
            document.body.removeChild( link );

            window.setTimeout( function() {
                downloadAxn.classList.add( 'ntt--html-to-canvas---downloaded--js' );
                downloadAxn.classList.remove( 'ntt--html-to-canvas---downloading--js' );
                downloadAxn.removeAttribute( 'disabled' );
                downloadAxn.querySelector( '.ntt--loading-indicator-icon' ).remove();
            }, 5000 );
        } else {
            window.open( uri ) ;
        }
    },

    contentIntersection: function() {
        var content = document.querySelector( '.ntt--entry-main' );

        var observer = new IntersectionObserver( handleIntersect, {
            rootMargin: '0px 0px 0px 0px',
            threshold: [.15, .85]
        } );
    
        observer.observe( content );

        function handleIntersect( entries ) {

            entries.forEach( ( entry ) => {
                if ( entry.isIntersecting ) {
                    html.classList.add( 'ntt--content--intersected--js' );
                } else {
                    html.classList.remove( 'ntt--content--intersected--js' );
                }
            } );
        }
    }
}; // kidNttF5eHtmlToCanvas.htmlToCanvas

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
    kidNttF5eHtmlToCanvas.htmlToCanvas.init();
    kidNttF5eHtmlToCanvas.htmlToCanvas.contentIntersection();
} );
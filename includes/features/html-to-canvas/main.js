/**
 * HTML to Canvas
 * .ntt--f5e--html-to-canvas
 * Adds a button to save screenshot of the page
 * https://html2canvas.hertzen.com
 * https://github.com/eKoopmans/html2pdf.js/
 */
( function( $, window, document, undefined ) {
    'use strict';

    var kidNtt = kidNtt || {};

    const html = document.documentElement;

    kidNtt.htmlToCanvas = {

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
            downloadAxn.id = 'ntt--kid-ntt--feature--html-to-canvas-download-axn--js';
            downloadAxn.className = 'ntt--kid-ntt--feature--html-to-canvas-download-axn--js';
            downloadAxn.setAttribute('data-html2canvas-ignore', 'true');
            downloadAxn.innerHTML = nttData.loadingIndicator;
            toolbar.appendChild( downloadAxn );
            
            // Create the button's click event
            downloadAxn.addEventListener( 'click', () => {
                
                let options = {
                    scale: 2.5,
                    backgroundColor: '#ffffff',
                    useCORS: true,
                    ignoreElements: function ( el ) {
                        return el == content.querySelector( '.jp-relatedposts' ) || el == content.querySelector( '.ntt--entry-footer' );
                    }
                };
                
                html2canvas( capture, options ).then( function( canvas ) {
                    kidNtt.htmlToCanvas.saveAs( canvas.toDataURL(), 'ntt--html-to-canvas.png' );
                } );
            } );
        },

        saveAs: function( uri, filename ) {
            var link = document.createElement( 'a' );
            
            if ( typeof link.download === 'string' ) {
                link.href = uri;
                link.download = filename;

                // Firefox requires the link to be in the body
                document.body.appendChild( link );

                // Simulate click
                link.click();

                // Remove the link when done
                document.body.removeChild( link );
            } else {
                window.open( uri ) ;
            }
        }
    }; // kidNtt.htmlToCanvas

    window.addEventListener( 'load', function() {
        kidNtt.htmlToCanvas.init();
    } );
} )( jQuery, window, document );
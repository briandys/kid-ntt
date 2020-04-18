/**
 * HTML to Canvas
 * .ntt--f5e--html-to-canvas
 * Adds a button to save screenshot of the page
 * https://html2canvas.hertzen.com
 * https://github.com/eKoopmans/html2pdf.js/
 */
( function() {

    const html = document.documentElement;

    if ( html.classList.contains('ntt--kid-ntt--feature--html-to-canvas') ) {
        
        const wildCard = document.getElementById( 'ntt--wild-card' );
        const capture = document.getElementById( 'content' );
        const ignoreElements = document.querySelector( '.ntt--entry-footer' );
        
        if ( ! html.contains( document.getElementById( 'ntt--wild-card-toolbar---js' ) ) ) {
            let toolbar = document.createElement('div');
            toolbar.id = 'ntt--wild-card-toolbar---js';
            toolbar.className = 'ntt--wild-card-toolbar---js';
            wildCard.appendChild(toolbar);
        }

        const toolbar = document.getElementById('ntt--wild-card-toolbar---js');

        const downloadAxn = document.createElement('button');
        downloadAxn.innerHTML = nttData.downloadScreenshotTxt;
        downloadAxn.id = 'ntt--kid-ntt--feature--html-to-canvas-download-axn--js';
        downloadAxn.className = 'ntt--kid-ntt--feature--html-to-canvas-download-axn--js';
        downloadAxn.setAttribute('data-html2canvas-ignore', 'true');
        toolbar.appendChild( downloadAxn );
        
        downloadAxn.addEventListener('click', () => {
            
            let options = {
                scale: 2,
                backgroundColor: '#ffffff',
                useCORS: true,
                ignoreElements: ( el ) => el == ignoreElements
            };
            
            html2canvas( capture, options ).then(function( canvas ) {
                saveAs( canvas.toDataURL(), 'ntt--html-to-canvas.png' );
            });
        });
        
        function saveAs( uri, filename ) {
            var link = document.createElement( 'a' );
            if ( typeof link.download === 'string' ) {
                link.href = uri;
                link.download = filename;

                //Firefox requires the link to be in the body
                document.body.appendChild( link );

                //simulate click
                link.click();

                //remove the link when done
                document.body.removeChild( link );
            } else {
                window.open( uri) ;
            }
        }
    }
})();
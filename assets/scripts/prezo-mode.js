( function() {

    const html = document.documentElement;
    const body = document.body;

    /**
     * Prezo Mode
     */
    if ( html.classList.contains( 'ntt--prezo-mode' ) ) {

        const prezoButton = document.createElement( 'button' );
        prezoButton.innerHTML = 'Prezo';
        prezoButton.id = 'prezo-mode-axn';

        body.appendChild( prezoButton );
        prezoButton.addEventListener( 'click', () => {
            html.classList.toggle( 'prezo--active' );
        }, false);
    }

    if ( html.classList.contains( 'ntt--download-mode' ) ) {
    
        /**
        * https://html2canvas.hertzen.com
        */
        const capture = document.querySelector( '#comment' );
        const dlButton = document.createElement( 'button' );
        dlButton.innerHTML = 'Download';
        dlButton.id = 'download-axn';

        body.appendChild( dlButton );
        
        dlButton.addEventListener( 'click', function() {
            
            let options = { scale: 6, backgroundColor: 'null' };
            
            html2canvas( capture, options ).then( function( canvas ) {
                console.log( canvas );
                saveAs( canvas.toDataURL(), 'download.png' );
            } );
        } );

        function saveAs( uri, filename ) {
            var link = document.createElement('a');
            if (typeof link.download === 'string') {
                link.href = uri;
                link.download = filename;

                //Firefox requires the link to be in the body
                document.body.appendChild(link);

                //simulate click
                link.click();

                //remove the link when done
                document.body.removeChild(link);
            } else {
                window.open(uri);
            }
        }
    }
} )();
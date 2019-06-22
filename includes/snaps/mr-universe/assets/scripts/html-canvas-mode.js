( function() {

    const html = document.documentElement;
    const body = document.body;

    if ( html.classList.contains( 'ntt--html-canvas-mode' ) ) {
    
        /**
        * https://html2canvas.hertzen.com
        */
        const capture = document.querySelector( '#start' );
        const dlButton = document.createElement( 'button' );
        dlButton.innerHTML = 'Download';
        dlButton.id = 'download-axn';
        dlButton.setAttribute( 'data-html2canvas-ignore', 'true' );

        body.appendChild( dlButton );
        
        dlButton.addEventListener( 'click', function() {
            
            let options = {
                scale: 1,
                backgroundColor: null
            };
            
            html2canvas( capture, options ).then( function( canvas ) {
                //console.log( canvas );
                saveAs( canvas.toDataURL(), 'ntt--html-canvas.png' );
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
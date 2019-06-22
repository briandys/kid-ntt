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
} )();
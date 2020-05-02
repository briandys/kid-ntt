(function() {

    const html = document.documentElement;

    const wildCard = document.getElementById('ntt--wild-card');
        
    if ( ! html.contains(document.getElementById('ntt--wild-card-toolbar---js')) ) {
        let toolbar = document.createElement('div');
        toolbar.id = 'ntt--wild-card-toolbar---js';
        toolbar.className = 'ntt--wild-card-toolbar---js';
        wildCard.appendChild(toolbar);
    }

    const toolbar = document.getElementById('ntt--wild-card-toolbar---js');

    const prezoAxn = document.createElement( 'button' );
    prezoAxn.innerHTML = 'Prezo';
    prezoAxn.id = 'ntt--kid-ntt--feature--prezo-mode-axn--js';
    prezoAxn.className = 'ntt--kid-ntt--feature--prezo-mode-axn--js';
    toolbar.appendChild( prezoAxn );
    
    prezoAxn.addEventListener( 'click', () => {
        html.classList.toggle( 'ntt--kid-ntt--feature--prezo-mode---active--js' );
    }, false);
})();
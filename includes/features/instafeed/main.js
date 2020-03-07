(function() {
    /**
     * http://instafeedjs.com/
     */
    const html = document.documentElement;

    if (html.classList.contains('ntt--kid-ntt--feature--instafeed')) {
        const entityFooter = document.querySelector('.ntt--entity-footer');
        var instafeedTarget = document.getElementById('ntt--kid-ntt--feature--instafeed--js');

        if (! instafeedTarget) {
            let instaFeed = document.createElement( 'div' );
            instaFeed.id = 'ntt--kid-ntt--feature--instafeed--js';
            instaFeed.className = 'ntt--kid-ntt--feature--instafeed--js';
            entityFooter.prepend( instaFeed );
        }

        instafeedTarget = document.getElementById('ntt--kid-ntt--feature--instafeed--js');
        
        var feed = new Instafeed( {
            get: 'user',
            userId: '5371345175',
            accessToken: '5371345175.895a175.475ca57f30564a169b2fad80458f16cf',
            limit: '4',
            resolution: 'standard_resolution',
            sortBy: 'most-recent',
            target: instafeedTarget
        } );
        
        feed.run();
    }
})();
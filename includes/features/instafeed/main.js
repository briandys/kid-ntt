(function() {
    /**
     * http://instafeedjs.com/
     */
    const html = document.documentElement;
    const body = document.body;

    if ( html.classList.contains('ntt--f5e--instafeed')) {

        var feed = new Instafeed( {
            get: 'user',
            userId: '5371345175',
            accessToken: '5371345175.895a175.475ca57f30564a169b2fad80458f16cf',
            limit: '4',
            resolution: 'standard_resolution',
            sortBy: 'most-recent',
            target: 'instafeedx'
        } );
        feed.run();
    }
})();
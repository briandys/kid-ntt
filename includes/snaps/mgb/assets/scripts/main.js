( function() {

    /**
     * Instafeed.js
     * Display personal Instagram feed
     * http://instafeedjs.com/
     */
    
    if ( document.getElementById( 'instafeed' ) ) {
        var feed = new Instafeed( {
            get: 'user',
            userId: '5371345175',
            accessToken: '5371345175.895a175.475ca57f30564a169b2fad80458f16cf',
            limit: '4',
            resolution: 'standard_resolution',
            sortBy: 'most-recent'
        } );
        feed.run();
    }
} )();
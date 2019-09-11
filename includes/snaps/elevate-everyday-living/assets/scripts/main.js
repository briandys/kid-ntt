( function() {

    /**
     * Instafeed.js
     * Display personal Instagram feed
     * http://instafeedjs.com/
     */
    
    var feed = new Instafeed( {
        get: 'user',
        userId: '48337687',
        accessToken: '48337687.d6260f0.9247f40c627f4abda968394e1353154f',
        limit: '4',
        resolution: 'standard_resolution',
        sortBy: 'most-recent'
    } );
    feed.run();
} )();
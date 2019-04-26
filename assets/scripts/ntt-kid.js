( function( $ ) {

	/**
	 * Wrap Text Node
	 * https://stackoverflow.com/a/18727318
	 */
	wrapTextNode = function( $elem ) {
		var $textNodeMU = $( '<span />', { 'class': 'txt' } );
		$elem.contents().filter( function() {
			return this.nodeType === 3;
		} ).wrap( $textNodeMU );
	}

	/**
	 * Remove Empty Elements
	 * https://stackoverflow.com/a/18727318
	 */
	removeEmpty = function( $elem ) {
		$elem.each( function() {
			var $this = $( this );
			if ( $this.html().replace(/\s|&nbsp;/g, '' ).length == 0 ) {
				$this.remove();
			}
		} );
	}

    /**
     * All text nodes will be wrapped in .txt. If empty, remove it.
     */
	var $content = $( '.entry-full-content---cr' );
	wrapTextNode( $content );
    removeEmpty( $content.find( '.txt' ) );
    
    /**
     * If entry has image as content, content snippet will strip it, leaving it empty.
     */
    var $contentSnippet = $( '.content-snippet' );
    removeEmpty( $contentSnippet.find( '*' ) );
    removeEmpty( $contentSnippet );

} )( jQuery );

( function() {

    /** 
     * Wrap Element
     * 
     * https://plainjs.com/javascript/manipulation/wrap-an-html-structure-around-an-element-28/
     */
    function wrap(el, wrapper) {
        el.parentNode.insertBefore(wrapper, el);
        wrapper.appendChild(el);
    }

    const html = document.documentElement;
    const body = document.body;

    /**
     * Wrap Table <table>
     */
    const contentTable = document.querySelectorAll( '.content---cr > table' );

    contentTable.forEach( ( el ) => {
        var skin = document.createElement( 'div' );
        skin.className = 'table-skin obj';
        wrap( el, skin );
    } );

    /**
     * Wrap Preformatted Text <pre>
     */
    const contentPre = document.querySelectorAll( '.content---cr > pre' );
    
    contentPre.forEach( ( el ) => {
        var skin = document.createElement( 'div' );
        skin.className = 'pre-skin obj';
        wrap( el, skin );
    } );

    /**
     * Wrap Code <code>
     */
    const contentCode = document.querySelectorAll( '.content---cr code' );
    
    contentCode.forEach( ( el ) => {
        var skin = document.createElement( 'span' );
        skin.className = 'code-skin obj';
        wrap( el, skin );
    } );

    /**
     * Entries Navigation
     */
    const entriesNavi = document.querySelectorAll( '.entries-nav li' );

    entriesNavi.forEach( ( el ) => {
        
        if ( el.querySelector( '.next' ) ) {
            el.classList.add( 'next-navi' );
        }

        if ( el.querySelector( '.prev' ) ) {
            el.classList.add( 'previous-navi' );
        }

        if ( el.querySelector( '.current' ) ) {
            el.classList.add( 'current-navi' );
        }
    } );
} )();
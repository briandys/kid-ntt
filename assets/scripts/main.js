( function( $ ) {

	/**
	 * Wrap Text Node
	 * https://stackoverflow.com/a/18727318
	 */

	wrapTextNode = function( $elem ) {
		var $textNodeMU = $( '<span />', { 'class': 'ntt--txt' } );
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
     * All text nodes will be wrapped in txt CSS class name. If empty, remove it.
     */

	var $content = $( '.ntt--content' );
	wrapTextNode( $content );
    removeEmpty( $content.find( '.ntt--txt' ) );

    /**
     * All text nodes will be wrapped in .txt. If empty, remove it.
     */

	var $categories = $( '.ntt--entry-categories' );
	wrapTextNode( $categories );
    removeEmpty( $categories.find( '.ntt--txt' ) );
    
    /**
     * If Entry's only content is an image, it will not appear in Search Results, leaving Content Snippet with empty elements—so might as well remove them.
     */

    var $contentSnippet = $( '.ntt--entry-content-snippet' );
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

    /**
     * Wrap Table <table>
     */

    const contentTable = document.querySelectorAll( '.ntt--content > table' );

    contentTable.forEach( ( el ) => {
        var skin = document.createElement( 'div' );
        skin.className = 'ntt--table-wrapper ntt--obj';
        wrap( el, skin );
    } );

    /**
     * Wrap Preformatted Text <pre>
     */

    const contentPre = document.querySelectorAll( '.ntt--content > pre' );
    
    contentPre.forEach( ( el ) => {
        var skin = document.createElement( 'div' );
        skin.className = 'ntt--pre-wrapper ntt--obj';
        wrap( el, skin );
    } );

    /**
     * Wrap Code <code>
     */

    const contentCode = document.querySelectorAll( '.ntt--content code' );
    
    contentCode.forEach( ( el ) => {
        var skin = document.createElement( 'span' );
        skin.className = 'ntt--code-wrapper ntt--obj';
        wrap( el, skin );
    } );

    /**
     * Entries Navigation
     */

    const entriesNavi = document.querySelectorAll( '.ntt--entries-nav li' );

    entriesNavi.forEach( ( el ) => {
        
        if ( el.querySelector( '.next' ) ) {
            el.classList.add( 'ntt--next-entries-navi' );
        }

        if ( el.querySelector( '.prev' ) ) {
            el.classList.add( 'ntt--previous-entries-navi' );
        }

        if ( el.querySelector( '.current' ) ) {
            el.classList.add( 'ntt--current-entries-navi' );
        }
    } );
} )();
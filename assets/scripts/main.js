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

    const html = document.documentElement;

    /**
     * Adding, removing, and testing for classes
     * https://plainjs.com/javascript/attributes/adding-removing-and-testing-for-classes-9/
     */
    function hasClass(el, className) {
        return el.classList ? el.classList.contains(className) : new RegExp('\\b'+ className+'\\b').test(el.className);
    }

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

    /**
     * Initialize Sub-menu CSS Class Name
     */

    const nav = document.querySelectorAll( '.ntt--nav' );
    const widgetNav = document.querySelectorAll( '.ntt--widget_nav_menu' );
    
    nav.forEach( function ( el ) {

        if ( el.querySelector( '.children, .sub-menu' ) !== null ) {
            el.classList.add( 'ntt--nav---sub-menu--js' );
        }
    } );

    widgetNav.forEach( function ( el ) {

        if ( el.querySelector( '.sub-menu' ) !== null ) {
            el.classList.add( 'ntt--nav---sub-menu--js' );
        }
    } );

    const currentNavItem = document.querySelectorAll( '.current-menu-item, .current_page_item' );
    
    currentNavItem.forEach( function ( el ) {

        el.classList.add( 'ntt--sub-menu-current-item--js' );
    } );

    /**
     * Sub-menu
     * 
     * Prepends a control to hide and show the sub-menu
     */

    const subMenu = document.querySelectorAll( '.children, .sub-menu' );
    let i = 0;

    subMenu.forEach( ( el ) => {
        
        i++;
        const parent = el.parentNode;
        
        // Create Checkbox
        const checkbox = document.createElement( 'input' );
        checkbox.type = 'checkbox';
        checkbox.id = 'ntt--sub-menu-checkbox-' + i + '--js';
        checkbox.className = 'ntt--sub-menu-checkbox--js';
        checkbox.setAttribute( 'arial-label', 'Show Menu' );

        // Create Label
        const label = document.createElement( 'label' );
        label.setAttribute( 'for', 'ntt--sub-menu-checkbox-' + i + '--js' );
        label.className = 'ntt--sub-menu-checkbox-label--js ntt--obj';
        label.innerHTML = '<span class="ntt--txt">Show Menu</span>';
        
        // Insert in DOM
        parent.insertBefore( label, el );
        parent.insertBefore( checkbox, label );

        el.classList.add( 'ntt--sub-menu--js' );
        parent.classList.add( 'ntt--sub-menu-ancestor--js' );
    } );

    /**
     * Uncheck checkboxes when clicked outside the element
     */
    const subMenuAncestor = document.querySelectorAll( '.ntt--sub-menu-ancestor--js' );

    window.addEventListener( 'click', function ( event ) {

        subMenuAncestor.forEach( function ( el ) {

            const targetEl = el.contains( event.target );
        
            if ( ! targetEl ) {
                const input = el.getElementsByTagName('input');
                
                for ( var i = 0; i < input.length; i++ ) { 
                    if ( input[i].type === 'checkbox' ) { 
                        input[i].checked = false; 
                    }
                }

                el.classList.remove( 'ntt--sub-menu---active--js' );
            }
        } )
    }, false);
    
    /**
     * Initialize Activity Status on Sub-menu
     */
    
    ( function() {
        
        var input = document.querySelectorAll( '.ntt--nav---sub-menu--js input' );

        for ( var i = 0, len = input.length; i < len; i++ ) {
            
            if ( input[i].type === 'checkbox' ) {
                input[i].onclick = function() {
                    const parent = this.parentNode;
                    
                    if ( this.checked ) {
                        parent.classList.add( 'ntt--sub-menu---active--js' );
                    } else {
                        parent.classList.remove( 'ntt--sub-menu---active--js' );
                    }
                }
            }
        }
    } ) ();

    /**
     * Detect Tabbing and Mouse Usage
     * https://medium.com/hackernoon/removing-that-ugly-focus-ring-and-keeping-it-too-6c8727fefcd2
     */
    
    function handleFirstTab( e ) {
        
        if ( e.keyCode === 9 ) {
            html.classList.add('ntt--nav-mode---tab--js');
            window.removeEventListener('keydown', handleFirstTab);
            window.addEventListener('mousedown', handleMouseDownOnce);
        }
    }
      
    function handleMouseDownOnce() {
        html.classList.remove('ntt--nav-mode---tab--js');
        window.removeEventListener('mousedown', handleMouseDownOnce);
        window.addEventListener('keydown', handleFirstTab);
    }
    
    window.addEventListener('keydown', handleFirstTab);
} )();
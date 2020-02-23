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
     * element.closest Polyfill for IE9+
     * https://developer.mozilla.org/en-US/docs/Web/API/Element/closest
     */

    if (!Element.prototype.matches) {
        Element.prototype.matches = Element.prototype.msMatchesSelector || 
                                    Element.prototype.webkitMatchesSelector;
    }
      
    if (!Element.prototype.closest) {
        Element.prototype.closest = function(s) {
            var el = this;
              
            do {
                if (el.matches(s)) return el;
                el = el.parentElement || el.parentNode;
            } while (el !== null && el.nodeType === 1);
            return null;
        };
    }

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
     * Get Element Height Including Margin
     * 
     * http://youmightnotneedjquery.com/#outer_height
     */

    function outerHeight(el) {
        var height = el.offsetHeight;
        var style = getComputedStyle(el);

        height += parseInt(style.marginTop) + parseInt(style.marginBottom);
        return height;
    }

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

    const subMenu = document.querySelectorAll( '.ntt--nav .children, .ntt--nav .sub-menu, .ntt--widget_nav_menu .sub-menu' );
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
    
    ( function() {

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
    })();

    /**
     * Intersection Observer Targeting IDs
     * https://codepen.io/bramus/pen/ExaEqMJ
     */

    ( function() {
        window.addEventListener('DOMContentLoaded', () => {

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    const id = entry.target.getAttribute('id');
                    if (entry.intersectionRatio > 0) {
                        document.querySelector(`a[href="#${id}"]`).classList.add('ntt--intersected--js');
                        entry.target.classList.remove('ntt--not-intersected--js');
                        entry.target.classList.add('ntt--intersected--js');
                    } else {
                        document.querySelector(`a[href="#${id}"]`).classList.remove('ntt--intersected--js');
                        entry.target.classList.remove('ntt--intersected--js');
                    }
                });
            });
        
            // Track all sections that have an 'id' applied
            document.querySelectorAll('section[id]').forEach((section) => {
                observer.observe(section);
                section.classList.add('ntt--not-intersected--js');
            });
        });
    })();

    /**
     * Intersection Observer for Entity Footer
     * https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API
     */

    ( function() {
        let entityFooter;

        window.addEventListener('load', (event) => {
            entityFooter = document.querySelector('.ntt--entity-footer');
            createObserver();
        }, false);

        function createObserver() {
            let observer;
            observer = new IntersectionObserver(handleIntersect);
            observer.observe(entityFooter);
        }

        function handleIntersect(entries, observer) {
            entries.forEach((entry) => {
                if (entry.intersectionRatio > 0) {
                    entry.target.classList.add('ntt--intersected--js');
                } else {
                    entry.target.classList.remove('ntt--intersected--js');
                }
            });
        }
    })();

    /**
     * Assign Population Status of Input Elements
     */

    ( function() {

        let inputs = document.querySelectorAll( 'input[type="text"], input[type="email"], input[type="url"], input[type="search"], textarea' );
        let input = null;
        let formField = '.ntt--form-field';

        for ( var i = 0, len = inputs.length; i < len; i++ ) {
            input = inputs[i];

            if ( ! input.value ) {
                input.closest( formField ).classList.add('ntt--form-field---empty--js');
            } else {
                input.closest( formField ).classList.add('ntt--form-field---populated--js');
            }
        }
    })();

    /**
     * Assign Listeners to Comment Input Elements
     * https://stackoverflow.com/a/47944959
     */

    ( function() {

        if ( html.classList.contains('ntt--comment-creation---1--view') ) {
            
            const delegate = (selector) => (cb) => (e) => e.target.matches(selector) && cb(e);
            const inputDelegate = delegate('.text-input');
            const commentForm = document.getElementById('commentform');
            let formField = '.ntt--form-field';
            let focusInTxt = 'ntt--form-field---focusin--js';
            let focusOutTxt = 'ntt--form-field---focusout--js';
            let emptyTxt = 'ntt--form-field---empty--js';
            let populatedTxt = 'ntt--form-field---populated--js';

            // Focus In
            commentForm.addEventListener('focusin', inputDelegate((el) => {
                el.target.closest( formField ).classList.add(focusInTxt);
                el.target.closest( formField ).classList.remove(focusOutTxt);

                if ( ! el.target.value ) {
                    el.target.closest( formField ).classList.add(emptyTxt);
                    el.target.closest( formField ).classList.remove(populatedTxt);
                } else {
                    el.target.closest( formField ).classList.add(populatedTxt);
                    el.target.closest( formField ).classList.remove(emptyTxt);
                }
            }));

            // Focus Out
            commentForm.addEventListener('focusout', inputDelegate((el) => {
                el.target.closest( formField ).classList.add(focusOutTxt);
                el.target.closest( formField ).classList.remove(focusInTxt);

                if ( ! el.target.value ) {
                    el.target.closest( formField ).classList.add(emptyTxt);
                    el.target.closest( formField ).classList.remove(populatedTxt);
                } else {
                    el.target.closest( formField ).classList.add(populatedTxt);
                    el.target.closest( formField ).classList.remove(emptyTxt);
                }
            }));
        }
    })();

    /**
     * Display a Random Image from a Set
     * .ntt--js--random-image
     * https://stackoverflow.com/a/19693578
     */
    
    ( function() {
        
        if ( html.classList.contains('ntt--js--random-image') ) {
            window.addEventListener('DOMContentLoaded', function() {
                
                var imagesArray = [
                    '<a href="https://www.flickr.com/photos/briansahagun/3386389393" title="Nobody"><img src="https://live.staticflickr.com/3555/3386389393_084c05a47d_z.jpg" width="640" height="480" alt="Nobody"></a>',
                    '<a href="https://www.flickr.com/photos/briansahagun/3380918261" title="Fishbowl"><img src="https://live.staticflickr.com/3449/3380918261_752d542889_z.jpg" width="640" height="480" alt="Fishbowl"></a>',
                    '<a href="https://www.flickr.com/photos/briansahagun/3377609579" title="Tie the Knot"><img src="https://live.staticflickr.com/3417/3377609579_505cddb043_z.jpg" width="640" height="427" alt="Tie the Knot"></a>'
                ];
                
                var num = Math.floor(Math.random() * (imagesArray.length));
                document.getElementById('canvas').innerHTML = imagesArray[num];
            });
        }
    })();

    /**
     * Data Scroll Y
     * .ntt--js--data-scroll-y
     * 
     * Sticky Header
     * .ntt--js--sticky-header
     * https://pqina.nl/blog/using-smart-css-to-time-your-wonderful-newsletter-popup/
     */

    ( function() {

        if ( html.classList.contains('ntt--js--data-scroll-y') || html.classList.contains('ntt--js--sticky-header') ) {

            // The debounce function receives our function as a parameter
            const debounce = (fn) => {

                // This holds the requestAnimationFrame reference, so we can cancel it if we wish
                let frame;

                // The debounce function returns a new function that can receive a variable number of arguments
                return (...params) => {
                    
                    // If the frame variable has been defined, clear it now, and queue for next frame
                    if (frame) { 
                    cancelAnimationFrame(frame);
                    }

                    // Queue our function call for the next frame
                    frame = requestAnimationFrame(() => {
                    
                    // Call our function and pass any params we received
                    fn(...params);
                    });
                } 
            };

            // Returns an array of steps from value to 0
            const stack = (value, step) => {
                value = Math.floor(value / step) * step;
                const parts = [value];
                while (value > 0) {
                    value -= step;
                    parts.push(value);
                }
                return parts.reverse();
            }

            // Creates an environment store at a certain element
            const createEnvStore = (props, root = document.documentElement) => {
                const data = root.dataset;
                const sync = () => {
                    Object.entries(props).forEach(([key, value]) => {
                        data[key] = Array.isArray(value) ? value.join(' ') : value;
                    })
                }
                sync();
                return (key, value) => {
                    props[key] = value;
                    sync();
                    console.log(data);
                }
            };

            // Set default environment parameters
            const updateEnv = createEnvStore({
                'scrollY': window.scrollY,
                'scrollYPercentage': 0
            });

            // Listen for new scroll events, here we debounce our scroll handler function for performance reasons
            document.addEventListener('scroll', debounce(() => {

                let entityHeaderHeight = outerHeight(document.querySelector('.ntt--entity-header'));

                console.log(entityHeaderHeight);
                
                const scrollOffset = window.scrollY;
                const pageHeight = document.documentElement.scrollHeight - window.innerHeight;
                const scrollProgress = Math.min(1, scrollOffset / pageHeight);
                const scrollSteps = 1;
                
                // Set current scroll offset (we use this to make the floating header)
                updateEnv('scrollY', scrollOffset);
                
                // Calculate current progress in percentages
                updateEnv('scrollYPercentage', stack(Math.round(scrollProgress * 100), scrollSteps));

                if ( html.classList.contains('ntt--js--sticky-header') ) {
                    
                    if ( scrollOffset > entityHeaderHeight ) {
                        html.classList.add( 'ntt--sticky-header---active--js' );
                        html.style.marginTop = entityHeaderHeight + 'px';
                    } else {
                        html.classList.remove( 'ntt--sticky-header---active--js' );
                        html.style.marginTop = '0';
                    }
                }
            }), { passive: true });
        }
    } ) ();
} )();
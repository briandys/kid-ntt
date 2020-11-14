/**
 * Use Namespaces and Objects
 * http://garystorey.com/2015/07/10/whats-wrong-with-your-javascript/
 */

( function( $, window, document, undefined ) {
    'use strict';

    var kidNtt = kidNtt || {};

    const html = document.documentElement;
    const body = document.body;
    const commentForm = document.getElementById( 'commentform' );
    const entriesNav = document.getElementById( 'ntt--entries-nav' );

    // polyfill forEach
    // https://developer.mozilla.org/en-US/docs/Web/API/NodeList/forEach#Polyfill
    if ( window.NodeList && ! NodeList.prototype.forEach ) {
        NodeList.prototype.forEach = function( callback, thisArg ) {
            var i;
            var len = this.length;

            thisArg = thisArg || window;

            for ( i = 0; i < len; i++ ) {
                callback.call( thisArg, this[ i ], i, this );
            }
        };
    }

    // event "polyfill"
    kidNtt.createEvent = function( eventName ) {
        var event;
        if ( typeof window.Event === 'function' ) {
            event = new Event( eventName );
        } else {
            event = document.createEvent( 'Event' );
            event.initEvent( eventName, true, false );
        }
        return event;
    };

    // matches "polyfill"
    // https://developer.mozilla.org/es/docs/Web/API/Element/matches
    if ( ! Element.prototype.matches ) {
        Element.prototype.matches =
            Element.prototype.matchesSelector ||
            Element.prototype.mozMatchesSelector ||
            Element.prototype.msMatchesSelector ||
            Element.prototype.oMatchesSelector ||
            Element.prototype.webkitMatchesSelector ||
            function( s ) {
                var matches = ( this.document || this.ownerDocument ).querySelectorAll( s ),
                    i = matches.length;
                while ( --i >= 0 && matches.item( i ) !== this ) {}
                return i > -1;
            };
    }

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

    /**
     * Adding, removing, and testing for classes
     * https://plainjs.com/javascript/attributes/adding-removing-and-testing-for-classes-9/
     */
    function hasClass(el, className) {
        return el.classList ? el.classList.contains(className) : new RegExp('\\b'+ className+'\\b').test(el.className);
    }
    
    /**
	 * Wrap Text Node
	 * https://stackoverflow.com/a/18727318
	 */
    kidNtt.wrapTextNode = function( $el ) {
		var $textNode = $( '<span />', { 'class': 'ntt--txt' } );
		$el.contents().filter( function() {
			return this.nodeType === 3;
        } ).wrap( $textNode );
	};

	/**
	 * Remove Empty Elements
	 * https://stackoverflow.com/a/18727318
	 */
	kidNtt.removeEmpty = function( $el ) {
		$el.each( function() {
			var $this = $( this );
			if ( $this.html().replace( /\s|&nbsp;/g, '' ).length == 0 ) {
				$this.remove();
			}
		} );
    };
    
    /**
     * Remove Extra Space
     * https://stackoverflow.com/a/16974697
     * https://www.tutorialrepublic.com/faq/how-to-remove-white-spaces-from-a-string-in-jquery.php
     */
    kidNtt.removeExtraSpace = function( $el ) {
		$el.each( function() {
            var myStr = $( this ).text();
            var trimStr = myStr.replace( /\s+/g, ' ' ).trim();
            $( this ).html( trimStr );
		} );
    };

    /** Wrap Element
     * https://plainjs.com/javascript/manipulation/wrap-an-html-structure-around-an-element-28/
     */
    kidNtt.wrapElement = function( el, skinEl = 'span', className = 'ntt--txt' ) {

        el.forEach( ( el ) => {
            var skin = document.createElement( skinEl );
            skin.className = className;

            el.parentNode.insertBefore( skin, el );
            skin.appendChild( el );
        } );
    };

    /**
     * Helper for making DOM elements
     * https://giffmex.org/gifts/tiddlyblink.html
     * tag: tag name
     * options: see below
     * Options include:
     * namespace: defaults to http://www.w3.org/1999/xhtml
     * attributes: hashmap of attribute values
     * style: hashmap of styles
     * text: text to add as a child node
     * children: array of further child nodes
     * innerHTML: optional HTML for element
     * class: class name(s)
     * document: defaults to current document
     */
    kidNtt.domMaker = function( tag,options ) {
        var doc = options.document || document;
        var element = doc.createElementNS( options.namespace || "http://www.w3.org/1999/xhtml", tag );
        
        if ( options['id'] ) {
            element.id = options['id'];
        }
        
        if ( options['class'] ) {
            element.className = options['class'];
        }
        
        if ( options['type'] ) {
            element.type = options['type'];
        }

        if ( options.text ) {
            element.appendChild( doc.createTextNode( options.text ) );
        }

        $.each( options.children, function( child ) {
            element.appendChild( child );
        });

        if ( options.innerHTML ) {
            element.innerHTML = options.innerHTML;
        }

        $.each( options.attributes, function( attribute, name ) {
            element.setAttribute( attribute, name );
        } );

        $.each( options.style, function( value, name ) {
            element.style[name] = value;
        } );

        return element;
    };

    /**
     * Get Window Dimensions
     * Usage: To get the window height
     * var windowHeight = kidNtt.getWindowDimensions()[1];
     */
    kidNtt.getWindowDimensions = function() {
        var w = window,
            d = document,
            h = html,
            b = d.body,
            width = w.innerWidth || h.clientWidth || b.clientWidth,
            height = w.innerHeight || h.clientHeight || b.clientHeight;
        
        return [width, height];
    };

    // Add a class to the body for when touch is enabled for browsers that don't support media queries
    // for interaction media features. Adapted from <https://codepen.io/Ferie/pen/vQOMmO>.
    kidNtt.touchEnabled = {

        init: function() {
            var matchMedia = function() {
                // Include the 'heartz' as a way to have a non matching MQ to help terminate the join. See <https://git.io/vznFH>.
                var prefixes = [ '-webkit-', '-moz-', '-o-', '-ms-' ];
                var query = [ '(', prefixes.join( 'touch-enabled),(' ), 'heartz', ')' ].join( '' );
                return window.matchMedia && window.matchMedia( query ).matches;
            };

            if ( ( 'ontouchstart' in window ) || ( window.DocumentTouch && document instanceof window.DocumentTouch ) || matchMedia() ) {
                html.classList.add( 'ntt--touch-input---1--js' );
            } else {
                html.classList.add( 'ntt--touch-input---0--js' );
            }
        }
    }; // kidNtt.touchEnabled

    /*	-----------------------------------------------------------------------------------------------
    Detect Tabbing and Mouse Usage
    https://medium.com/hackernoon/removing-that-ugly-focus-ring-and-keeping-it-too-6c8727fefcd2
    --------------------------------------------------------------------------------------------------- */
    kidNtt.detectTabbing = {

        init: function() {
            this.handleFirstTab();
            this.handleMouseDownOnce();

            window.addEventListener( 'keydown', function( event ) {
                if ( event.keyCode === 9 ) {
                    kidNtt.detectTabbing.handleFirstTab();
                }
            } );
        },

        handleFirstTab: function() {
            html.classList.add( 'ntt--nav-mode---tab--js' );
            window.removeEventListener( 'keydown', kidNtt.detectTabbing.handleFirstTab );
            window.addEventListener( 'mousedown', kidNtt.detectTabbing.handleMouseDownOnce );
        },

        handleMouseDownOnce: function() {
            html.classList.remove( 'ntt--nav-mode---tab--js' );
            window.removeEventListener( 'mousedown', kidNtt.detectTabbing.handleMouseDownOnce );
            window.addEventListener( 'keydown', function( event ) {
                if ( event.keyCode === 9 ) {
                    kidNtt.detectTabbing.handleFirstTab();
                }
            } );
        }
    }; // kidNtt.detectTabbing
    
    /*	-----------------------------------------------------------------------------------------------
    Text Content Processing
    Wrap text nodes, remove empty tags, etc.
    --------------------------------------------------------------------------------------------------- */
    
    kidNtt.textContentProcessing = {

        init: function() {

            // All text nodes will be wrapped in txt CSS class name. If empty, remove it.
            var $content = $( '.ntt--content' );
            kidNtt.wrapTextNode( $content);
            kidNtt.removeEmpty( $content.find( '.ntt--txt' ) );
            kidNtt.removeExtraSpace( $content.find( '.ntt--txt' ) );
            kidNtt.removeEmpty( $content );

            // All text nodes will be wrapped in .ntt--txt. If empty, remove it.
            var $entryCategories = $( '.ntt--entry-categories' );
            kidNtt.wrapTextNode( $entryCategories );
            kidNtt.removeEmpty( $entryCategories.find( '.ntt--txt' ) );

            var contentPre = document.querySelectorAll( '.ntt--content > pre' );
            contentPre
            kidNtt.wrapElement( contentPre, 'div', 'ntt--pre-el-skin--js' );

            var contentTable = document.querySelectorAll( '.ntt--content > table' );
            kidNtt.wrapElement( contentTable, 'div', 'ntt--table-el-skin--js' );

            var contentCode = document.querySelectorAll( '.ntt--content code' );
            kidNtt.wrapElement( contentCode, 'span', 'ntt--code-el-skin--js' );
        }
    }; // kidNtt.textContentProcessing

    /*	-----------------------------------------------------------------------------------------------
    Intrinsic Ratio Embeds
    From Twenty Twenty
    --------------------------------------------------------------------------------------------------- */

    kidNtt.intrinsicRatioVideos = {

        init: function() {
            this.makeFit();

            window.addEventListener( 'resize', function() {
                this.makeFit();
            }.bind( this ) );
        },

        makeFit: function() {
            document.querySelectorAll( 'iframe, object, video' ).forEach( function( video ) {
                var ratio, iTargetWidth,
                    container = video.parentNode;

                // Skip videos we want to ignore.
                if ( video.classList.contains( 'intrinsic-ignore' ) || video.parentNode.classList.contains( 'intrinsic-ignore' ) ) {
                    return true;
                }

                if ( ! video.dataset.origwidth ) {
                    // Get the video element proportions.
                    video.setAttribute( 'data-origwidth', video.width );
                    video.setAttribute( 'data-origheight', video.height );
                }

                iTargetWidth = container.offsetWidth;

                // Get ratio from proportions.
                ratio = iTargetWidth / video.dataset.origwidth;

                // Scale based on ratio, thus retaining proportions.
                video.style.width = iTargetWidth + 'px';
                video.style.height = ( video.dataset.origheight * ratio ) + 'px';
            } );
        }

    }; // kidNtt.instrinsicRatioVideos

    /*	-----------------------------------------------------------------------------------------------
	Entries Navigation
    --------------------------------------------------------------------------------------------------- */
    kidNtt.entriesNav = {

        init: function() {
            
            if ( entriesNav ) {
                this.initCssClassNames();
                this.adjacentPageControl();
                this.entriesPageMenu();
            }
        },

        initCssClassNames: function() {
            
            var entriesNaviNext = entriesNav.querySelector( '.next' );
            var entriesNaviPrev = entriesNav.querySelector( '.prev' );
            var entriesNaviCurrent = entriesNav.querySelector( '.current' );
            
            if ( entriesNaviNext ) {
                entriesNaviNext.closest( 'li' ).classList.add( 'ntt--next-entries-navi--js' );
            }

            if ( entriesNaviPrev ) {
                entriesNaviPrev.closest( 'li' ).classList.add( 'ntt--previous-entries-navi--js' );
            }

            if ( entriesNaviCurrent ) {
                entriesNaviCurrent.closest( 'li' ).classList.add( 'ntt--current-entries-navi--js' );
            }
        },

        adjacentPageControl: function() {

            // Adjacent Page Control
            var entriesNavContainer = entriesNav.querySelector( '.nav-links' );
            var pageNumbersList = entriesNav.querySelector( 'ul.page-numbers' );
            var prevNavi = entriesNav.querySelector( '.ntt--previous-entries-navi--js' );
            var nextNavi = entriesNav.querySelector( '.ntt--next-entries-navi--js' );
            
            // Create Adjacent Page Control
            var adjacentPageControl = kidNtt.domMaker( 'div', {
                'class': 'ntt--entries-adjacent-page-control--js'
            } );
            entriesNavContainer.insertBefore( adjacentPageControl, pageNumbersList.nextSibling );

            // Create list inside Adjacent Page Control
            var adjacentPageControlList = kidNtt.domMaker( 'ul', {} );
            adjacentPageControl.insertAdjacentHTML( 'afterbegin', adjacentPageControlList.outerHTML );
            
            var adjacentPageControlList = adjacentPageControl.querySelector( 'ul' );
            
            // Put Next Navigation Item in Adjacent Page Control List
            if ( nextNavi ) {
                var nextNaviClone = nextNavi.cloneNode(true).outerHTML;
                adjacentPageControlList.insertAdjacentHTML( 'afterbegin', nextNaviClone );
                nextNavi.remove();
                
                var nextNaviTxt = entriesNav.querySelector( '.ntt--next-entries-navi--js .ntt--txt' );
                nextNaviTxt.insertAdjacentHTML( 'afterend', nttData.chevronRightIcon );
            } else {
                entriesNav.classList.add( 'ntt--next-entries-navi---0--js' );
                
                var naviPlaceholder = kidNtt.domMaker( 'span', {
                    'class': 'ntt--next-entries-navi-placeholder--js'
                } );
                adjacentPageControl.insertBefore( naviPlaceholder, adjacentPageControlList.nextSibling );
                naviPlaceholder.insertAdjacentHTML( 'afterbegin', nttData.chevronRightIcon );
            }
            
            // Put Previous Navigation Item in Adjacent Page Control List
            if ( prevNavi ) {
                var prevNaviClone = prevNavi.cloneNode(true).outerHTML;
                adjacentPageControlList.insertAdjacentHTML( 'afterbegin', prevNaviClone );
                prevNavi.remove();

                var prevNaviTxt = entriesNav.querySelector( '.ntt--previous-entries-navi--js .ntt--txt' );
                prevNaviTxt.insertAdjacentHTML( 'afterend', nttData.chevronLeftIcon );
            } else {
                entriesNav.classList.add( 'ntt--previous-entries-navi---0--js' );
                
                var naviPlaceholder = kidNtt.domMaker( 'span', {
                    'class': 'ntt--previous-entries-navi-placeholder--js'
                } );
                adjacentPageControl.insertBefore( naviPlaceholder, adjacentPageControlList );
                naviPlaceholder.insertAdjacentHTML( 'afterbegin', nttData.chevronLeftIcon );
            }
        },

        entriesPageMenu: function() {
            
            // Create Entries Page Menu
            var adjacentPageControl = entriesNav.querySelector( 'ntt--entries-adjacent-page-control--js' );
            var entriesNavContainer = entriesNav.querySelector( '.nav-links' );
            
            var entriesPageMenu = kidNtt.domMaker( 'div', {
                'id': 'ntt--entries-page-menu--js',
                'class': 'ntt--entries-page-menu--js'
            } );
            entriesNavContainer.insertBefore( entriesPageMenu, adjacentPageControl );
            
            var entriesPageMenuList = entriesNav.querySelector( 'ul.page-numbers' );
            entriesPageMenu.insertAdjacentHTML( 'afterbegin', entriesPageMenuList.outerHTML );
            entriesPageMenuList.remove();

            // Checks if the nav has 2 items or less
            if ( entriesPageMenuList && entriesPageMenuList.children.length <= 2 ) {
                entriesPageMenu.closest( '#ntt--entries-nav' ).classList.add( 'ntt--entries-nav---single-navi--js' );
            }

            function currentNaviIntoView() {
                var entriesPageMenuList = entriesNav.querySelector( 'ul.page-numbers' );
                var currentEntriesNavi = entriesNav.querySelector( '.ntt--current-entries-navi--js' );
                var naviHeight = currentEntriesNavi.offsetHeight;
                entriesPageMenuList.scrollTop = currentEntriesNavi.offsetTop - ( naviHeight / 2 );
            }

            window.addEventListener( 'load', currentNaviIntoView() );

            // Click event listener for Entries Page Indicator
            var entriesPageIndicator = entriesNav.querySelector( '.ntt--entries-page-indicator' );
            entriesPageIndicator.setAttribute( 'id', 'ntt--entries-page-indicator' );
            entriesPageIndicator.setAttribute( 'role', 'button' );
            entriesPageIndicator.setAttribute( 'tabindex', '0' );
            entriesPageIndicator.setAttribute( 'aria-controls', 'ntt--entries-page-menu--js' );
            entriesPageIndicator.setAttribute( 'aria-expanded', 'false' );
            entriesPageIndicator.setAttribute( 'title', nttData.toggleMenuTxt );
            
            var entriesPageIndicatorTxt = entriesPageIndicator.querySelector( '.ntt--txt' );
            entriesPageIndicatorTxt.insertAdjacentHTML( 'afterend', nttData.chevronUpDownIcon );

            function toggleActivityStatus() {
                var currentEntriesNavi = entriesNav.querySelector( '.ntt--current-entries-navi--js .page-numbers' );
                var activeClass = 'ntt--entries-page-menu---active';

                if ( entriesNav.classList.contains( activeClass) ) {
                    entriesPageIndicator.setAttribute( 'aria-expanded', 'false' );
                    entriesNav.classList.remove( activeClass );
                } else {
                    entriesPageIndicator.setAttribute( 'aria-expanded', 'true' );
                    entriesNav.classList.add( activeClass );
                    currentEntriesNavi.setAttribute( 'tabindex', '-1' );
                    currentEntriesNavi.focus();
                    currentNaviIntoView();
                }
            };
            
            // On click
            entriesPageIndicator.addEventListener( 'click', function() {
                toggleActivityStatus();
            } );
            
            // On enter or spacebar
            entriesPageIndicator.addEventListener( 'keyup', function( event ) {
                if ( ( event.keyCode === 13 ) || ( event.keyCode === 32 ) ) {
                    toggleActivityStatus();
                }
            } );

            // On escape
            document.addEventListener( 'keyup', function( event ) {
                if ( entriesNav.classList.contains( 'ntt--entries-page-menu---active') && event.key === 'Escape' ) {
                    toggleActivityStatus();
                    entriesPageIndicator.focus();
                }
            } );

            // On external click
            window.addEventListener( 'click', function ( event ) {
                
                if ( entriesNav.classList.contains( 'ntt--entries-page-menu---active') && ( ! entriesPageIndicator.contains( event.target ) && ! entriesPageMenu.contains( event.target ) ) ) {
                    toggleActivityStatus();
                    entriesPageIndicator.focus();
                }
            }, false);
        },
    }; // kidNtt.entriesNav

    /*	-----------------------------------------------------------------------------------------------
	Sub-menu
    --------------------------------------------------------------------------------------------------- */
    kidNtt.subMenu = {

        init: function() {
            this.initCssClassNames();
            this.toggleMenu();
            this.uncheckInputOnExternalClick();
            this.initActivityStatus();

            window.addEventListener( 'load', function() {
                kidNtt.subMenu.uncheckInput();
                kidNtt.subMenu.uncheckInputOnEscKey();
            } );
        },

        initCssClassNames: function() {

            // Initialize Sub-menu CSS Class Name
            var nav = document.querySelectorAll( '.ntt--nav, .ntt--widget_nav_menu' );
            var widgetNav = document.querySelectorAll( '.ntt--widget_nav_menu' );
            var currentNavItem = document.querySelectorAll( '.current-menu-item, .current_page_item' );
            
            nav.forEach( function ( el ) {

                if ( el.querySelector( '.children, .sub-menu' ) ) {
                    el.classList.add( 'ntt--nav---sub-menu--js' );
                }
            } );

            widgetNav.forEach( function ( el ) {

                if ( el.querySelector( '.sub-menu' ) ) {
                    el.classList.add( 'ntt--nav---sub-menu--js' );
                }
            } );
            
            currentNavItem.forEach( function ( el ) {
                el.classList.add( 'ntt--sub-menu-current-item--js' );
            } );
        },

        toggleMenu: function() {

            // Prepends a control to hide and show the sub-menu
            var subMenu = document.querySelectorAll( '.ntt--nav .children, .ntt--nav .sub-menu, .ntt--widget_nav_menu .sub-menu' );
            
            var i = 0;

            subMenu.forEach( ( el ) => {
                
                i++;
                var parent = el.parentNode;
                var chevronDownIcon = nttData.chevronDownIcon;
                var toggleMenuTxt = nttData.toggleMenuTxt;
                
                // Create Checkbox
                var checkbox = kidNtt.domMaker( 'input', {
                    'type': 'checkbox',
                    'id': 'ntt--sub-menu-checkbox-' + i + '--js',
                    'class': 'ntt--sub-menu-checkbox--js',
                    attributes: { 
                        'title': toggleMenuTxt,
                        'arial-label': toggleMenuTxt }
                } );

                // Create Label
                var label = kidNtt.domMaker( 'label', {
                    'class': 'ntt--sub-menu-checkbox-label--js',
                    attributes: { 
                        'for': 'ntt--sub-menu-checkbox-' + i + '--js' },
                    innerHTML: '<span class="ntt--txt">' + toggleMenuTxt + '</span>'
                } );
                
                // Insert in DOM
                parent.insertBefore( label, el );
                parent.insertBefore( checkbox, label );
                checkbox.insertAdjacentHTML( 'afterend', chevronDownIcon );

                el.classList.add( 'ntt--sub-menu--js' );
                parent.classList.add( 'ntt--sub-menu-ancestor--js' );
            } );
        },

        uncheckInput: function() {
            var subMenuAncestor = document.querySelectorAll( '.ntt--sub-menu-ancestor--js' );

            subMenuAncestor.forEach( function ( el ) {
                
                var input = el.getElementsByTagName('input');
                    
                for ( var i = 0; i < input.length; i++ ) { 
                    if ( input[i].type === 'checkbox' ) { 
                        input[i].checked = false; 
                    }
                }
                el.classList.remove( 'ntt--sub-menu---active--js' );
            } );
        },

        uncheckInputOnEscKey: function() {

            document.addEventListener( 'keyup', function ( event ) {
                var activeNav = document.querySelectorAll( '.ntt--sub-menu---active--js' );
                
                if ( activeNav.length && event.key === 'Escape' ) {
                    kidNtt.subMenu.uncheckInput();
                }
            } );
        },

        uncheckInputOnExternalClick: function() {

            window.addEventListener( 'click', function ( event ) {
                
                // Uncheck checkboxes when clicked outside this element
                var subMenuAncestor = document.querySelectorAll( '.ntt--sub-menu-ancestor--js' );

                subMenuAncestor.forEach( function ( el ) {
                    var targetEl = el.contains( event.target );
                
                    if ( ! targetEl ) {
                        var input = el.getElementsByTagName('input');
                        
                        for ( var i = 0; i < input.length; i++ ) { 
                            if ( input[i].type === 'checkbox' ) { 
                                input[i].checked = false; 
                            }
                        }
                        el.classList.remove( 'ntt--sub-menu---active--js' );
                    }
                } );
            }, false);
        },

        initActivityStatus: function() {
            var input = document.querySelectorAll( '.ntt--nav---sub-menu--js input' );

            for ( var i = 0, len = input.length; i < len; i++ ) {
                
                if ( input[i].type === 'checkbox' ) {
                    
                    input[i].onclick = function() {
                        var parent = this.parentNode;
                        
                        if ( this.checked ) {
                            parent.classList.add( 'ntt--sub-menu---active--js' );
                        } else {
                            parent.classList.remove( 'ntt--sub-menu---active--js' );
                        }
                    }
                }
            }
        }
    }; // kidNtt.subMenu

    /*	-----------------------------------------------------------------------------------------------
    Intersection Observer Targeting IDs
    https://codepen.io/bramus/pen/ExaEqMJ
    --------------------------------------------------------------------------------------------------- */
    kidNtt.sectionIdIntersection = {

        init: function() {

            var observer = new IntersectionObserver( entries => {
                
                entries.forEach( entry => {
                    var id = entry.target.getAttribute('id');
                    
                    if ( entry.intersectionRatio > 0 ) {
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
        }
    }; // kidNtt.sectionIdIntersection

    /*	-----------------------------------------------------------------------------------------------
    Intersection Observer for Entity Footer
    https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API
    --------------------------------------------------------------------------------------------------- */
    kidNtt.entityFooterIntersection = {

        init: function() {
            var entityFooter = document.querySelector('.ntt--entity-footer');

            var observer = new IntersectionObserver( handleIntersect, {
                rootMargin: '0px 0px 0px 0px',
                threshold: .75
            } );
    
            function handleIntersect( entries ) {

                entries.forEach( ( entry ) => {
                    
                    if ( entry.isIntersecting ) {
                        html.classList.add('ntt--entity-footer--intersected--js');
                    } else {
                        html.classList.remove('ntt--entity-footer--intersected--js');
                    }
                } );
            }
        
            observer.observe( entityFooter );
        }
    }; // kidNtt.entityFooterIntersection

    kidNtt.genericIntersection = {
        
        init: function() {

            var intersectionElement = document.querySelectorAll( '.ntt--observe-intersection--js' );

            if ( intersectionElement ) {

                var observer = new IntersectionObserver( entries => {
                
                    entries.forEach( entry => {
                        
                        if ( entry.isIntersecting ) {
                            entry.target.classList.add('ntt--intersected--js');
                            entry.target.classList.remove('ntt--not-intersected--js');
                        } else {
                            entry.target.classList.add('ntt--not-intersected--js');
                            entry.target.classList.remove('ntt--intersected--js');
                        }
                    });
                } );
            
                intersectionElement.forEach( ( el ) => {
                    el.classList.add('ntt--not-intersected--js');
                    observer.observe( el );
                } );
            }
        }
    }; // kidNtt.genericIntersection

    /*	-----------------------------------------------------------------------------------------------
    Assign Population Status of Input Elements
    --------------------------------------------------------------------------------------------------- */
    kidNtt.inputPopulationStatus = {

        init: function() {
            var inputs = document.querySelectorAll( 'input[type="text"], input[type="email"], input[type="url"], input[type="search"], textarea' );
            var input = null;
            var formField = '.ntt--form-field';

            for ( var i = 0, len = inputs.length; i < len; i++ ) {
                input = inputs[i];

                if ( ! input.value ) {
                    input.closest( formField ).classList.add('ntt--form-field---empty--js');
                } else {
                    input.closest( formField ).classList.add('ntt--form-field---populated--js');
                }
            }
        }
    }; // kidNtt.inputPopulationStatus

    /*	-----------------------------------------------------------------------------------------------
    Assign Listeners to Comment Input Elements
    https://stackoverflow.com/a/47944959
    --------------------------------------------------------------------------------------------------- */
    kidNtt.commentInputElements = {

        init: function() {

            if ( commentForm ) {
                this.populationStatus();
                this.focusListener();
            }
        },

        populationStatus: function() {
            
            var inputs = commentForm.querySelectorAll( 'input[type="text"], input[type="email"], input[type="url"], input[type="search"], textarea' );
            var input = null;
            var formField = '.ntt--form-field';

            for ( var i = 0, len = inputs.length; i < len; i++ ) {
                input = inputs[i];

                if ( ! input.value ) {
                    input.closest( formField ).classList.add('ntt--form-field---empty--js');
                } else {
                    input.closest( formField ).classList.add('ntt--form-field---populated--js');
                }
            }
        },
        
        focusListener: function() {

            if ( html.classList.contains( 'ntt--comment-creation---1--view' ) ) {
            
                var delegate = (selector) => (cb) => (e) => e.target.matches(selector) && cb(e);
                var inputDelegate = delegate('.text-input');
                var formField = '.ntt--form-field';
                var focusInTxt = 'ntt--form-field---focusin--js';
                var focusOutTxt = 'ntt--form-field---focusout--js';
                var emptyTxt = 'ntt--form-field---empty--js';
                var populatedTxt = 'ntt--form-field---populated--js';
    
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

                commentForm.removeAttribute( 'novalidate' );
            }
        }
    }; // kidNtt.commentInputElements

    /*	-----------------------------------------------------------------------------------------------
    Go to Start navigation
    --------------------------------------------------------------------------------------------------- */
    kidNtt.goStartNav = {

        init: function() {

            window.addEventListener( 'load', function() {
                
                // Get the element's static offset
                function offset( el ) {
                    var rect = el.getBoundingClientRect();
                    var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
                    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    
                    return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
                }

                function isPresent( el ) {
                    var style = window.getComputedStyle( el );
                    return ( el && style.display !== 'none' && style.visibility !== 'hidden' );
                }
                
                var entityFooter = document.querySelector( '.ntt--entity-footer' );
                var goStartNav = document.getElementById( 'ntt--go-start-nav' );
                
                if ( isPresent( entityFooter ) && goStartNav ) {

                    var docHeight = Math.max( html.clientHeight, html.scrollHeight, html.offsetHeight, body.scrollHeight, body.offsetHeight );
                    var footerOffset = offset( entityFooter );
                    
                    // Set style of nav
                    goStartNav.style.bottom = docHeight - footerOffset.top + 'px';
                }
            } );
        }
    }; // kidNtt.goStartNav

    /*	-----------------------------------------------------------------------------------------------
    Insert SVG Icons
    --------------------------------------------------------------------------------------------------- */
    kidNtt.insertIcons = {

        init: function() {
            
            // Go to Start Navigation
            var goStartNav = document.getElementById( 'ntt--go-start-nav' );

            if ( goStartNav ) {
                var goStartTxt = goStartNav.querySelector( '.ntt--txt' );
                goStartTxt.insertAdjacentHTML( 'afterend', nttData.arrowUpIcon );
            }
            
            // Breadcrumbs Navigation
            var breadcrumbsNav = document.querySelector( '.ntt--entry-breadcrumbs-nav-ancestors-group' );
            
            if ( breadcrumbsNav ) {
                var chevronRightIcon = nttData.chevronRightIcon;
                breadcrumbsNav.querySelectorAll( '.ntt--txt' ).forEach( function( el ) {
                    el.insertAdjacentHTML( 'afterend', chevronRightIcon );
                } );
            }
        }
    }; // kidNtt.insertIcons

    /*	-----------------------------------------------------------------------------------------------
    Window, Document Height
    Tell if the page is short or long
    --------------------------------------------------------------------------------------------------- */
    kidNtt.windowDocumentHeight = {

        init: function() {

            checkHeight();

            window.addEventListener( 'load', function() {
                checkHeight();
            } );

            window.addEventListener( 'resize', function() {
                checkHeight();
            } );

            function checkHeight() {
                var windowHeight = kidNtt.getWindowDimensions()[1];
                var documentHeight = document.documentElement.scrollHeight;
                var heightBuffer = windowHeight * .25;
                var shortTxt = 'ntt--view-height---short--js';
                var longTxt = 'ntt--view-height---long--js';
    
                if ( documentHeight <= ( windowHeight + heightBuffer ) ) {
                    html.classList.add( shortTxt );
                    html.classList.remove( longTxt );
                } else {
                    html.classList.add( longTxt );
                    html.classList.remove( shortTxt );
                }
            }
        }
    }; // kidNtt.windowDocumentHeight

    /**
     * Identify Linked Images
     */
    kidNtt.imageAnchor = {

        init: function() {

            document.querySelectorAll( '.ntt--content img' ).forEach( function( el ) {
                
                if ( el.closest( 'a' ) ) {
                    el.closest( 'a' ).classList.add( 'ntt--image-anchor--js' );
                }

                if ( el.closest( 'p' ) ) {
                    el.closest( 'p' ).classList.add( 'ntt--image-paragraph--js' );
                }
            } );
        }
    }; // kidNtt.imageAnchor

    /**
     * Identify Flickr Images
     */
    kidNtt.thirdPartyMedia = { 

        init: function() {

            // Flickr
            document.querySelectorAll( 'img[src*="flickr.com/"]' ).forEach( function( el ) {

                var a = el.closest( 'a' );
                var figure = el.closest( 'figure' );
                
                if ( a ) {
                    a.classList.add( 'ntt--flickr-image-anchor--js' );
                }

                if ( figure ) {
                    figure.classList.add( 'ntt--flickr-image--js' );
                }
            } );

            // Unsplash
            document.querySelectorAll( 'img[src*="unsplash.com/"]' ).forEach( function( el ) {

                var a = el.closest( 'a' );
                var figure = el.closest( 'figure' );
                
                if ( a ) {
                    a.classList.add( 'ntt--unsplash-image-anchor--js' );
                }

                if ( figure ) {
                    figure.classList.add( 'ntt--unsplash-image--js' );
                }
            } );
        }
    }; // kidNtt.thirdPartyMedia

    /**
     * Breadcrumbs
     */
    kidNtt.breadCrumbs = {

        init: function() {
            
            var nav = document.querySelectorAll( '.ntt--entry-breadcrumbs-nav-ancestors-group' );

            if ( nav ) {

                nav.forEach( function( el ) {

                    if ( el.closest( '.ntt--entry-breadcrumbs-nav' ) && el.children.length == 1 ) {
                        el.closest( '.ntt--entry-breadcrumbs-nav' ).classList.add( 'ntt--entry-breadcrumbs-nav--single-navi--js' );
                    }
                } );
            }
        }
    }; // kidNtt.breadCrumbs

    /**
     * Query String
     * Add CSS class to HTML based on a query string in the URL
     */
    kidNtt.queryString = {

        init: function() {

            var url = window.location.href;
            var queryString = url.search( /ref=index/i );

            if ( queryString !== -1 ) {
                html.classList.add( 'ntt--url-reference--index' );
            }
        }
    }; // kidNtt.queryString

    /**
     * Is the DOM ready?
     *
     * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
     *
     * @param {Function} fn Callback function to run.
     */
    function nttDomReady( fn ) {
        if ( typeof fn !== 'function' ) {
            return;
        }

        if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
            return fn();
        }

        document.addEventListener( 'DOMContentLoaded', fn, false );
    }

    nttDomReady( function() {
        kidNtt.touchEnabled.init();
        kidNtt.detectTabbing.init();
        kidNtt.textContentProcessing.init();
        kidNtt.entriesNav.init();
        kidNtt.subMenu.init();
        kidNtt.entityFooterIntersection.init();
        kidNtt.genericIntersection.init();
        kidNtt.commentInputElements.init();
        kidNtt.sectionIdIntersection.init();
        kidNtt.intrinsicRatioVideos.init();
        kidNtt.insertIcons.init();
        kidNtt.windowDocumentHeight.init();
        kidNtt.goStartNav.init();
        kidNtt.imageAnchor.init();
        kidNtt.thirdPartyMedia.init();
        kidNtt.breadCrumbs.init();
        kidNtt.queryString.init();
    } );
} )( jQuery, window, document );
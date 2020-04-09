/**
 * Use Namespaces and Objects
 * http://garystorey.com/2015/07/10/whats-wrong-with-your-javascript/
 */

(function($, window, document, undefined) {
    'use strict';

    var ntt = ntt || {};

    const html = document.documentElement;
    const body = document.body;

    // polyfill closest
    // https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Polyfill
    if ( ! Element.prototype.closest ) {
        Element.prototype.closest = function( s ) {
            var el = this;

            do {
                if ( el.matches( s ) ) {
                    return el;
                }

                el = el.parentElement || el.parentNode;
            } while ( el !== null && el.nodeType === 1 );

            return null;
        };
    }

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
    ntt.createEvent = function( eventName ) {
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

    // Add a class to the body for when touch is enabled for browsers that don't support media queries
    // for interaction media features. Adapted from <https://codepen.io/Ferie/pen/vQOMmO>.
    ntt.touchEnabled = {

        init: function() {
            var matchMedia = function() {
                // Include the 'heartz' as a way to have a non matching MQ to help terminate the join. See <https://git.io/vznFH>.
                var prefixes = [ '-webkit-', '-moz-', '-o-', '-ms-' ];
                var query = [ '(', prefixes.join( 'touch-enabled),(' ), 'heartz', ')' ].join( '' );
                return window.matchMedia && window.matchMedia( query ).matches;
            };

            if ( ( 'ontouchstart' in window ) || ( window.DocumentTouch && document instanceof window.DocumentTouch ) || matchMedia() ) {
                html.classList.add( 'ntt--touch-enabled--js' );
            } else {
                html.classList.add( 'ntt--not-touch-enabled--js' );
            }
        }
    }; // ntt.touchEnabled
    
    /**
	 * Wrap Text Node
	 * https://stackoverflow.com/a/18727318
	 */
	var wrapTextNode = function($elem) {
		var $textNodeMU = $('<span />', { 'class': 'ntt--txt' });
		$elem.contents().filter(function() {
			return this.nodeType === 3;
        } ).wrap($textNodeMU);
	}

	/**
	 * Remove Empty Elements
	 * https://stackoverflow.com/a/18727318
	 */
	var removeEmpty = function($elem) {
		$elem.each(function() {
			var $this = $(this);
			if ($this.html().replace(/\s|&nbsp;/g, '' ).length == 0) {
				$this.remove();
			}
		} );
    }
    
    /**
     * Remove Extra Space
     * https://stackoverflow.com/a/16974697
     * https://www.tutorialrepublic.com/faq/how-to-remove-white-spaces-from-a-string-in-jquery.php
     */
    var removeExtraSpace = function($elem) {
		$elem.each(function() {
            var myStr = $(this).text();
            var trimStr = myStr.replace(/\s+/g,' ').trim();
            $( this ).html(trimStr);
		} );
	}

    // All text nodes will be wrapped in txt CSS class name. If empty, remove it.
	var $content = $('.ntt--content');
    wrapTextNode($content);
    removeEmpty($content.find('.ntt--txt'));
    removeExtraSpace($content.find('.ntt--txt'));

    // All text nodes will be wrapped in .txt. If empty, remove it.
	var $categories = $('.ntt--entry-categories');
	wrapTextNode($categories);
    removeEmpty($categories.find('.ntt--txt'));
    
    // If Entry's only content is an image, it will not appear in Search Results, leaving Content Snippet with empty elements—so might as well remove them.
    var $contentSnippet = $('.ntt--entry-content-snippet');
    removeEmpty($contentSnippet.find('*'));
    removeEmpty($contentSnippet);

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
     * Wrap Element
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

    contentTable.forEach((el) => {
        var skin = document.createElement( 'div' );
        skin.className = 'ntt--table-wrapper ntt--obj';
        wrap(el, skin);
    });

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
     * Wrap Video <iframe>
     * https://css-tricks.com/fluid-width-video/
     */
    /*
    var videoPlayers = ['iframe[src*="youtube.com"]', 'iframe[src*="vimeo.com"]'];
    var contentVideoIframe = document.querySelectorAll(videoPlayers.join(","));
    
    if(contentVideoIframe.length) {
        contentVideoIframe.forEach((el) => {
            var skin = document.createElement('div');
            skin.className = 'ntt--video-iframe-skin--js';
            wrap(el, skin);
        });
    }
    */

    const goStartNav = document.getElementById( 'ntt--go-start-nav' );
    var goStartTxt = goStartNav.querySelector( '.ntt--txt' );
    var goStartNavIco = nttData.goStartNavIco;
    goStartTxt.insertAdjacentHTML('afterend', goStartNavIco);

    /*	-----------------------------------------------------------------------------------------------
    Intrinsic Ratio Embeds
    From Twenty Twenty
    --------------------------------------------------------------------------------------------------- */

    ntt.intrinsicRatioVideos = {

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

    }; // ntt.instrinsicRatioVideos

    /*	-----------------------------------------------------------------------------------------------
	Entries Navigation
    --------------------------------------------------------------------------------------------------- */
    ntt.entriesNav = {

        init: function() {

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
        }
    }; // ntt.entriesNav

    /*	-----------------------------------------------------------------------------------------------
	Sub-menu
    --------------------------------------------------------------------------------------------------- */
    ntt.subMenu = {

        init: function() {
            this.initCssClassNames();
            this.toggleMenu();
            this.uncheckOnOutsideClick();
            this.initActivityStatus();
        },

        initCssClassNames: function() {

            // Initialize Sub-menu CSS Class Name
            const nav = document.querySelectorAll( '.ntt--nav, .ntt--widget_nav_menu' );
            const widgetNav = document.querySelectorAll( '.ntt--widget_nav_menu' );
            const currentNavItem = document.querySelectorAll( '.current-menu-item, .current_page_item' );
            
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
            
            currentNavItem.forEach( function ( el ) {
                el.classList.add( 'ntt--sub-menu-current-item--js' );
            } );
        },

        toggleMenu: function() {

            // Prepends a control to hide and show the sub-menu
            const subMenu = document.querySelectorAll( '.ntt--nav .children, .ntt--nav .sub-menu, .ntt--widget_nav_menu .sub-menu' );
            
            var i = 0;

            subMenu.forEach( ( el ) => {
                
                i++;
                const parent = el.parentNode;

                var $icon = nttData.subNavTogBtnIco;
                var $toggleMenuTxt = nttData.toggleMenuTxt;
                
                // Create Checkbox
                const checkbox = document.createElement( 'input' );
                checkbox.type = 'checkbox';
                checkbox.id = 'ntt--sub-menu-checkbox-' + i + '--js';
                checkbox.className = 'ntt--sub-menu-checkbox--js';
                checkbox.setAttribute( 'title', $toggleMenuTxt );
                checkbox.setAttribute( 'arial-label', $toggleMenuTxt );

                // Create Label
                const label = document.createElement( 'label' );
                label.setAttribute( 'for', 'ntt--sub-menu-checkbox-' + i + '--js' );
                label.className = 'ntt--sub-menu-checkbox-label--js ntt--obj';
                label.innerHTML = '<span class="ntt--txt">' + $toggleMenuTxt + '</span>';
                
                // Insert in DOM
                parent.insertBefore( label, el );
                parent.insertBefore( checkbox, label );

                el.classList.add( 'ntt--sub-menu--js' );
                parent.classList.add( 'ntt--sub-menu-ancestor--js' );
            } );
        },

        uncheckOnOutsideClick: function() {

            // Uncheck checkboxes when clicked outside the element
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
        },

        initActivityStatus: function() {

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
        }
    }; // ntt.subMenu

    /*	-----------------------------------------------------------------------------------------------
    Detect Tabbing and Mouse Usage
    https://medium.com/hackernoon/removing-that-ugly-focus-ring-and-keeping-it-too-6c8727fefcd2
    --------------------------------------------------------------------------------------------------- */
    ntt.detectTabbing = {

        init: function() {
            this.handleFirstTab();
            this.handleMouseDownOnce();

            window.addEventListener('keydown', function(event) {
                if ( event.keyCode === 9 ) {
                    ntt.detectTabbing.handleFirstTab();
                }
            });
        },

        handleFirstTab: function() {
            html.classList.add('ntt--nav-mode---tab--js');
            window.removeEventListener('keydown', ntt.detectTabbing.handleFirstTab);
            window.addEventListener('mousedown', ntt.detectTabbing.handleMouseDownOnce);
        },

        handleMouseDownOnce: function() {
            html.classList.remove('ntt--nav-mode---tab--js');
            window.removeEventListener('mousedown', ntt.detectTabbing.handleMouseDownOnce);
            window.addEventListener('keydown', ntt.detectTabbing.handleFirstTab);
        }
    }; // ntt.detectTabbing

    /*	-----------------------------------------------------------------------------------------------
    Intersection Observer Targeting IDs
    https://codepen.io/bramus/pen/ExaEqMJ
    --------------------------------------------------------------------------------------------------- */
    ntt.sectionIdIntersection = {

        init: function() {

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
        }
    }; // ntt.sectionIdIntersection

    /*	-----------------------------------------------------------------------------------------------
    Assign Population Status of Input Elements
    --------------------------------------------------------------------------------------------------- */
    ntt.inputPopulationStatus = {

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
    }; // ntt.inputPopulationStatus

    /*	-----------------------------------------------------------------------------------------------
    Intersection Observer for Entity Footer
    https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API
    --------------------------------------------------------------------------------------------------- */
    ntt.entityFooterIntersection = {

        init: function() {
            var entityFooter;

            window.addEventListener('load', (event) => {
                entityFooter = document.querySelector('.ntt--entity-footer');
                createObserver();
            }, false);

            function createObserver() {
                var observer;
                observer = new IntersectionObserver(handleIntersect, {rootMargin: "0px 0px 160px 0px"});
                observer.observe(entityFooter);
            }
    
            function handleIntersect(entries, observer) {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        html.classList.add('ntt--entity-footer--intersected--js');
                    } else {
                        html.classList.remove('ntt--entity-footer--intersected--js');
                    }
                });
            }
        }
    }; // ntt.entityFooterIntersection

    /*	-----------------------------------------------------------------------------------------------
    Assign Population Status of Input Elements
    --------------------------------------------------------------------------------------------------- */
    ntt.inputPopulationStatus = {

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
    }; // ntt.inputPopulationStatus

    /*	-----------------------------------------------------------------------------------------------
    Assign Listeners to Comment Input Elements
    https://stackoverflow.com/a/47944959
    --------------------------------------------------------------------------------------------------- */
    ntt.commentInputElementsListener = {

        init: function() {

            if ( html.classList.contains('ntt--comment-creation---1--view') ) {
            
                const delegate = (selector) => (cb) => (e) => e.target.matches(selector) && cb(e);
                const inputDelegate = delegate('.text-input');
                const commentForm = document.getElementById('commentform');
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

                commentForm.removeAttribute('novalidate');
            }
        }
    }; // ntt.commentInputElementsListener

    /*	-----------------------------------------------------------------------------------------------
    Display a Random Image from a Set
    .ntt--js--random-image
    https://stackoverflow.com/a/19693578
    --------------------------------------------------------------------------------------------------- */
    ntt.displayRandomImage = {

        init: function() {

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
        }
    }; // ntt.displayRandomImage
    

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
        ntt.touchEnabled.init();
        ntt.entriesNav.init();
        ntt.subMenu.init();
        ntt.detectTabbing.init();
        ntt.entityFooterIntersection.init();
        ntt.inputPopulationStatus.init();
        ntt.commentInputElementsListener.init();
        ntt.displayRandomImage.init();
        ntt.sectionIdIntersection.init();
        ntt.intrinsicRatioVideos.init();
    } );
})( jQuery, window, document );
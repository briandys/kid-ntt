( function( $, window, document, undefined ) {
    'use strict';

    var kidNttHexetidine = kidNttHexetidine || {};

    const html = document.documentElement;
    const entityPrimaryNav = document.getElementById( 'ntt--entity-primary-nav' );

    function domMaker( tag,options ) {
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
    }

    /*	-----------------------------------------------------------------------------------------------
    Display a Random Image from a Set
    .ntt--js--random-image
    https://stackoverflow.com/a/19693578
    --------------------------------------------------------------------------------------------------- */
    kidNttHexetidine.displayRandomQuote = {

        init: function() {
            var nttDataArray = [
                nttKidNttHexetidineData.one,
                nttKidNttHexetidineData.two,
                nttKidNttHexetidineData.three,
                nttKidNttHexetidineData.four,
                nttKidNttHexetidineData.five,
                nttKidNttHexetidineData.six,
                nttKidNttHexetidineData.seven,
            ];
            
            var num = Math.floor( Math.random() * ( nttDataArray.length ) );
            var entitySecondaryInfo = document.querySelector( '.ntt--entity-secondary-info' );
            var quotes = document.createElement( 'div' );
            quotes.className = 'ntt--kid-ntt--hexetidine--quotes--js';
            quotes.innerHTML = nttDataArray[num];
            
            entitySecondaryInfo.insertAdjacentHTML( 'beforebegin', quotes.outerHTML );
        }
    }; // kidNttHexetidine.displayRandomQuote

    kidNttHexetidine.backButton = {

        init: function() {
            var aboutPage = document.querySelector( '.ntt--site-id--briandys-com--view.ntt--page--about--view' );
            
            if ( aboutPage ) {
                var entryName = aboutPage.querySelector( '.ntt--entry-name' );            
                
                var axn = document.createElement( 'a' );
                axn.className = 'ntt--kid-ntt--back-axn--js';
                axn.href = '../';
                axn.setAttribute( 'title', nttKidNttHexetidineData.backTxt );
                axn.innerHTML = '<span class="ntt--txt">' + nttKidNttHexetidineData.backTxt + '</span>' + nttData.chevronLeftIcon;
                entryName.insertAdjacentHTML( 'beforebegin', axn.outerHTML );
            }
        }
    }; // kidNttHexetidine.backButton

    kidNttHexetidine.currentYear = {

        init: function() {
            var yearTxt = document.querySelectorAll( '.ntt--cm-date .ntt--year-txt' );        
            
            if ( yearTxt ) {

                var currentYear = new Date().getFullYear();
                
                yearTxt.forEach( function ( el ) {

                    if ( el.textContent == currentYear ) {
                        el.closest( '.ntt--cm-date' ).classList.add( 'ntt--cm-date--current-year--js' );
                    }                
                } );
            }
        }
    }; // kidNttHexetidine.currentYear

    kidNttHexetidine.jetpackRelatedPosts = {

        init: function() {
            var postContext = document.querySelectorAll( '.jp-relatedposts-post-context' );        
            
            if ( postContext ) {

                postContext.forEach( function ( el ) {
                    var txt = el.textContent.replace( /In "|"/g, '' );
                    el.textContent = txt;
                } );
            }
        }
    }; // kidNttHexetidine.jetpackRelatedPosts

    /**
     * Mobile Menu
     */
    kidNttHexetidine.mobileMenu = {

        init: function() {
            
            var menu = entityPrimaryNav.querySelector( '.menu' );
            var menuCss = 'ntt--entity-primary-nav-menu';
            var navName = entityPrimaryNav.querySelector( '.ntt--entity-primary-nav-name' );
            var showTxt = nttData.showTxt;
            var hideTxt = nttData.hideTxt;
            var menuTxt = nttData.menuTxt;
            var icon = nttData.menuIcon;
            var activeCss = 'ntt--mobile-menu---active--js';
            var inactiveCss = 'ntt--mobile-menu---inactive--js';

            // Initial CSS class names
            html.classList.add( 'ntt--mobile-menu--js' );
            html.classList.add( inactiveCss );

            // Menu attribute
            menu.setAttribute( 'id', menuCss );

            // Create Button
            var button = domMaker( 'button', {
                'class': 'ntt--mobile-menu-toggle-axn--js',
                attributes: { 
                    'title': showTxt + ' ' + menuTxt,
                    'aria-label': showTxt + ' ' + menuTxt,
                    'aria-controls': menuCss,
                    'aria-expanded': 'false',
                },
                innerHTML: '<span class="ntt--txt"><span class="ntt--show-txt ntt--toggle-text">'+ showTxt +'</span> <span class="ntt--menu-txt">'+ menuTxt +'</span></span>'
            } );
            
            // Insert Checkbox and Label
            navName.insertAdjacentHTML( 'afterend', button.outerHTML );

            // Declare button
            var button = entityPrimaryNav.querySelector( '.ntt--mobile-menu-toggle-axn--js' );
            
            // Insert icon
            button.insertAdjacentHTML( 'beforeend', icon );

            // Toggle activity status
            function toggleActivityStatus() {
                var toggleText = button.querySelector( '.ntt--toggle-text' );

                // Activate
                if ( html.classList.contains( inactiveCss ) ) {
                    html.classList.add( activeCss );
                    html.classList.remove( inactiveCss );
                    button.setAttribute( 'aria-expanded', 'true' );
                    toggleText.innerHTML = hideTxt;
                }
                
                // Deactivate
                else if ( html.classList.contains( activeCss ) ) {
                    html.classList.add( inactiveCss );
                    html.classList.remove( activeCss );
                    button.setAttribute( 'aria-expanded', 'false' );
                    toggleText.innerHTML = showTxt;
                }
            }
            
            // On click
            button.addEventListener( 'click', function() {
                toggleActivityStatus();
            } );

            // On keyup
            document.addEventListener( 'keyup', function( event ) {
                if ( html.classList.contains( activeCss ) && event.key === 'Escape' ) {
                    toggleActivityStatus();
                }
            } );

            // On external click
            window.addEventListener( 'click', function ( event ) {                
                if ( html.classList.contains( activeCss ) && ( ! entityPrimaryNav.contains( event.target ) ) ) {
                    toggleActivityStatus();
                }
            }, false);
        }
    }; // kidNtt.mobileMenu

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
        // kidNttHexetidine.displayRandomQuote.init();
        kidNttHexetidine.backButton.init();
        kidNttHexetidine.currentYear.init();
        kidNttHexetidine.jetpackRelatedPosts.init();
        kidNttHexetidine.mobileMenu.init();
    } );
} )( jQuery, window, document );
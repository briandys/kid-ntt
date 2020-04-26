/**
 * Visit Duration
 * Determine How long has the user been on the page, updates the `pageVisitDuration` each 15 seconds, the siteVisitDuration is set in minutes.
 * https://pqina.nl/blog/using-smart-css-to-time-your-wonderful-newsletter-popup/
 */
var kidNttFeature = kidNttFeature || {};

kidNttFeature.visitDuration = {

    init: function() {
        const html = document.documentElement;
        
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
        const createEnvStore = ( props, root = document.documentElement ) => {
            const data = root.dataset;
            const sync = () => {
                Object.entries(props).forEach(([key, value]) => {
                    data[key] = Array.isArray(value) ? value.join(' ') : value;
                })
            }
            sync();
            return ( key, value ) => {
                props[key] = value;
                sync();
                //console.log(data);
            }
        };

        // Set default environment parameters
        const updateEnv = createEnvStore( {
            'siteVisitDuration': '',
            'pageVisitDuration': ''
        } );

        if ( html.classList.contains( nttKidNttFeatureVisitDurationData.prefixedSlug ) ) {
            
            const pageOpenDate = Date.now();

            // Retrieves the site visit duration, or, if not defined, 0
            const siteVisitDuration = parseInt( localStorage.getItem( 'siteVisitDuration' ) || 0, 10 );

            // Set current amount of visits
            updateEnv( 'siteVisitDuration', stack( siteVisitDuration / 60, 1 ) );

            // Update each 15 seconds
            setInterval( () => {
                // Page visit duration in seconds
                const pageVisitDuration = Math.round( Date.now() - pageOpenDate ) / 1000;
                
                // Update `pageVisitDuration` with 15 second intervals (0 15 30 45 ...)
                updateEnv( 'pageVisitDuration', stack( pageVisitDuration, 15 ) );
                
                // Update `siteVisitDuration` with 1 minute intervals (0 1 2 3 ...)
                updateEnv( 'siteVisitDuration', stack( ( siteVisitDuration + pageVisitDuration ) / 60, 1 ) );

                // Remember current duration
                localStorage.setItem( 'siteVisitDuration', siteVisitDuration + pageVisitDuration );
            }, 0 );
        }
    }
}; // kidNttFeature.siteDuration

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
    kidNttFeature.visitDuration.init();
} );
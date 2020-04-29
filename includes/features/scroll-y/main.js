/**
 * Scroll Y
 * https://pqina.nl/blog/using-smart-css-to-time-your-wonderful-newsletter-popup/
 */
var kidNttFeature = kidNttFeature || {};

kidNttFeature.scrollY = {

    init: function() {
        const html = document.documentElement;

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
            'scrollY': window.scrollY,
            'scrollYPercentage': 0
        } );
            
        // Scroll
        // Listen for new scroll events, here we debounce our scroll handler function for performance reasons
        document.addEventListener( 'scroll', debounce(() => {
            
            const scrollOffset = window.scrollY;
            const pageHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollProgress = Math.min(1, scrollOffset / pageHeight);
            const scrollSteps = 1;
            
            // Set current scroll offset (we use this to make the floating header)
            updateEnv( 'scrollY', scrollOffset );
            
            // Calculate current progress in percentages
            updateEnv( 'scrollYPercentage', stack( Math.round( scrollProgress * 100 ), scrollSteps) );
        } ), { passive: true } );
    }
}; // kidNttFeature.scrollY

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
    kidNttFeature.scrollY.init();
} );
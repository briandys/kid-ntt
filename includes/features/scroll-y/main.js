/**
 * https://pqina.nl/blog/using-smart-css-to-time-your-wonderful-newsletter-popup/
 */
(function() {

    const html = document.documentElement;
    const body = document.body;

    if (html.classList.contains('ntt--kid-ntt--feature--scroll-y')) {

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
                //console.log(data);
            }
        };

        // Set default environment parameters
        const updateEnv = createEnvStore({
            'scrollY': window.scrollY,
            'scrollYPercentage': 0
        });

        // Listen for new scroll events, here we debounce our scroll handler function for performance reasons
        document.addEventListener('scroll', debounce(() => {
            
            const scrollOffset = window.scrollY;
            const pageHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollProgress = Math.min(1, scrollOffset / pageHeight);
            const scrollSteps = 1;
            
            // Set current scroll offset (we use this to make the floating header)
            updateEnv('scrollY', scrollOffset);
            
            // Calculate current progress in percentages
            updateEnv('scrollYPercentage', stack(Math.round(scrollProgress * 100), scrollSteps));
        }), { passive: true });

        /*
        // Determine How long has the user been on the page, updates the `pageVisitDuration` each 15 seconds, the siteVisitDuration is set in minutes.
        const pageOpenDate = Date.now();

        // Retrieves the site visit duration, or, if not defined, 0
        const siteVisitDuration = parseInt(localStorage.getItem('siteVisitDuration') || 0, 10);

        // Set current amount of visits
        updateEnv('siteVisitDuration', stack(siteVisitDuration / 60, 1));

        // Update each 15 seconds
        setInterval(() => {
            // Page visit duration in seconds
            const pageVisitDuration = Math.round(Date.now() - pageOpenDate) / 1000;
            
            // Update `pageVisitDuration` with 15 second intervals (0 15 30 45 ...)
            updateEnv('pageVisitDuration', stack(pageVisitDuration, 15));
            
            // Update `siteVisitDuration` with 1 minute intervals (0 1 2 3 ...)
            updateEnv('siteVisitDuration', stack((siteVisitDuration + pageVisitDuration) / 60, 1));

            // Remember current duration
            localStorage.setItem('siteVisitDuration', siteVisitDuration + pageVisitDuration);
            
        }, 15000);
        */
    }
})();
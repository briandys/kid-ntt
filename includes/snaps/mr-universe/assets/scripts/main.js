( function() {

    const html = document.documentElement;

    /**
     * Get Element Width Including Margin
     * 
     * http://youmightnotneedjquery.com/#outer_width_with_margin
     */

    function outerWidth(el) {
        var width = el.offsetWidth;
        var style = getComputedStyle(el);
        
        width += parseInt(style.marginLeft) + parseInt(style.marginRight);
        return width;
    }

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
     * Monitor Scroll Y and Time on Page
     * 
     * https://pqina.nl/blog/using-smart-css-to-time-your-wonderful-newsletter-popup/
     */

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
        //'scrollY': window.scrollY,
        'scrollYPercentage': 0
        //'pageVisitDuration': 0,
        //'siteVisitDuration': 0
    });

    // Listen for new scroll events, here we debounce our scroll handler function for performance reasons
    document.addEventListener('scroll', debounce(() => {
        
        const scrollOffset = window.scrollY;
        const pageHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollProgress = Math.min(1, scrollOffset / pageHeight);
        
        // Set current scroll offset (we use this to make the floating header)
        //updateEnv('scrollY', scrollOffset);
        
        // Calculate current progress in percentages
        updateEnv('scrollYPercentage', stack(Math.round(scrollProgress * 100), 5));
        
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

    /**
     * Intersection Observer API
     * 
     * https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API
     * https://alligator.io/js/intersection-observer/
     */

    /*
    if ( document.querySelector('#ntt--custom_html-4') ) {
        const searchwidth = outerWidth( document.querySelector('#ntt--custom_html-4'));
        document.querySelector('#ntt--custom_html-4').style.right = '-' + searchwidth + 'px';
        document.querySelector('#ntt--custom_html-4').addEventListener( 'click', () => {
            html.classList.remove('show-newsletter')
        }, false);
    }
    */

    // Setup element to be observed
    const myImgs = document.querySelectorAll('.ntt--entity-footer');

    // Setup what the observer does
    // Once the viewport (from the top down) reaches .ntt--entity-footer, a class will be added to HTML element
    observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                html.classList.add('show-newsletter');
            } else {
                html.classList.remove('show-newsletter');
            }
        });
    });
    
    // Call observer on the element
    myImgs.forEach(image => {
        observer.observe(image);
    });
    
    /**
     * Display a random set of image
     * 
     * https://stackoverflow.com/a/19693578
     */
    /*
    var imagesArray = [
        'https://live.staticflickr.com/65535/47938401808_368f7a4f45_b.jpg',
        'https://live.staticflickr.com/65535/47951048638_a4dff3aab6_b.jpg',
        'https://live.staticflickr.com/65535/47952164337_5443c8cdd2_b.jpg',
        'https://live.staticflickr.com/65535/47979873141_7b1a8c2101_b.jpg'
    ];

    function displayImage() {
        var num = Math.floor(Math.random() * (imagesArray.length));
        document.canvas.src = imagesArray[num];
    }

    document.addEventListener( 'DOMContentLoaded', function() {
		displayImage();
    });
    */
} )();
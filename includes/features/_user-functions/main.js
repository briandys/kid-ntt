/**
 * Toggle event for <details> element
 * https://developer.mozilla.org/en-US/docs/Web/API/HTMLDetailsElement/toggle_event
 */
(function() {

    const html = document.documentElement;

    if ( html.classList.contains('ntt--kid-ntt--feature--user-functions')) {

        const details = document.querySelectorAll('details');
        
        details.forEach((detail) => {

            if (detail.open) {
                detail.classList.add('active');
            } else {
                detail.classList.add('inactive');
            }

            detail.addEventListener('toggle', event => {
                if (detail.open) {
                    detail.classList.add('active');
                    detail.classList.remove('inactive');
                } else {
                    detail.classList.add('inactive');
                    detail.classList.remove('active');
                }
            });
        });
    }
})();
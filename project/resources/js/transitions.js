
import { loadParticles } from "./particles";
import { initScrollAnimations } from "./animations";

// Helper to determine if we should intercept the click
function shouldIntercept(event) {
    const link = event.target.closest('a');
    if (!link) return false;

    // Check if it's an internal link
    if (link.origin !== window.location.origin) return false;

    // Ignore invalid targets, hash links on same page, or specific exclusions
    if (link.target === '_blank' ||
        (link.pathname === window.location.pathname && link.hash) ||
        link.hasAttribute('data-no-transition')) return false;

    return link;
}

export function initViewTransitions() {
    window.addEventListener('click', async (e) => {
        const link = shouldIntercept(e);
        if (!link) return;

        e.preventDefault();
        const url = link.href;

        // Fallback if browser doesn't support View Transitions
        if (!document.startViewTransition) {
            window.location.assign(url);
            return;
        }

        try {
            // Fetch the new page content
            const response = await fetch(url);
            if (!response.ok) throw new Error('Network response was not ok');
            const text = await response.text();

            // Parse the new HTML
            const parser = new DOMParser();
            const newDoc = parser.parseFromString(text, 'text/html');

            // Perform the transition
            const transition = document.startViewTransition(() => {
                // Swap the Body content
                // We use morphing or simple replacement. Here simple replacement for robust MPA support.
                document.body.innerHTML = newDoc.body.innerHTML;
                document.title = newDoc.title;

                // Scroll to top
                window.scrollTo(0, 0);

                // RE-INITIALIZATION HOOKS
                // Since we nuked the body, we need to restart things that lived in the body or attached to body elements.

                // 1. Restart Particles
                loadParticles("tsparticles");

                // 2. Restart Alpine (if it was loaded via script tag in head, window.Alpine still exists)
                if (window.Alpine) {
                    window.Alpine.start();
                }

                // 3. Restart Scroll Animations
                initScrollAnimations();
            });

            // Update History API
            transition.finished.then(() => {
                history.pushState({}, '', url);
            });

        } catch (err) {
            console.error('Transition failed:', err);
            window.location.assign(url);
        }
    });

    // Handle Back/Forward Browser Buttons
    window.addEventListener('popstate', () => {
        // ideally we should handle this via transition too, but for MVP we might let it reload or implement fetch logic here too.
        // For now, let's just let it reload to be safe, or we implement the same fetch logic.
        window.location.reload();
    });
}


export function initScrollAnimations() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const animationClass = element.dataset.animate || 'animate-fade-in-up';
                const delay = element.dataset.delay || '0s';

                element.style.animationDelay = delay;
                element.classList.add(animationClass);
                element.classList.remove('opacity-0'); // Make visible

                // Optional: Stop observing once animated
                observer.unobserve(element);
            }
        });
    }, observerOptions);

    // Find all elements with 'reveal-on-scroll' class
    const elements = document.querySelectorAll('.reveal-on-scroll');
    elements.forEach(el => {
        el.classList.add('opacity-0'); // Ensure hidden initially
        observer.observe(el);
    });
}

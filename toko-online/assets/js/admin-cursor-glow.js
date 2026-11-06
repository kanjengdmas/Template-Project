document.addEventListener('mousemove', (e) => {
    const cursor = document.getElementById('cursorGlow');
    if (cursor) {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
    }
});

// Global Reveal on Scroll / Load Animation for Admin Pages
document.addEventListener('DOMContentLoaded', () => {
    const revealElements = document.querySelectorAll('.reveal');
    if (revealElements.length > 0) {
        if ('IntersectionObserver' in window) {
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target); // Stop observing once revealed
                    }
                });
            }, {
                threshold: 0.05,
                rootMargin: '0px 0px -20px 0px'
            });
            revealElements.forEach(el => revealObserver.observe(el));
        } else {
            // Fallback for browsers without IntersectionObserver support
            revealElements.forEach(el => el.classList.add('active'));
        }
    }
});

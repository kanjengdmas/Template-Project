// Navbar Scrolled Effect
window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
        document.querySelector('.navbar').classList.add('scrolled');
        document.querySelectorAll('.nav-link').forEach(el => {
            el.classList.replace('text-white', 'text-dark');
        });
        document.querySelector('.navbar-brand').classList.replace('text-white', 'text-primary');
    } else {
        document.querySelector('.navbar').classList.remove('scrolled');
        document.querySelectorAll('.nav-link').forEach(el => {
            el.classList.add('text-white');
        });
        document.querySelector('.navbar-brand').classList.replace('text-primary', 'text-white');
    }
});

// Counter Animation for Stats
const counters = document.querySelectorAll('.counter');
const speed = 200; 

const animateCounters = () => {
    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const inc = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + inc);
                setTimeout(updateCount, 10);
            } else {
                counter.innerText = target;
            }
        };
        updateCount();
    });
}

// Intersection Observer for triggering counters
const observer = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) {
        animateCounters();
    }
});
observer.observe(document.querySelector('.stats-section'));

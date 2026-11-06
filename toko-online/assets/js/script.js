document.addEventListener('DOMContentLoaded', () => {
  // 1. Navbar Scroll Effect
  const navbar = document.getElementById('navbar');
  
  if (navbar) {
    const isPersistent = navbar.classList.contains('persistent-glass');
    
    // Set initial state
    if (isPersistent) {
      navbar.classList.add('glass-navbar');
      navbar.classList.remove('bg-transparent', 'border-transparent');
    }
    
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50 || isPersistent) {
        navbar.classList.add('glass-navbar');
        navbar.classList.remove('bg-transparent', 'border-transparent');
      } else {
        navbar.classList.remove('glass-navbar');
        navbar.classList.add('bg-transparent', 'border-transparent');
      }
    });
  }

  // 2. Mobile Menu Toggle
  const btnMobileMenu = document.getElementById('btn-mobile-menu');
  const mobileMenu = document.getElementById('mobile-menu');
  
  if (btnMobileMenu && mobileMenu) {
    btnMobileMenu.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      mobileMenu.classList.toggle('flex');
    });
  }

  // 3. Reveal on Scroll (Intersection Observer)
  const revealElements = document.querySelectorAll('.reveal');
  
  const revealObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
      }
    });
  }, {
    threshold: 0.12,
    rootMargin: '0px 0px -30px 0px'
  });

  revealElements.forEach(el => revealObserver.observe(el));

  // 4. Live Statistic Counter Animation
  const statsSection = document.getElementById('stats');
  const counters = document.querySelectorAll('.counter-number');
  
  if (statsSection && counters.length > 0) {
    const animateCounters = () => {
      counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'), 10);
        const duration = 2000; // total duration in ms
        const startTime = performance.now();
        
        const updateCounter = (currentTime) => {
          const elapsedTime = currentTime - startTime;
          const progress = Math.min(elapsedTime / duration, 1);
          
          // Smooth easeOut cubic progression
          const easeOutCubic = 1 - Math.pow(1 - progress, 3);
          const currentVal = Math.floor(easeOutCubic * target);
          
          counter.innerText = currentVal;
          
          if (progress < 1) {
            requestAnimationFrame(updateCounter);
          } else {
            counter.innerText = target;
          }
        };
        
        requestAnimationFrame(updateCounter);
      });
    };
    
    // Check if element is already in viewport on load
    const rect = statsSection.getBoundingClientRect();
    const isInViewport = rect.top >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight);
    
    if (isInViewport) {
      setTimeout(animateCounters, 300); // Slight delay for smooth feel on load
    } else {
      const statsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            animateCounters();
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1 });
      statsObserver.observe(statsSection);
    }
  }

  // 5. FAQ Accordion Interactive Toggles
  const accordionHeaders = document.querySelectorAll('.faq-accordion-header');
  accordionHeaders.forEach(header => {
    header.addEventListener('click', () => {
      const parent = header.parentElement;
      const isActive = parent.classList.contains('active');
      
      // Close any other currently open items (Exclusive single selection)
      document.querySelectorAll('.faq-accordion-item').forEach(item => {
        item.classList.remove('active');
      });
      
      // Toggle target
      if (!isActive) {
        parent.classList.add('active');
      }
    });
  });

  // 6. Countdown Timer (Promo Section)
  let countdownTime = localStorage.getItem('promo_countdown');
  if (!countdownTime) {
    countdownTime = new Date().getTime() + (24 * 60 * 60 * 1000);
    localStorage.setItem('promo_countdown', countdownTime);
  }

  const countdownEl = {
    hours: document.getElementById('timer-hours'),
    minutes: document.getElementById('timer-minutes'),
    seconds: document.getElementById('timer-seconds')
  };

  function updateCountdown() {
    const now = new Date().getTime();
    let timeLeft = countdownTime - now;

    if (timeLeft < 0) {
      const newEnd = new Date().getTime() + (24 * 60 * 60 * 1000);
      localStorage.setItem('promo_countdown', newEnd);
      countdownTime = newEnd;
      timeLeft = newEnd - now;
    }

    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

    if (countdownEl.hours) countdownEl.hours.innerText = String(hours).padStart(2, '0');
    if (countdownEl.minutes) countdownEl.minutes.innerText = String(minutes).padStart(2, '0');
    if (countdownEl.seconds) countdownEl.seconds.innerText = String(seconds).padStart(2, '0');
  }

  if (countdownEl.hours) {
    updateCountdown();
    setInterval(updateCountdown, 1000);
  }

  // 7. Toast Notification / Add Cart
  const addToCartButtons = document.querySelectorAll('.btn-add-cart');
  addToCartButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const productName = btn.getAttribute('data-product') || 'Produk';
      showToast(`🎉 ${productName} ditambahkan ke keranjang!`);
    });
  });

  function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-5 right-5 glass-navbar border border-emerald-500 text-emerald-100 px-6 py-4 rounded-2xl shadow-2xl z-50 flex items-center space-x-3 transform translate-y-20 opacity-0 transition-all duration-500';
    toast.innerHTML = `
      <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      <span class="font-medium text-sm md:text-base">${message}</span>
    `;
    document.body.appendChild(toast);
    
    setTimeout(() => {
      toast.classList.remove('translate-y-20', 'opacity-0');
    }, 100);
    
    setTimeout(() => {
      toast.classList.add('opacity-0', 'translate-y-5');
      setTimeout(() => {
        toast.remove();
      }, 500);
    }, 3500);
  }

  // 8. Luxurious Typing Animation for Hero
  const strings = ["Modern & Mewah", "Eksklusif & Elegan", "Masa Depan Anda"];
  let textIndex = 0;
  let charIndex = 0;
  let isDeleting = false;
  const typingElement = document.getElementById('typing-element');
  
  if (typingElement) {
    // Create cursor element
    const cursor = document.createElement('span');
    cursor.className = 'typing-cursor';
    cursor.innerHTML = '&nbsp;';
    typingElement.parentNode.insertBefore(cursor, typingElement.nextSibling);
    
    function executeTyping() {
      const currentString = strings[textIndex];
      
      if (isDeleting) {
        typingElement.innerText = currentString.substring(0, charIndex - 1);
        charIndex--;
      } else {
        typingElement.innerText = currentString.substring(0, charIndex + 1);
        charIndex++;
      }
      
      let typeSpeed = isDeleting ? 40 : 80; // Slower typing, faster deleting
      
      if (!isDeleting && charIndex === currentString.length) {
        typeSpeed = 2000; // pause on full text
        isDeleting = true;
      } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        textIndex = (textIndex + 1) % strings.length;
        typeSpeed = 400; // brief pause before next word
      }
      
      setTimeout(executeTyping, typeSpeed);
    }
    
    // Start with initial pause for maximum impact
    setTimeout(executeTyping, 1200);
  }

  // 9. Premium Mouse Glow Effect Tracker (Global)
  const globalCursorGlow = document.getElementById('cursorGlow');
  if (globalCursorGlow) {
    document.addEventListener('mousemove', (e) => {
      globalCursorGlow.style.left = e.clientX + 'px';
      globalCursorGlow.style.top = e.clientY + 'px';
    });
  }
});

(function() {
  'use strict';

  function initPrestaAnimation() {
    if (typeof gsap === 'undefined') {
      console.warn('GSAP not loaded');
      return;
    }

    if (typeof ScrollTrigger !== 'undefined') {
      gsap.registerPlugin(ScrollTrigger);
    }

    const prestaBlocks = document.querySelectorAll('.presta');

    prestaBlocks.forEach(function(block) {
      if (block.dataset.animated === 'true') return;
      block.dataset.animated = 'true';

      const cards = block.querySelectorAll('.presta__card');

      // État initial des cards
      gsap.set(cards, {
        opacity: 0,
        y: 50
      });

      // Animation avec ScrollTrigger
      if (typeof ScrollTrigger !== 'undefined') {
        gsap.to(cards, {
          opacity: 1,
          y: 0,
          duration: 0.6,
          ease: 'power2.out',
          stagger: 0.2,
          scrollTrigger: {
            trigger: block,
            start: 'top 80%',
            toggleActions: 'play none none none'
          }
        });
      } else {
        // Fallback avec IntersectionObserver
        const observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              gsap.to(cards, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power2.out',
                stagger: 0.2
              });
              observer.unobserve(entry.target);
            }
          });
        }, { threshold: 0.2 });

        observer.observe(block);
      }
    });
  }

  // Initialiser quand le DOM est prêt
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPrestaAnimation);
  } else {
    initPrestaAnimation();
  }

  // Réinitialiser pour les blocs ajoutés dynamiquement (Gutenberg)
  if (typeof wp !== 'undefined' && wp.data) {
    wp.data.subscribe(function() {
      setTimeout(initPrestaAnimation, 100);
    });
  }
})();

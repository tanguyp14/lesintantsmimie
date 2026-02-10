(function() {
  'use strict';

  // Attendre que GSAP soit chargé
  function initAccrocheAnimation() {
    if (typeof gsap === 'undefined') {
      console.warn('GSAP not loaded');
      return;
    }

    // Enregistrer le plugin ScrollTrigger si disponible
    if (typeof ScrollTrigger !== 'undefined') {
      gsap.registerPlugin(ScrollTrigger);
    }

    const accroches = document.querySelectorAll('.accroche__phrase');

    accroches.forEach(function(accroche) {
      // Éviter de ré-animer si déjà fait
      if (accroche.dataset.animated === 'true') return;
      accroche.dataset.animated = 'true';

      // Récupérer le HTML original (pour conserver les <br>)
      const originalHTML = accroche.innerHTML;

      // Remplacer les <br> par un marqueur unique
      const brMarker = '|||BR|||';
      const htmlWithMarkers = originalHTML.replace(/<br\s*\/?>/gi, brMarker);

      // Créer un élément temporaire pour extraire le texte
      const temp = document.createElement('div');
      temp.innerHTML = htmlWithMarkers;
      const text = temp.textContent || temp.innerText;

      // Vider l'élément
      accroche.innerHTML = '';

      // Créer un span pour chaque caractère
      const chars = text.split('');
      let i = 0;

      while (i < chars.length) {
        // Vérifier si on est au début d'un marqueur de <br>
        const remainingText = text.substring(i);
        if (remainingText.startsWith(brMarker)) {
          // Ajouter un <br>
          const br = document.createElement('br');
          accroche.appendChild(br);
          i += brMarker.length;
          continue;
        }

        const char = chars[i];
        const span = document.createElement('span');
        span.className = 'accroche__char';

        // Préserver les espaces
        if (char === ' ') {
          span.innerHTML = '&nbsp;';
        } else {
          span.textContent = char;
        }

        span.style.display = 'inline-block';
        span.style.opacity = '0';
        span.style.transform = 'translateY(20px)';
        accroche.appendChild(span);
        i++;
      }

      // Récupérer tous les spans créés (pas les <br>)
      const charSpans = accroche.querySelectorAll('.accroche__char');
      const charCount = charSpans.length;

      // Adapter la vitesse selon la longueur du texte
      // Plus le texte est long, plus l'animation est rapide
      let staggerTime = 0.03;
      let duration = 0.05;

      if (charCount > 100) {
        staggerTime = 0.015;
        duration = 0.03;
      } else if (charCount > 60) {
        staggerTime = 0.02;
        duration = 0.04;
      }

      // Configuration de l'animation
      const animationConfig = {
        opacity: 1,
        y: 0,
        duration: duration,
        ease: 'power2.out',
        stagger: staggerTime
      };

      // Si ScrollTrigger est disponible, utiliser le scroll trigger
      if (typeof ScrollTrigger !== 'undefined') {
        gsap.to(charSpans, {
          ...animationConfig,
          scrollTrigger: {
            trigger: accroche,
            start: 'top 80%',
            toggleActions: 'play none none none'
          }
        });
      } else {
        // Sinon, utiliser IntersectionObserver
        const observer = new IntersectionObserver(function(entries) {
          entries.forEach(function(entry) {
            if (entry.isIntersecting) {
              gsap.to(charSpans, animationConfig);
              observer.unobserve(entry.target);
            }
          });
        }, { threshold: 0.2 });

        observer.observe(accroche);
      }
    });
  }

  // Initialiser quand le DOM est prêt
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAccrocheAnimation);
  } else {
    initAccrocheAnimation();
  }

  // Réinitialiser pour les blocs ajoutés dynamiquement (Gutenberg)
  if (typeof wp !== 'undefined' && wp.data) {
    wp.data.subscribe(function() {
      setTimeout(initAccrocheAnimation, 100);
    });
  }
})();

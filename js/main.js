/**
 * Famewoven Main Application Bootstrapper
 * Spec: Sections 5 & 13 of Blueprint (New Text Document.md)
 * Coordinates init order: Canvas bg -> Loader animation -> Hero sequence -> Global triggers
 */

(function () {
  window.addEventListener('DOMContentLoaded', function () {
    // 1. Configure GSAP reduced motion globally
    if (typeof gsap !== 'undefined') {
      const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      if (reduce) {
        gsap.globalTimeline.timeScale(100);
        if (typeof ScrollTrigger !== 'undefined') {
          ScrollTrigger.config({ limitCallbacks: true });
        }
      }
    }

    // 2. Play Loader (or bypass if already seen in current session)
    if (typeof window.playLoader === 'function') {
      window.playLoader(function () {
        // Callback triggered when loader curtain lifts
        if (typeof window.initHero === 'function') {
          window.initHero();
        }
      });
    } else {
      if (typeof window.initHero === 'function') {
        window.initHero();
      }
    }
  });
})();

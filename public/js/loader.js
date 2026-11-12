/**
 * Famewoven Brand Name Loader & Session Architecture
 * Spec: Section 7.1 of Blueprint (New Text Document.md)
 */

window.playLoader = function (done) {
  const loader = document.getElementById('loader');
  if (!loader) {
    if (typeof done === 'function') done();
    return;
  }

  // Check if loader has already been played in this browser session
  if (sessionStorage.getItem('fw_seen')) {
    loader.remove();
    if (typeof done === 'function') done();
    return;
  }

  // Check GSAP availability
  if (typeof gsap === 'undefined') {
    setTimeout(function () {
      loader.style.opacity = '0';
      setTimeout(function () {
        loader.remove();
        sessionStorage.setItem('fw_seen', '1');
        if (typeof done === 'function') done();
      }, 400);
    }, 1200);
    return;
  }

  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce) {
    loader.remove();
    sessionStorage.setItem('fw_seen', '1');
    if (typeof done === 'function') done();
    return;
  }

  const letters = document.querySelectorAll('.loader-letter');
  const bar = document.getElementById('loader-bar');
  const word = document.getElementById('loader-word');
  const barWrap = document.getElementById('loader-bar-wrap');
  const limeLetters = document.querySelectorAll('.loader-lime');

  const tl = gsap.timeline({
    onComplete: function () {
      sessionStorage.setItem('fw_seen', '1');
      if (typeof done === 'function') done();
    }
  });

  // Staggered masked reveal of each letter with smooth upward snap
  tl.set(loader, { opacity: 1 })
    .fromTo(letters,
      {
        yPercent: 125,
        opacity: 0,
        rotateX: -40,
        transformOrigin: '50% 100%'
      },
      {
        yPercent: 0,
        opacity: 1,
        rotateX: 0,
        duration: 0.85,
        stagger: 0.045,
        ease: 'power3.out'
      }
    )
    // Progress bar fills across smoothly
    .to(bar, {
      scaleX: 1,
      duration: 1.1,
      ease: 'power2.inOut'
    }, '-=0.55')
    // Subtle lime accent glow breath across "woven"
    .to(limeLetters, {
      textShadow: '0 0 24px rgba(212, 245, 79, 0.75)',
      duration: 0.35,
      yoyo: true,
      repeat: 1,
      ease: 'sine.inOut'
    }, '-=0.45')
    // Clean exit of word and bar upward
    .to([word, barWrap], {
      y: -18,
      opacity: 0,
      duration: 0.4,
      ease: 'power2.in'
    }, '+=0.15')
    // Curtain lifts
    .to(loader, {
      yPercent: -100,
      duration: 0.8,
      ease: 'expo.inOut'
    })
    .set(loader, {
      display: 'none'
    });
};

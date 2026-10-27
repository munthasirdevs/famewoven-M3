/**
 * Famewoven Geometric SVG Loader & Session Architecture
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

  const paths = document.querySelectorAll('#loader-mark path, #loader-mark polygon');
  paths.forEach(function (p) {
    if (typeof p.getTotalLength === 'function') {
      const L = p.getTotalLength();
      p.style.strokeDasharray = L;
      p.style.strokeDashoffset = L;
    }
  });

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

  const tl = gsap.timeline({
    onComplete: function () {
      sessionStorage.setItem('fw_seen', '1');
      if (typeof done === 'function') done();
    }
  });

  tl.to(paths, {
    strokeDashoffset: 0,
    duration: 1.1,
    ease: 'power2.inOut',
    stagger: 0.15
  })
  .to(paths, {
    fill: '#D4F54F',
    stroke: 'transparent',
    duration: 0.45
  }, '-=0.2')
  .from('#loader-word span', {
    yPercent: 110,
    duration: 0.7,
    ease: 'expo.out'
  }, '-=0.3')
  .to('#loader-bar', {
    scaleX: 1,
    duration: 0.9,
    ease: 'power1.inOut'
  }, '<')
  .to('#loader-mark, #loader-word, #loader-bar-wrap', {
    opacity: 0,
    y: -14,
    duration: 0.4,
    stagger: 0.04
  }, '+=0.2')
  .to(loader, {
    yPercent: -100,
    duration: 0.85,
    ease: 'expo.inOut'
  })
  .set(loader, {
    display: 'none'
  });
};

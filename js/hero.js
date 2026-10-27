/**
 * Famewoven Hero Interactive Engine
 * Spec: Section 10.1 of Blueprint (New Text Document.md)
 * Includes: Mechanical Split-Flap departure board, founding sticker animation,
 * campaign tracker live metric fill, and entrance sequencing.
 */

window.initHero = function () {
  const heroSection = document.getElementById('hero');
  if (!heroSection) return;

  const WORDS = [
    'AI Tools',
    'Automation',
    'SaaS Product',
    'Creators',
    'Conglomerates',
    'Industries',
    'AI Agents',
    'Tech Products',
    'Tech Startups'
  ];
  const CH = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  const board = document.getElementById('flap-board');
  const boardContainer = document.getElementById('flap-container');

  // Split-Flap Departure Board (Airport mechanical roller)
  let wordIndex = 0;
  let flapTimer = null;

  function rollTo(text) {
    if (!board) return;
    board.innerHTML = '';
    if (boardContainer) {
      boardContainer.setAttribute('aria-label', 'Built for ' + text);
    }

    const chars = [...text.toUpperCase()];
    chars.forEach((ch, i) => {
      const cell = document.createElement('span');
      cell.className = 'flap-cell';
      cell.setAttribute('aria-hidden', 'true');

      const strip = document.createElement('span');
      strip.className = 'flap-strip';

      const n = 5 + i;
      let html = '';
      for (let k = 0; k < n; k++) {
        html += `<i>${CH[(Math.random() * 26) | 0]}</i>`;
      }
      html += `<i>${ch === ' ' ? '&nbsp;' : ch}</i>`;
      strip.innerHTML = html;
      cell.appendChild(strip);
      board.appendChild(cell);

      if (typeof gsap !== 'undefined') {
        gsap.fromTo(strip,
          { yPercent: 0 },
          {
            yPercent: -100 * n / (n + 1),
            duration: 0.85 + i * 0.035,
            ease: 'power3.out',
            delay: i * 0.025
          }
        );
      }
    });
  }

  // Live Campaign Tracker Bar Animation (Section 10.1 bottom right card)
  const trackerFill = document.getElementById('hero-tracker-fill');
  const trackerNumber = document.getElementById('hero-tracker-num');
  if (trackerFill && trackerNumber && typeof gsap !== 'undefined') {
    const counterObj = { val: 0 };
    gsap.to(trackerFill, {
      width: '84%',
      duration: 2.2,
      delay: 2.2,
      ease: 'power2.out'
    });
    gsap.to(counterObj, {
      val: 84,
      duration: 2.2,
      delay: 2.2,
      ease: 'power2.out',
      onUpdate: () => {
        trackerNumber.textContent = Math.round(counterObj.val) + '%';
      }
    });
  }

  // Hero Entrance Sequence (Blueprint: 2.6s timeline)
  if (typeof gsap !== 'undefined') {
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduce) {
      rollTo(WORDS[0]);
      return;
    }

    const heroTl = gsap.timeline({ delay: 0.2 });

    // H1 lines rise from mask
    heroTl.fromTo('.hero-h1-line',
      { yPercent: 105, opacity: 0 },
      { yPercent: 0, opacity: 1, duration: 1.1, stagger: 0.12, ease: 'expo.out' }
    )
    // Flap board first roll
    .add(() => {
      rollTo(WORDS[0]);
    }, '-=0.5')
    // Subtitle & audiences line fades up
    .fromTo('#hero-sub, #hero-audience-line',
      { y: 25, opacity: 0 },
      { y: 0, opacity: 1, duration: 0.8, stagger: 0.1, ease: 'power3.out' },
      '-=0.4'
    )
    // CTAs rise
    .fromTo('#hero-ctas > *',
      { y: 20, opacity: 0 },
      { y: 0, opacity: 1, duration: 0.6, stagger: 0.12, ease: 'power2.out' },
      '-=0.4'
    )
    // Mini campaign tracker glass card
    .fromTo('#hero-tracker-card',
      { y: 30, opacity: 0 },
      { y: 0, opacity: 1, duration: 0.8, ease: 'power3.out' },
      '-=0.4'
    );

    // Continuous split-flap rolling every 3.2s
    if (!reduce) {
      flapTimer = setInterval(() => {
        wordIndex = (wordIndex + 1) % WORDS.length;
        rollTo(WORDS[wordIndex]);
      }, 3200);
    }
  } else {
    rollTo(WORDS[0]);
  }
};
